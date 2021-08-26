@extends('layouts.app')
@section('content')
    <div çlass='container'> 
        <div class="card card-body">
            <h5 class="font-weight-bold">Edit Purchase {{ $purchase->name }}</h5>
            <form method="POST" action="{{ route('purchase.update', ['id'=>$purchase->id]) }}">
                @csrf
                <label for="">Date</label>
                <input type="text" name="date" value="{{ $purchase->date }}" class="form-control">
                <label for="">Invoice Number</label>
                <input type="text" name="invoice_no" value="{{ $purchase->invoice_no }}" class="form-control">
                <label for="">Supplier</label>
                <select name="supplier_id" id="" class="form-control">
                    @foreach ($supplier as $value)
                        <option value="{{ $value->id }}">{{ $value->name }}</option>
                    @endforeach
                </select>
                <label for="">Purchase Type</label>
                <select name="purchase_type" id="" class="form-control">
                    <option value="Direct">Direct</option>
                    <option value="Order">Order</option>
                    <option value="Cancelled">Cancelled</option>
                </select>
                <label for="">Remark</label>
                <input type="text" name="remark" value="{{ $purchase->remark }}" class="form-control">
                <br>
                <input value="Update" class="btn btn-sm btm-primary" type="submit">
            </form>
        </div>
    </div>
@endsection