@extends('layouts.app')
@section('content')
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4>Edit Product</h4>
                        <form action="{{ route('products') }}" method="get">
                            @csrf
                            <button type="submit" class="btn btn-warning">
                                <i class="fas fa-arrow-left"></i> Back
                            </button>
                        </form>
                    </div>
                    <form action="{{ route('update_product', $product) }}" method="post" enctype="multipart/form-data">
                        @method('patch')
                        @csrf
                        <div class="card-body">
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Name</label>
                                <div class="col-sm-12 col-md-7">
                                    <input type="text" class="form-control" name="name" value="{{ $product->name }}">
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Price</label>
                                <div class="col-sm-12 col-md-7">
                                    <input type="text" class="form-control" name="price" value="{{ $product->price }}">
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Description</label>
                                <div class="col-sm-12 col-md-7">
                                    <textarea class="form-control" name="description">{{ $product->description }}</textarea>
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Upload Image</label>
                                <div class="col-sm-12 col-md-7">
                                    @if (isset($product->image))
                                        <div>Current Image : {{ $product->image }}</div>
                                        <br>
                                    @endif
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="customFile" name="image"
                                            onchange="document.getElementById('customFileLabel').innerHTML = this.files[0].name">
                                        <!-- Tambahkan input tersembunyi untuk menyimpan nilai gambar saat ini -->
                                        <input type="hidden" name="current_image" value="{{ $product->image }}">
                                        <label class="custom-file-label" for="customFile" id="customFileLabel">Choose
                                            file</label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Stock</label>
                                <div class="col-sm-12 col-md-7">
                                    <input type="text" class="form-control" name="stock" value="{{ $product->stock }}">
                                </div>
                            </div>

                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                                <div class="col-sm-12 col-md-7">
                                    <button type="submit" class="btn btn-primary">Edit</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </section>
@endsection
