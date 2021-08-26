@extends('layouts.app')
@section('content')
    <div çlass='container'> 
        <div class="card card-body mt-5">

            <form method="POST" action="{{ route('purchaseitem.save', ['id'=>$purchase->id]) }}" class="row">
                @csrf
                <div class="col-md-4">
                    <select name="product_id" id="" class="form-control" required>
                        <option value="">Select Product</option>
                        @foreach ($product as $value)
                            <option value="{{ $value->id }}">{{ $value->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <input type="number" name="quantity" placeholder="Quantity" class="form-control" required>
                </div>
                <div class="col-md-2">
                    <input type="number" name="rate" placeholder="Rate" class="form-control" required>
                </div>
                <div class="col-md-2">
                    <input type="number" name="discount_percent" placeholder="Discount%" class="form-control">
                </div>
                <div class="col-md-2">
                    <input type="number" name="sp" placeholder="Selling Price" class="form-control" required>
                </div>
                <div class="col-md-2">
                    <input type="number" name="mrp" placeholder="Mrp" class="form-control" required>
                </div>
                <div class="col-md-12 mt-3">
                    <center><input value="DONE" class="btn btn-sm btn-outline-primary" type="submit"></center>
                </div>
            </form>
            <br>
        </div>

        <form action="{{ route('purchase.complete', ['id'=>$purchase->id]) }}" method="POST" class="row mt-3">
            @csrf
                <div class="col-md-4">
                    <input type="number" name="shipping_cost" placeholder="Shipping Cost" class="form-control">
                </div>
                <div class="col-md-4">
                    <input type="number" name="adjustable_discount" placeholder="Adjusable Discount" class="form-control">
                </div>
                <div class="col-md-4">
                    <input type="submit" value="DONE" class="btn btn-md btn-success">
                </div>
        </form>

        <div class="card card-body mt-3">
            <h5 class="text-center">{{ $purchase->purchase_type }} #{{ $purchase->id }}</h5>
            <div class="table-responsive">
                <table class="table table-bordered text-center mt-3 bg-light">
                    <thead>
                        <tr>
                            <th>S.N.</th>
                            <th>Product</th>
                            <th>Unit</th>
                            <th>Quantity</th>
                            <th>Rate</th>
                            <th>Amount</th>
                            <th>Discount %</th>
                            <th>Action</th>
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
                            <td>
                                <a href="{{ route('purchaseitem.delete', ['id'=>$row->id]) }}">Delete</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <div class="row">
                            <div class="col">
                                <tr>
                                    <td colspan="5" style="text-align:left" class="fw-bold">Total Amount</td>
                                    <td>{{ $total }}</td>
                                </tr>
                            </div>
                            <div class="col">
                                <tr>
                                    <td colspan="5" style="text-align:left" class="fw-bold">Discount Amount</td>
                                    <td>{{ $discountAmount }}</td>
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
                                    <td>{{ (($total - $discountAmount) + $purchase->shipping_cost) - ($purchase->adjustable_discount/100 * ($total - $discountAmount)) }}</td>
                                </tr>
                            </div>
                        </div>
                    </tfoot>
                </table>
            </div>
        </div>

    </div>
@endsection