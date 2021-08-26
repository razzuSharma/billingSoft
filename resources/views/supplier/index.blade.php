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
                    <p class="fw-bold text-primary">Suppliers List</p>
                </div>
                <div class="col-md-2">
                    <a href="{{ route('supplier.add') }}" class="btn btn-sm btn-outline-primary float-right">Add Supplier</a>
                </div>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered text-center mt-3 bg-light">
                <thead class="fw-bold">
                    <tr>
                        <td>S.N.</td>
                        <td>Name</td>
                        <td>Address</td>
                        <td>Contact</td>
                        <td>Contact Person</td>
                        <td>Pan No.</td>
                        <td>Email</td>
                        <td>Remark</td>
                        <td>Action</td>
                    </tr>
                </thead>

                <tbody>
                    @php
                        $i = 0;
                    @endphp
                    @foreach ($supplier as $value)
                    <tr>
                        <td>{{ ++$i }}</td>
                        <td>{{ $value->name }}</td>
                        <td>{{ $value->address }}</td>
                        <td>{{ $value->contact }}</td>
                        <td>{{ $value->contact_person }}</td>
                        <td>{{ $value->pan_no }}</td>
                        <td>{{ $value->email }}</td>
                        <td>{{ $value->remark }}</td>
                        <td>
                            <a href="{{ route('supplier.edit', ['id'=>$value->id]) }}" class="btn btn-sm btn-success">Edit</a>
                            <a href="" class="btn btn-sm btn-danger">Delete</a>
                        </td>
                    </tr>
                        
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    
@endsection