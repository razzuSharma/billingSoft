@extends('layouts.app')
@section('content')
    <div çlass='container'> 
        <div class="card card-body">
            <form method="POST" action="/customer/save">
                @csrf
                <label for="">Name</label>
                <input type="text" name="name" placeholder="enter name" class="form-control">
                <label for="">Contact</label>
                <input type="text" name="contact" placeholder="enter contact" class="form-control">
                <br>
                <input value="Submit" class="btn btn-sm btm-primary" type="submit">
            </form>
        </div>
    </div>
    
@endsection