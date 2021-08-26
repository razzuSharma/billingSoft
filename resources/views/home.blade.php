@extends('layouts.app')

@section('content')
<div class="row bg-light">
    <div class="col-md-8">
        <h3 class="mt-2 text-secondary">Dashboard</h3>
    </div> 
    
    <div class="col-md-4 text-secondary text-center">
        <h5>Username: {{ Auth::user()->name }}</h5>
        <h5>E-mail: {{ Auth::user()->email }}</h5>
        <div class="row">
            <div class="col-md-2">

            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-md-6">
        <div class="card text-center">
            <div class="card-header fw-bold bg-dark text-white">Company</div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-sm table-hover">
                        <thead>
                            <tr>
                                <th>S.N.</th>
                                <th>Name</th>
                                <th>Address</th>
                                <th>Country</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $i = 0;
                            @endphp
                            @foreach ($company as $value)
                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td>{{ $value->name }}</td>
                                    <td>{{ $value->address }}</td>
                                    <td>{{ $value->country }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card text-center">
            <div class="card-header fw-bold bg-dark text-white">Supplier</div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-sm table-hover">
                        <thead>
                            <tr>
                                <th>S.N.</th>
                                <th>Name</th>
                                <th>Address</th>
                                <th>Contact</th>
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
                                </tr> 
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-md-6 mb-5">
        <div class="card text-center">
            <div class="card-header fw-bold bg-dark text-white">Product</div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-sm table-hover">
                        <thead>
                            <tr>
                                <th>S.N.</th>
                                <th width='40%'>Name</th>
                                <th>Category</th>
                                <th>Unit</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $i = 0;
                            @endphp
                            @foreach ($product as $value)
                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td>{{ $value->name }}</td>
                                    <td>{{ $value->category }}</td>
                                    <td>{{ $value->unit }}</td>
                                </tr> 
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6 mb-5">
        <div class="card text-center">
            <div class="card-header fw-bold bg-dark text-white">Customer</div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-sm table-hover">
                        <thead>
                            <tr>
                                <th>S.N.</th>
                                <th>Name</th>
                                <th>Contact</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $i = 0;
                            @endphp
                            @foreach ($customer as $value)
                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td>{{ $value->name }}</td>
                                    <td>{{ $value->contact }}</td>
                                </tr> 
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
