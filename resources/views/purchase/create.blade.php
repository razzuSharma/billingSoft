@extends('layouts.app')
@section('content')
    <div çlass='container'> 
        <div class="card card-body">
            <form method="POST" action="/purchase/save">
                @csrf
                <label for="">Date</label>
                <input type="date" name="date" placeholder="enter date" class="form-control">
                <label for="">Invoice Number</label>
                <input type="text" name="invoice_no" placeholder="enter Invoice Number" class="form-control">
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
                    <option value="Return">Return</option>
                </select>
                <label for="">Remark</label>
                <input type="text" name="remark" placeholder="enter Remark" class="form-control">
                <br>
                <input value="Next" class="btn btn-md btn-outline-primary" type="submit">
            </form>
        </div>
    </div>
    
@endsection