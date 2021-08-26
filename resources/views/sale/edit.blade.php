@extends('layouts.app')
@section('content')
    <div class="container mt-5">
        <form action="{{ route('sales.update', ['id' => $sale->id]) }}" method="POST" class="row">
            @csrf
            <div class="col-md-3">
                <label for="">Date</label>
                <input type="date" name="date" value="{{ $sale->date }}" class="form-control">
            </div>
            <div class="col-md-3">
                <label for="">Invoice No.</label>
                <input type="text" name="invoice_no" value="{{ $sale->invoice_no }}" class="form-control">
            </div>
            <div class="col-md-3">
                <label for="">Customer</label>
                <select name="customer_id" id="" class="form-control" required>
                    <option value="">Select Customer</option>
                    @foreach ($customers as $customer)
                        <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <label for="">Sales Type</label>
                <select name="sales_type" class="form-control" required>
                    <option value="Cash">Cash</option>
                    <option value="Credit">Credit</option>
                </select>
            </div>
            <div class="col-md-4 mt-2">
                <input type="submit" value="UPDATE" class="btn btn-md btn-primary">
            </div>
        </form>
    </div>
@endsection