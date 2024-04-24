@extends('layouts.app')
@section('content')
    <div class="section-header">
        <h1><i class="fas fa-fire"></i> Dashboard</h1>
    </div>

    <div class="col-12 mb-4">
        <div class="hero bg-primary text-white">
            <div class="hero-inner">
                @if (Auth::user()->is_admin)
                    <h2>Welcome Back, Admin</h2>
                    <p class="lead">This page is a place for managing users and performing administrative tasks.</p>
                @else
                    <h2>Welcome Back, {{ Auth::user()->name }}</h2>
                    <p class="lead">This page is a place for shopping. Happy Shopping! <i class="fas fa-shopping-cart"></i>
                    </p>
                @endif
            </div>
        </div>
    </div>


    @if (!Auth::user()->is_admin)
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4>Best Products</h4>
                    </div>
                    <div class="card-body">
                        <div class="owl-carousel owl-theme" id="products-carousel">
                            <div class="row ">
                                @foreach ($products as $product)
                                    <div class="col-md-3 col-sm-6 mb-4">
                                        <div class="product-item">
                                            <div class="product-image">
                                                <img alt="image" src="{{ url('storage/' . $product->image) }}"
                                                    class="img-fluid">
                                            </div>
                                            <div class="product-details ">
                                                <div class="product-name">{{ $product->name }}</div>
                                                <div class="product-review">
                                                    <i class="fas fa-star"></i>
                                                    <p>5.0</p>

                                                </div>
                                                <div class="text-muted text-small">Rp
                                                    {{ number_format($product->price, 0, ',', '.') }}</div>
                                                <div class="product-cta mt-2">
                                                    <a href="{{ route('show_product', $product) }}"
                                                        class="btn btn-primary">Detail</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card card-statistic-2">
                    <div class="card-stats">
                    </div>
                    <div class="card-icon shadow-primary bg-primary">
                        <i class="fas fa-archive"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Orders</h4>
                        </div>
                        <div class="card-body">
                            {{ $totalOrders }}
                        </div>
                    </div>

                </div>
            </div>
        </div>
    @endif
@endsection
