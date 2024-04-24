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
                    <div class="card-header">
                        <h4> <i class="fas fa-archive"></i> Orders</h4>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive table-invoice">
                            <table class="table table-striped">

                                <tr>
                                    <th>ID</th>
                                    <th>Customer</th>
                                    <th>Created_at</th>
                                    <th>Status</th>
                                    <th colspan="3">Action</th>
                                </tr>
                                @foreach ($orders as $order)
                                    <tr>
                                        <td>{{ $order->id }}</td>
                                        <td>{{ $order->user->name }}</td>
                                        <td>{{ $order->created_at->formatLocalized('%e %B %Y %H:%M') }}</td>
                                        <td>
                                            @if ($order->is_paid)
                                                <span class="badge badge-success">Paid</span>
                                            @else
                                                <span class="badge badge-warning">Pending</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($order->payment_receipt)
                                                <a href="{{ url('storage/' . $order->payment_receipt) }}" class="mr-1">Show Payment</a>
                                                <a href="{{ route('show_order', $order) }}">Show Invoice</a>
                                            @endif
                                        </td>
                                        <td>
                                            @if (!Auth::user()->is_admin && !$order->payment_receipt)
                                                <form action="{{ route('show_order', $order) }}" method="get">
                                                    @csrf
                                                    <button class="btn btn-success" type="submit"><i
                                                            class="fas fa-money-bill"></i>
                                                        Payment</button>
                                                </form>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($order->payment_receipt && !$order->is_paid && Auth::user()->is_admin)
                                                <form action="{{ route('confirm_payment', $order) }}" method="post">
                                                    @csrf
                                                    <button class="btn btn-success" type="submit"><i
                                                            class="fas fa-check"></i>
                                                        Confirm Payment</button>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </section>
@endsection
