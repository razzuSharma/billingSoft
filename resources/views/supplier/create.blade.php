@extends('layouts.app')
@section('content')
    <div çlass='container'> 
        <div class="card card-body">
            <form method="POST" action="/supplier/save">
                @csrf
                <label for="">Name</label>
                <input type="text" name="name" placeholder="name" class="form-control">
                <label for="">Address</label>
                <input type="text" name="address" placeholder="address" class="form-control">
                <label for="">Contact</label>
                <input type="text" name="contact" placeholder="contact" class="form-control">
                <label for="">Contact Person</label>
                <input type="text" name="contact_person" placeholder="contact_person" class="form-control">
                <label for="">PAN Number</label>
                <input type="text" name="pan_no" placeholder="pan_no" class="form-control">
                <label for="">E-mail</label>
                <input type="text" name="email" placeholder="email" class="form-control">
                <label for="">Remark</label>
                <input type="text" name="remark" placeholder="remark" class="form-control"><br>
                <input value="Submit" class="btn btn-sm btm-primary" type="submit">
            </form>
        </div>
    </div>
@endsection