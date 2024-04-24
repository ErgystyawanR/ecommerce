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
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Show Product</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <img src="{{ url('storage/' . $product->image) }}" class="img-fluid" alt="Product Image">
                            </div>
                            <div class="col-md-6">
                                <h5 class="text-primary font-weight-bold">{{ $product->name }}</h5>
                                <p class="text-muted mb-3">Price : <span class=" font-weight-bold">Rp
                                        {{ number_format($product->price, 0, ',', '.') }}</span></p>
                                <p class="text-muted mb-3">Description : {{ $product->description }}</p>
                                <p class="text-muted mb-3">Stock : <span class="text-success">{{ $product->stock }}</span>
                                </p>
                                @if (!Auth::user()->is_admin)
                                    <form action="{{ route('add_to_cart', $product) }}" method="post" class="mb-3">
                                        @csrf
                                        <div class="row">
                                            <div class="col-auto">
                                                <input type="number" name="amount" class="form-control" value="1"
                                                    min="1">
                                            </div>
                                            <div class="col-auto">
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="fas fa-shopping-bag"></i> Add to Cart
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                @endif
                                <form action="{{ route('products') }}" method="get">
                                    @csrf
                                    <button type="submit" class="btn btn-warning">
                                        <i class="fas fa-arrow-left"></i> Back
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    </section>
@endsection
