@extends('clinet.layouts.master')

@section('content')
    <div class="container">
        <form action="{{ route('order.store') }}" method="post">
            @csrf
            <div class="my-3">
                <label for="">Product Name</label>
                <input class="form-control" type="text" name="product_name">
            </div>
            <div class="my-3">
                <label for="">Quantity</label>
                <input class="form-control" type="text" name="quantity">
            </div>
            <div class="my-3">
                <label for="">Price</label>
                <input class="form-control" type="text" name="price">
            </div>
            <button type="submit" class="btn btn-primary mb-3">Save</button>
        </form>
    </div>
@endsection
