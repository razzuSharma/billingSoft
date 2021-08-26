@extends('layouts.app')
@section('content')

    <div çlass='container'> 
        <div class="card card-body">
            <form method="POST" action="/product/save">
                @csrf
                <label for="">Code</label>
                <input type="text" name="code" placeholder="enter code" class="form-control">
                <label for="">Barcode</label>
                <input type="text" name="barcode" placeholder="enter barcode" class="form-control">
                <label for="">Name</label>
                <input type="text" name="name" placeholder="enter name" class="form-control">
                <label for="">Category</label>
                <input type="text" name="category" placeholder="enter category" class="form-control">
                <label for="">Unit</label>
                <input type="text" name="unit" placeholder="enter unit" class="form-control">
                <label for="">Pack</label>
                <input type="text" name="pack" placeholder="enter pack" class="form-control">
                <label for="">Company</label>
                <select name="company_id" id="" class="form-control">
                    @foreach ($company as $value)
                        <option value="{{ $value->id }}">{{ $value->name }}</option>
                    @endforeach
                </select>
                <br>
                <input value="Submit" class="btn btn-sm btm-primary" type="submit">
            </form>
        </div>
    </div>
    
@endsection