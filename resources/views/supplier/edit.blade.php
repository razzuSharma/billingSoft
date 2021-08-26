@extends('layouts.app')
@section('content')
    <div çlass='container'> 
        <div class="card card-body">
            <h5 class="font-weight-bold">Edit Supplier {{ $supplier->name }}</h5>
            <form method="POST" action="{{ route('supplier.update', ['id'=>$supplier->id]) }}">
                @csrf
                <label for="">Name</label>
                <input type="text" name="name" value="{{ $supplier->name }}" class="form-control">
                <label for="">Address</label>
                <input type="text" name="address" value="{{ $supplier->address }}" class="form-control">
                <label for="">Contact</label>
                <input type="text" name="contact" value="{{ $supplier->contact }}" class="form-control">
                <label for="">Contact Person</label>
                <input type="text" name="contact_person" value="{{ $supplier->contact_person }}" class="form-control">
                <label for="">PAN Number</label>
                <input type="text" name="pan_no" value="{{ $supplier->pan_no }}" class="form-control">
                <label for="">E-mail</label>
                <input type="text" name="email" value="{{ $supplier->email }}" class="form-control">
                <label for="">Remark</label>
                <input type="text" name="remark" value="{{ $supplier->remark }}" class="form-control"><br>
                <input value="Update" class="btn btn-sm btm-primary" type="submit">
            </form>
        </div>
    </div>
@endsection