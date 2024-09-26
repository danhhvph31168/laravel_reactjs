@extends('clinet.layouts.master')

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('orders.update', $order) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-md-4">
                <h2 class="mx-3">Tổng tiền</h2>
                <h3 class="text-success">{{ $order->total_amount }}</h3>
                <ul>
                    <li>{{ $order->customer->name }}</li>
                    <li>{{ $order->customer->email }}</li>
                    <li>{{ $order->customer->phone }}</li>
                    <li>{{ $order->customer->address }}</li>
                </ul>
            </div>

            <div class="col-md-8">
                <h4 class="text-center">Product</h4>
                <table class="table">
                    <tr>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Qty</th>
                    </tr>
                    @foreach ($order->products as $item)
                        <tr>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->price }}</td>
                            <td>
                                <input type="hidden" name="order_details[{{ $item->id }}][price]"
                                    value="{{ $item->pivot->price }}">
                                <input type="number" name="order_details[{{ $item->id }}][qty]"
                                    value="{{ $item->pivot->qty }}">
                                @error("order_details.$item->id.qty")
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </td>
                        </tr>
                    @endforeach
                </table>

            </div>
        </div>
        <div class="text-center">
            <button class="btn btn-primary my-3">Save</button>
        </div>
    </form>
@endsection
