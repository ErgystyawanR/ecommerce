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
                        <h4><i class="fas fa-user"></i> User Management</h4>
                        @if (Auth::user()->is_admin)
                            <form action="{{ route('add_user') }}" method="get">
                                @csrf
                                <button type="submit" class="btn btn-primary ml-auto"><i class="fas fa-plus"></i>
                                    Add</button>
                            </form>
                        @endif
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-12 col-lg-12">
                            <div class="card">

                                <div class="card-body p-0">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-md">
                                            <tr>
                                                <th>#</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Created At</th>
                                                <th>Role</th>
                                                <th colspan="4">Action</th>
                                            </tr>
                                            @php
                                                // Calculate the starting number based on the current page
                                                $startingNumber = ($users->currentPage() - 1) * $users->perPage() + 1;
                                            @endphp
                                            @foreach ($users as $user)
                                                <tr>
                                                    <td>{{ $startingNumber }}</td>
                                                    <td>{{ $user->name }}</td>
                                                    <td>{{ $user->email }}</td>
                                                    <td>{{ $user->created_at->formatLocalized('%e %B %Y %H:%M') }}
                                                    </td>
                                                    <td>{{ $user->role }}</td>
                                                    @if ($user->role == 'user')
                                                        <td>
                                                            <form action="{{ route('create_admin', $user->id) }}"
                                                                method="post">
                                                                @csrf
                                                                <button type="submit" class="btn btn-success">Create
                                                                    Admin</button>
                                                            </form>

                                                        </td>
                                                    @endif
                                                    @if ($user->role == 'admin')
                                                        <td>
                                                            <form action="{{ route('create_user', $user->id) }}"
                                                                method="post">
                                                                @csrf
                                                                <button type="submit" class="btn btn-primary">Create
                                                                    User</button>
                                                            </form>

                                                        </td>
                                                    @endif
                                                    <td>
                                                        <form action="{{ route('delete_user', $user->id) }}"
                                                            method="post">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger"><i
                                                                    class="fas fa-trash"></i> Delete</button>
                                                        </form>
                                                    </td>

                                                </tr>
                                                @php
                                                    $startingNumber++;
                                                @endphp
                                            @endforeach
                                        </table>
                                    </div>
                                </div>
                                <div class="card-footer text-right">
                                    <nav class="d-inline-block">
                                        <ul class="pagination mb-0">

                                            @if ($users->currentPage() > 1)
                                                <li class="page-item">
                                                    <a class="page-link" href="{{ $users->previousPageUrl() }}"><i
                                                            class="fas fa-chevron-left"></i></a>
                                                </li>
                                            @endif

                                            @for ($i = 1; $i <= $users->lastPage(); $i++)
                                                <li class="page-item {{ $users->currentPage() == $i ? 'active' : '' }}">
                                                    <a class="page-link"
                                                        href="{{ $users->url($i) }}">{{ $i }}</a>
                                                </li>
                                            @endfor

                                            @if ($users->currentPage() < $users->lastPage())
                                                <li class="page-item">
                                                    <a class="page-link" href="{{ $users->nextPageUrl() }}"><i
                                                            class="fas fa-chevron-right"></i></a>
                                                </li>
                                            @endif

                                        </ul>
                                    </nav>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
