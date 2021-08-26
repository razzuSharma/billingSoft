@extends('layouts.app')
@section('content')
    
    <div class="card card-body shadow-sm mt-5 mb-5">
        @if (Session::has('success'))
            <div class="alert alert-success">
                {{ Session::get('success') }}
            </div>
        @endif

        <div class="card card-body mt-4 bg-light">
            <div class="row">
                <div class="col-md-10">
                    <p class="fw-bold text-primary">Products List</p>
                </div>
                <div class="col-md-2">
                    <a href="{{ route('product.add') }}" class="btn btn-sm btn-outline-primary float-right">Add Product</a>
                </div>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered text-center mt-3 bg-light">
                <thead class="fw-bold">
                    <tr>
                        <td>S.N.</td>
                        <td>Code</td>
                        <td>Barcode</td>
                        <td>Name</td>
                        <td>Category</td>
                        <td>Unit</td>
                        <td>Pack</td>
                        <td>Company</td>
                        <td>Action</td>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $i = 0;
                    @endphp
                    @foreach ($product as $value)
                        <tr>
                            <td>{{ ++$i }}</td>
                            <td>{{ $value->code }}</td>
                            <td>{{ $value->barcode }}</td>
                            <td>{{ $value->name }}</td>
                            <td>{{ $value->category }}</td>
                            <td>{{ $value->unit }}</td>
                            <td>{{ $value->pack }}</td>
                            <td>{{ $value->company->name }}</td>
                            <td>
                                <a href="{{ route('product.edit', ['id'=>$value->id]) }}" class="btn btn-sm btn-outline-success">Edit</a> |
                                <a href="" class="btn btn-sm btn-outline-danger">Delete</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>

@endsection