@extends('layouts.app')
@section('content')
    <div çlass='container'> 
        <div class="card card-body">
            <h5 class="font-weight-bold">Edit Customer {{ $customer->name }}</h5>
            <form method="POST" action="{{ route('customer.update', ['id'=>$customer->id]) }}">
                @csrf
                <label for="">Name</label>
                <input type="text" name="name" value="{{ $customer->name }}" class="form-control">
                <label for="">Contact</label>
                <input type="text" name="contact" value="{{ $customer->contact }}" class="form-control"><br>
                <input value="Update" class="btn btn-sm btm-primary" type="submit">
            </form>
        </div>
    </div>
@endsection