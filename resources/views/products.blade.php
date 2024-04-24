@extends('layouts.app')
@section('content')
    <div class="section-body">
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
                        <h4><i class="fas fa-box"></i> Products</h4>
                        @if(Auth::user()->is_admin)
                        <form action="{{ route('create_product') }}" method="get">
                            @csrf
                            <button type="submit" class="btn btn-primary ml-auto"><i class="fas fa-plus"></i> Add</button>
                        </form>
                        @endif
                    </div>
                    <div class="row">
                        @foreach ($products as $product)
                            <div class="col-12 col-md-4 col-lg-4">
                                <div class="pricing pricing-highlight">
                                    <div class="pricing-title">
                                        {{ $product->name }}
                                    </div>
                                    <div class="pricing-padding">
                                        <div class="pricing-price">
                                            <img src="{{ url('storage/' . $product->image) }}" class="img-fluid"
                                                alt="Product Image">
                                            <div class="price-label mt-2">Price: Rp
                                                {{ number_format($product->price, 0, ',', '.') }}</div>
                                        </div>
                                        <div class="pricing-details">
                                            <div class="pricing-item">
                                                <div class="pricing-item-icon bg-primary"><i class="fas fa-info"></i></div>
                                                <div class="pricing-item-label">Description: {{ $product->description }}
                                                </div>
                                            </div>
                                            <div class="pricing-item">
                                                <div class="pricing-item-icon"><i class="fas fa-check"></i></div>
                                                <div class="pricing-item-label">Stock: <span
                                                        class="text-success">{{ $product->stock }}</span></div>
                                            </div>
                                        </div>
                                    </div>
                                    @if (Auth::user()->is_admin)
                                    <form action="{{ route('edit_product', $product) }}" method="GET">
                                        @csrf
                                        <div class="pricing-cta">
                                            <button type="submit" class="btn btn-warning">
                                                Edit <i class="fas fa-pen"></i>
                                            </button>
                                        </div>
                                    </form>
                                    <form action="{{ route('delete_product', $product) }}" method="post">
                                        @method('delete')
                                        @csrf
                                        <div class="pricing-cta">
                                            <button type="submit" class="btn btn-danger">
                                                Delete <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </form>
                                    @endif
                                    <div class="pricing-cta">
                                        <a href="{{ route('show_product', $product) }}">Detail <i
                                                class="fas fa-info"></i></a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
