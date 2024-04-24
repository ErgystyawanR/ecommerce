@extends('layouts.app')

@section('content')

    <div class="section-body">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if (Session::has('success'))
            <div class="alert alert-success" role="alert">
                {{ Session::get('success') }}
            </div>
        @elseif(Session::has('error'))
            <div class="alert alert-danger" role="alert">
                {{ Session::get('error') }}
            </div>
        @endif
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4>Your Shopping Cart <i class="fas fa-shopping-bag"></i></h4>
                        <form action="{{ route('products') }}" method="get">
                            @csrf
                            <button type="submit" class="btn btn-warning">
                                <i class="fas fa-arrow-left"></i> Back
                            </button>
                        </form>
                    </div>

                    <div class="card-body">
                        @if ($carts && $carts->isNotEmpty())
                            <div class="table-responsive">
                                <table class="table table-striped table-md">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Product</th>
                                            <th>Image</th>
                                            <th>Price</th>
                                            <th>Quantity</th>
                                            <th>Total</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($carts as $cart)
                                            @php
                                            $no = 1
                                            @endphp
                                            <tr> 
                                                <td>{{ $no }}</td>
                                                <td>{{ $cart->product->name }}</td>
                                                <td><img src="{{ url('storage/' . $cart->product->image) }}"
                                                        alt="{{ $cart->product->name }}" height="100px"></td>
                                                <td>Rp {{ number_format($cart->product->price, 0, ',', '.') }}</td>
                                                <td>{{ $cart->amount }}</td>
                                                <td>Rp {{ number_format($cart->total_price, 0, ',', '.') }}</td>
                                                <td style="display: flex;">
                                                    <form action="{{ route('update_cart', $cart) }}" method="POST">
                                                        @method('patch')
                                                        @csrf
                                                        <div style="display: flex;">
                                                            <input type="number" class="form-control" name="amount"
                                                                value="{{ $cart->amount }}" style="margin-right: 5px;">
                                                            <button type="submit"
                                                                class="btn btn-success btn-sm">Update</button>
                                                        </div>
                                                    </form>

                                                    <form action="{{ route('delete_cart', $cart) }}" method="POST">
                                                        @method('delete')
                                                        @csrf
                                                        <button type="submit" class="btn btn-danger ml-2">Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                            @php
                                                $no++
                                            @endphp
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                            <div class="text-right p-3">
                                <h5>Total: Rp {{ number_format($grandTotal, 0, ',', '.') }}</h5>
                            </div>

                            <form action="{{ route('checkout') }}" method="POST">
                                @csrf
                                <div class="text-center mt-4">
                                    <button type="submit" class="btn btn-primary"> <i class="fas fa-shopping-bag"></i>
                                        Proceed
                                        to
                                        Checkout</button>
                                </div>
                            </form>
                        @else
                            <p>Your cart is empty.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
