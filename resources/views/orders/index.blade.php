@extends('clinet.layouts.master')

@section('content')
    @if (session()->has('error'))
        <div class="alert alert-danger">
            {{ session()->get('error') }}
        </div>
    @endif

    @if (session()->has('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
    @endif
    <a href="{{ route('orders.create') }}" class="btn btn-primary">ADD</a>
    <table class="table my-3">
        <tr>
            <th>ID</th>
            <th>Customer ID</th>
            <th>Total Amount</th>
            <th>Order Detail</th>
            <th>Action</th>
        </tr>
        @foreach ($order as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td>
                    <ul>
                        <li>{{ $item->customer->name }}</li>
                        <li>{{ $item->customer->email }}</li>
                        <li>{{ $item->customer->address }}</li>
                        <li>{{ $item->customer->phone }}</li>
                    </ul>
                </td>
                <td>{{ $item->total_amount }}</td>
                <td>
                    @foreach ($item->products as $product)
                        <b>{{ $product->name }}</b>
                        <ul>
                            <li>Price: {{ $product->pivot->price }}</li>
                            <li>Quantity: {{ $product->pivot->qty }}</li>
                            @if ($product->image && \Storage::exists($product->image))
                                <li>
                                    <img src="{{ \Storage::url($product->image) }}" width="100px">
                                </li>
                            @endif
                        </ul>
                    @endforeach
                </td>
                <td>
                    <a href="{{ route('orders.edit', $item) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('orders.destroy', $item) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button onclick="return confirm('Are you sure you want to delete')"
                            class="btn btn-danger">DELETE</button>
                    </form>
                </td>
            </tr>
        @endforeach

    </table>
@endsection
