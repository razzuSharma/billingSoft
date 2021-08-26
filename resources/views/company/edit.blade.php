@extends('layouts.app')
@section('content')
<div class="container">
    <div class="card card-body">
        <h5 class="font-weight-bold">Edit Company {{ $company->name }}</h5>
        <form method="POST" action="{{ route('company.update', ['id'=>$company->id]) }}">
            @csrf
            <label for="">Name</label>
            <input type="text" name="name" value="{{ $company->name }}" class="form-control">
            <label for="">Address</label>
            <input type="text" name="address" value="{{ $company->address }}" class="form-control">
            <label for="">Country</label>
            <input type="text" name="country" value="{{ $company->country }}" class="form-control">
            <br>
            <input value="Update" class="btn btn-sm btm-primary" type="submit">
        </form>
    </div>
</div>
@endsection