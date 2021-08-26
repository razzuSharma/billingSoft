@extends('layouts.app')
@section('content')
    <div class="container">
        <h4 class="text-center text-primary mb-4">RETURN PURCHASE</h4>
        <div class="card card-body">
            <form action="{{ route('purchaseitem.return', ['id' => $purchase->id]) }}" class="row" method="POST">
                @csrf
                <div class="col">
                    <select name="purchase_item_id" id="" class="form-control">
                        @foreach ($purchases as $purchase)
                            @foreach ($purchase->PurchaseItem as $col)
                                @if ($col->purchase_item_type != 'return')
                                    @foreach ($stocks as $stock)
                                        @if ($stock->purchase_item_id == $col->id && $stock->quantity != 0)
                                            <option value="{{ $col->id }}">{{ $col->product->name }} / {{ $stock->quantity }}</option>  
                                        @endif 
                                    @endforeach
                                @endif
                            @endforeach
                        @endforeach
                    </select>
                </div>
                <div class="col">
                    <input type="number" name="quantity" placeholder="Quantity" class="form-control">
                </div>
                <div class="col">
                    <input value="RETURN" class="btn btn-md btn-outline-primary" type="submit">
                </div>
            </form>

            <div class="row">
                <div class="col">
                    <a href="{{ route('purchase.bill', ['id'=>$purchase->id]) }}" class="btn btn-md btn-primary">DONE</a>
                </div>
            </div>
        </div>

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
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i = 0;
                        @endphp
                        @foreach ($returnedItems as $row)
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
                                    <td>{{ $totalAmount }}</td>
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
                                    <td>{{ (($totalAmount - $discountAmount) + $purchase->shipping_cost) - ($purchase->adjustable_discount/100 * ($totalAmount - $discountAmount)) }}</td>
                                </tr>
                            </div>
                        </div>
                    </tfoot>
                </table>
            </div>
        </div>

    </div>
@endsection