@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="card card-body">
            <form method="POST" action="/company/save">
                @csrf
                <div>
                    <label for="">Name</label>
                    <input type="text" name="name" placeholder="Company name" class="form-control @error('name') is-invalid @enderror" required>
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div>
                    <label for="">Address</label>
                    <input type="text" name="address" placeholder="Company address" class="form-control @error('address') is-invalid @enderror" required>
                    @error('address')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div>
                    <label for="">Country</label>
                    <input type="text" name="country" placeholder="Country" class="form-control @error('country') is-invalid @enderror" required>
                    @error('country')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <br>
                <input value="Submit" class="btn btn-sm btm-primary" type="submit">
            </form>
        </div>
    </div>
@endsection