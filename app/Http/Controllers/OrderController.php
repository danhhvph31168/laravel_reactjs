<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrderRequest;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class OrderController extends Controller
{
    const PATH_VIEW = 'orders.';
    public function index()
    {
        $order = Order::query()->with(['customer', 'products'])->get();
        return view(self::PATH_VIEW . __FUNCTION__, compact('order'));
    }
    public function create()
    {
        return view(self::PATH_VIEW . __FUNCTION__);
    }
    public function store(StoreOrderRequest $request)
    {
        try {
            DB::beginTransaction();

            $supplier = Supplier::query()->create($request->supplier);

            $customer = Customer::query()->create($request->customer);

            $orderDetails = [];
            $totalAmount = 0;
            foreach ($request->products as $key => $value) {

                $value['supplier_id'] = $supplier->id;

                if ($request->hasFile("products.$key.image")) {
                    $value['image'] = Storage::put('products', $request->file("products.$key.image"));
                }

                $tmp = Product::query()->create($value);

                $orderDetails[$tmp->id] = [
                    'qty'   => $request->order_details[$key]['qty'],
                    'price' => $tmp->price,
                ];

                $totalAmount += $request->order_details[$key]['qty'] * $tmp->price;
            }

            $order = Order::query()->create([
                'customer_id' => $customer->id,
                'total_amount' => $totalAmount,
            ]);

            $order->products()->attach($orderDetails);

            DB::commit();
            return redirect()->route('orders.index');
        } catch (\Exception $e) {
            DB::rollBack();

            if ($request->hasFile("products.*.image") && Storage::exists("products.*.image")) {
                Storage::delete("products.*.image");
            }

            dd($e->getMessage());
        }
    }
    public function edit(Order $order)
    {
        $order->load([
            'customer',
            'products',
        ]);

        return view(self::PATH_VIEW . __FUNCTION__, compact('order'));
    }
    public function update(Request $request, Order $order)
    {
        try {
            DB::beginTransaction();

            $order->products()->sync($request->order_details);

            $order_details = array_map(fn ($item) => $item['price'] * $item['qty'], $request->order_details);

            $totalAmount = array_sum($order_details);

            $order->update([
                'totalAmount' => $totalAmount,
            ]);

            DB::commit();
            return redirect()->route('orders.index');
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e->getMessage());
        }
    }
    public function destroy(Order $order)
    {
        $imageProduct = $order->products->toArray();

        try {
            DB::beginTransaction();

            $order->products()->sync([]);
            $order->delete();

            DB::commit();

            foreach ($imageProduct as $item) {
                if ($item['image'] && Storage::exists($item['image'])) {
                    Storage::delete($item['image']);
                }
            }

            return redirect()->route('orders.index');
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e->getMessage());
        }
    }
}
