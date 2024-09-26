@extends('clinet.layouts.master')

@section('content')
    <form action="{{ route('orders.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <h4 class="text-center">supplier</h4>
                <div class="mt-3">
                    <label for="">Name</label>
                    <input type="text" name="supplier[name]" value="{{ old('supplier.name') }}" class="form-control">
                    @error('supplier.name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mt-3">
                    <label for="">Address</label>
                    <input type="text" name="supplier[address]" value="{{ old('supplier.address') }}"
                        class="form-control">
                    @error('supplier.address')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mt-3">
                    <label for="">Phone</label>
                    <input type="text" name="supplier[phone]" value="{{ old('supplier.phone') }}" class="form-control">
                    @error('supplier.phone')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mt-3">
                    <label for="">Email</label>
                    <input type="email" name="supplier[email]" value="{{ old('supplier.email') }}" class="form-control">
                    @error('supplier.email')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="col-md-6">
                <h4 class="text-center">Customer</h4>
                <div class="mt-3">
                    <label for="">Name</label>
                    <input type="text" name="customer[name]" value="{{ old('customer.name') }}" class="form-control">
                    @error('customer.name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mt-3">
                    <label for="">Address</label>
                    <input type="text" name="customer[address]" value="{{ old('customer.address') }}"
                        class="form-control">
                    @error('customer.address')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mt-3">
                    <label for="">Phone</label>
                    <input type="text" name="customer[phone]" value="{{ old('customer.phone') }}" class="form-control">
                    @error('customer.phone')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mt-3">
                    <label for="">Email</label>
                    <input type="email" name="customer[email]" value="{{ old('customer.email') }}" class="form-control">
                    @error('customer.email')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <h2 class="my-3">Product</h2>
            <table class="table">
                <tr>
                    <th>Name</th>
                    <th>Image</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Stock Qty</th>
                    <th>Qty (số lượng bán)</th>
                </tr>
                @for ($i = 0; $i < 2; $i++)
                    <tr>
                        <td>
                            <input type="name" name="products[{{ $i }}][name]"
                                value="{{ old("products.$i.name") }}" class="form-control">
                            @error("products.$i.name")
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </td>
                        <td>
                            <input type="file" name="products[{{ $i }}][image]" class="form-control">
                            @error("products.$i.image")
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </td>
                        <td>
                            <input type="name" name="products[{{ $i }}][description]"
                                value="{{ old("products.$i.description") }}" class="form-control">
                            @error("products.$i.description")
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </td>
                        <td>
                            <input type="number" name="products[{{ $i }}][price]"
                                value="{{ old("products.$i.price") }}" class="form-control">
                            @error("products.$i.price")
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </td>
                        <td>
                            <input type="name" name="products[{{ $i }}][stock_qty]"
                                value="{{ old("products.$i.stock_qty") }}" class="form-control">
                            @error("products.$i.stock_qty")
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </td>
                        <td>
                            <input type="name" name="order_details[{{ $i }}][qty]"
                                value="{{ old("order_details.$i.qty") }}" class="form-control">
                            @error("order_details.$i.qty")
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </td>
                    </tr>
                @endfor

            </table>
        </div>
        <div class="text-center">
            <button class="btn btn-primary my-3">Save</button>
        </div>
    </form>
@endsection
