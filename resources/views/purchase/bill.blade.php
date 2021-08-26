@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-11">
            <a href="{{ route('purchase.index') }}" class="btn btn-outline-primary"><span>&#8592;</span></a>
        </div>
        <div class="col-md-1">
            <button class="btn btn-sm btn-outline-primary active" onclick="window.print()">Print</button>
        </div>  
    </div>

    <div class="card card-body shadow-sm mt-5 mb-5">
        <div class="row">
            <div class="col-md-12">
                <h4 class="text-center">Blue Fox Pvt. Ltd.</h4>
            </div>
            <div class="row mt-4">
                <div class="col-md-5">
                    <p>Supplier Name: {{ $purchase->supplier->name }}</p>
                    <p>Supplier Address: {{ $purchase->supplier->address }}</p>
                </div>
                <div class="col-md-4">
                    <h6>{{ $purchase->purchase_type }} #{{ $purchase->id }}</h6> 
                </div>
                <div class="col-md-3">
                    <p>Date: {{ $purchase->date }}</p>
                    <p>Invoice: {{ $purchase->invoice_no }}</p>
                </div>
                <div class="row">
                    <div class="table-responsive">
                        <table class="table table-bordered text-center">
                            <thead class="fw-bold">
                                <tr>
                                    <th>S.N.</th>
                                    <th>Product</th>
                                    <th>Unit</th>
                                    <th>Qty.</th>
                                    <th>Rate</th>
                                    <th>Amount</th>
                                    <th>Discount%</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = 0;
                                @endphp
                                @foreach ($purchaseitem as $row)
                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td>{{ $row->product->name }}</td>
                                    <td>{{ $row->product->unit }}</td>
                                    <td>{{ $row->quantity }}</td>
                                    <td>{{ $row->rate }}</td>
                                    <td>{{ $row->amount }}</td>
                                    <td>{{ $row->discount_percent }}</td>
                                </tr>
                                @endforeach
                            </tbody>

                            <tfoot>
                                <div class="row">
                                    <div class="col">
                                        <tr>
                                            <td colspan="5" style="text-align:left" class="fw-bold">Total Amount</td>
                                            <td>{{ $totalamount }}</td>
                                        </tr>
                                    </div>
                                    <div class="col">
                                        <tr>
                                            <td colspan="5" style="text-align:left" class="fw-bold">Discount Amount</td>
                                            <td>{{ $discountamount }}</td>
                                        </tr>
                                    </div>
                                    <div class="col">
                                        <tr>
                                            <td colspan="5" style="text-align:left" class="fw-bold">Rounding Amount</td>
                                            <td>{{ number_format(($totalamount - $discountamount) - round($totalamount - $discountamount), 2) }}</td>
                                        </tr>
                                    </div>
                                    <div class="col">
                                        <tr>
                                            <td colspan="5" style="text-align:left" class="fw-bold">Shipping Cost</td>
                                            <td>{{ $purchase->shipping_cost }}</td>
                                        </tr>
                                    </div>
                                    <div class="col">
                                        <tr>
                                            <td colspan="5" style="text-align:left" class="fw-bold">Adjustable Discount</td>
                                            <td>{{ $purchase->adjustable_discount }}</td>
                                        </tr>
                                    </div>
                                    <div class="col">
                                        <tr>
                                            <td colspan="5" style="text-align:left" class="fw-bold">Net Amount</td>
                                            <td>{{ (($totalamount - $discountamount) + $purchase->shipping_cost) - (($purchase->adjustable_discount/100) * ($totalamount - $discountamount)) }}</td>
                                        </tr>
                                    </div>
                                </div>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-md-6" style="text-align:left">
                        <p>Checked By: </p>
                    </div>
                    <div class="col-md-6" style="text-align:right">
                        <p>User: {{ Auth::user()->name }}</p>
                    </div>
                </div>
                <hr>
            </div>
        </div>
    </div>
</div>
@endsection