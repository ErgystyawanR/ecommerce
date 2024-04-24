@extends('layouts.app')
@section('content')
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    @if (Session::has('success'))
                        <div class="alert alert-success" role="alert">
                            {{ Session::get('success') }}
                        </div>
                    @elseif(Session::has('error'))
                        <div class="alert alert-danger" role="alert">
                            {{ Session::get('error') }}
                        </div>
                    @endif
                    <div class="card-header">
                        <h4>Profile</h4>
                    </div>

                    <h2 class="section-title">Hi, {{ $user->name }}</h2>
                    <p class="section-lead">
                        Change information about yourself on this page.
                    </p>

                    <div class="row mt-sm-4">

                        <div class="col-12 col-md-12 col-lg-7">
                            <div class="card">

                                <div class="card-header">
                                    <h4>Edit Profile</h4>
                                </div>
                                <form action="{{ route('update_profile') }}" method="post">
                                    @csrf
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="form-group col-md-6 col-12">
                                                <label>Name</label>
                                                <input type="text" name="name" class="form-control"
                                                    value="{{ $user->name }}" required="">
                                                <div class="invalid-feedback">
                                                    Please fill in the first name
                                                </div>
                                            </div>
                                            <div class="form-group col-md-6 col-12">
                                                <label>Email</label>
                                                <input type="email" name="email" class="form-control"
                                                    value="{{ $user->email }}" placeholder = "@email.com" required="">
                                                <div class="invalid-feedback">
                                                    Please fill in the email
                                                </div>
                                            </div>
                                            
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-6 col-12">
                                                <label>Password<span style="color: red"> *optional</span></label>
                                                <input type="password" name="password" class="form-control"
                                                    placeholder="********">
                                            </div>
                                            <div class="form-group col-md-6 col-12">
                                                <label>Confirm Password<span style="color: red"> *optional</span></label>
                                                <input type="password" name="confirmPassword" class="form-control"
                                                    placeholder="********">

                                            </div>
                                            <div class="form-group col-md-12 col-12">
                                                <label for="address">Address</label>
                                                <textarea id="address" name="address" class="form-control" rows="5" cols="5">{{ $user->address }}</textarea>
                                            </div>
                                        </div>
                                        <div class="card-footer text-right">
                                            <button class="btn btn-primary" type="submit">Save Changes</button>
                                        </div>
                                    </div>
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
