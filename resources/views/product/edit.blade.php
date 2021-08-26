@extends('layouts.app')
@section('content')
    <div çlass='container'> 
        <div class="card card-body">
            <h5 class="font-weight-bold">Edit Product {{ $product->name }}</h5>
            <form method="POST" action="{{ route('product.update', ['id'=>$product->id]) }}">
                @csrf
                <label for="">Code</label>
                <input type="text" name="code" value="{{ $product->code }}" class="form-control">
                <label for="">Barcode</label>
                <input type="text" name="barcode" value="{{ $product->barcode }}" class="form-control">
                <label for="">Name</label>
                <input type="text" name="name" value="{{ $product->name }}" class="form-control">
                <label for="">Category</label>
                <input type="text" name="category" value="{{ $product->category }}" class="form-control">
                <label for="">Unit</label>
                <input type="text" name="unit" value="{{ $product->unit }}" class="form-control">
                <label for="">Pack</label>
                <input type="text" name="pack" value="{{ $product->pack }}" class="form-control">
                <label for="">Company</label>
                <select name="company_id" id="" class="form-control">
                    @foreach ($company as $value)
                        <option value="{{ $value->id }}">{{ $value->name }}</option>
                    @endforeach
                </select>
                <input value="Update" class="btn btn-sm btm-primary" type="submit">
            </form>
        </div>
    </div>
@endsection