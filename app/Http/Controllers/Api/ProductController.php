<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $data = Product::query()->with('supplier')->get();

            return response()->json($data);
        } catch (\Exception $th) {
            return response()->json('server error', 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->except('image');

        if ($request->hasFile('image')) {
            $data['image'] = Storage::put('products', $request->file('image'));
        }

        Product::query()->create($data);

        return response()->json([], 204);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // $product = Product::query()->findOrFail($id);
        // return response()->json($product);

        try {
            $product = new ProductResource(Product::findOrFail($id));

            return response()->json($product);
        } catch (\Throwable $th) {

            Log::error(__CLASS__ . "@" . __FUNCTION__, [$th]);

            if ($th instanceof ModelNotFoundException) {
                return response()->json([
                    'message' => 'Product not found',
                ], Response::HTTP_NOT_FOUND);
            }

            return response()->json([
                'message' => 'Product not found',
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $product = Product::query()->findOrFail($id);

        if ($request->hasFile('image')) {
            $data['image'] = Storage::put('products', $request->file('image'));
        }

        $data = $request->except(['image']);
        $imgCurrent = $product->image;

        $product->update($request->all());

        if ($request->hasFile('image') && $imgCurrent && Storage::exists($imgCurrent)) {
            Storage::delete($imgCurrent);
        }

        return response()->json($product);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::query()->findOrFail($id);

        $product->delete();

        if ($product->image && Storage::exists($product->image)) {
            Storage::delete($product->image);
        }
    }
}
