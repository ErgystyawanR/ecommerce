@extends('layouts.app')
@section('content')
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Add Product</h4>
                    </div>
                    <form action="{{ route('store_product') }}" method="post" enctype="multipart/form-data">
                      @csrf          
                    <div class="card-body">
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Name</label>
                            <div class="col-sm-12 col-md-7">
                                <input type="text" class="form-control" name="name">
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Price</label>
                            <div class="col-sm-12 col-md-7">
                                <input type="text" class="form-control" name="price">
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Description</label>
                            <div class="col-sm-12 col-md-7">
                                <textarea class="form-control" name="description"></textarea>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                          <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Upload gambar</label>
                          <div class="col-sm-12 col-md-7">
                              <div class="custom-file">
                                  <input type="file" class="custom-file-input" id="customFile" name="image" onchange="document.getElementById('customFileLabel').innerHTML = this.files[0].name">
                                  <label class="custom-file-label" for="customFile" id="customFileLabel">Choose file</label>
                              </div>
                          </div>
                      </div>
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Stock</label>
                            <div class="col-sm-12 col-md-7">
                                <input type="text" class="form-control" name="stock">
                            </div>
                        </div>

                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                            <div class="col-sm-12 col-md-7">
                                <button class="btn btn-primary">Add</button>
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
