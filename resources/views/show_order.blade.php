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
        <div class="invoice">
            <div class="invoice-print">

                <div class="row">
                    <div class="col-lg-12">
                        <div class="invoice-title">
                            @if ($order->is_paid)
                                <div class="paid-stamp"></div>
                            @endif
                            <h2>Invoice</h2>

                            <div class="invoice-number">{{ $order->id }}</div>
                           
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <address>
                                    <strong>Billed To:</strong><br>
                                    {{ $order->user->name }}<br>
                                </address>
                            </div>
                            <div class="col-md-6 text-md-right">
                                <address>
                                    <strong>Address To:</strong><br>
                                    {{ $order->user->address }}<br>
                                </address>
                            </div>
                        </div>
                       
                        <div class="row">
                            <div class="col-md-6">
                                <address>
                                    <strong>Payment Method:</strong><br>
                                    <p>Transfer</p>
                                </address>
                            </div>
                            <div class="col-md-6 text-md-right">
                                <address>
                                    <strong>Order Date:</strong><br>
                                    {{ $order->created_at->format('F j, Y') }}<br><br>
                                </address>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-md-12">
                        <div class="section-title">Order Summary</div>
                        <p class="section-lead">All items here cannot be deleted.</p>
                        <div class="table-responsive">
                            <table class="table table-striped table-hover table-md">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Item</th>
                                        <th>Image</th>
                                        <th class="text-center">Price</th>
                                        <th class="text-center">Quantity</th>
                                        <th class="text-right">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $no = 1;
                                        $grandTotal = 0;
                                    @endphp
                                    @foreach ($order->transactions as $transaction)
                                        <tr>
                                            <td>{{ $no }}</td>
                                            <td> {{ $transaction->product->name }}</td>
                                            <td><img src="{{ url('storage/' . $transaction->product->image) }}"
                                                    alt="Iphone_11" height="100px">
                                            </td>
                                            <td>Rp {{ number_format($transaction->product->price, 0, ',', '.') }}</td>
                                            <td> {{ $transaction->amount }}</td>
                                            <td>Rp
                                                {{ number_format($transaction->amount * $transaction->product->price, 0, ',', '.') }}
                                            </td>
                                            @php
                                                $no++;
                                                $grandTotal += $transaction->amount * $transaction->product->price;
                                            @endphp
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                        <div class="row mt-4">
                            <div class="col-lg-8">
                                <div class="section-title">Payment Method</div>
                                <p class="section-lead">The payment method that we provide is to make it easier for you to
                                    pay invoices.</p>
                                <div class="images">
                                    <img src="{{ asset('/img/paypal.png') }}">
                                    <img src="{{ asset('/img/mastercard.png') }}">
                                    <img src="{{ asset('/img/visa.png') }}">
                                </div>
                            </div>
                            <div class="col-lg-4 text-right">


                                <hr class="mt-2 mb-2">
                                <div class="invoice-detail-item">
                                    <div class="invoice-detail-name">Totals</div>
                                    <div class="invoice-detail-value invoice-detail-value-lg">
                                        Rp {{ number_format($grandTotal, 0, ',', '.') }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="text-md-right">
                @if ($order->is_paid == false && $order->payment_receipt == null)
                    <form action="{{ route('submit_payment_receipt', $order) }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <p>Upload payment</p>
                        </div>

                        <div class="row">
                            <div class="form-group">
                                <input type="file" class="form-control" name="payment_receipt">
                            </div>
                        </div>
                        <div class="row mt-3">
                            <button class="btn btn-primary btn-icon icon-left mr-2"><i class="fas fa-credit-card"></i>
                                Submit Payment</button>
                        </div>
                    </form>
                    <form action="{{ route('delete_order', $order->id) }}" method="post">
                        @method('delete')
                        @csrf
                        <button class="btn btn-danger btn-icon icon-left"><i class="fas fa-times"></i> Cancel</button>
                    </form>
                @endif

            </div>
            </form>

        </div>
    </div>
    </div>
@endsection
