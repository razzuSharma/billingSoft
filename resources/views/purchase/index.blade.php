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
                <p class="fw-bold text-primary">Purchase List</p>
            </div>
            <div class="col-md-2">
                <a href="{{ route('purchase.add') }}" class="btn btn-sm btn-outline-primary float-right">Add Purchase</a>
            </div>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered text-center mt-3 bg-light">
            <thead class="fw-bold">
                <tr>
                    <td>S.N.</td>
                    <td>Date</td>
                    <td>Invoice No.</td>
                    <td>Supplier</td>
                    <td>Purchase Type</td>
                    <td>User</td>
                    <td>Remark</td>
                    <td>Action</td>
                </tr>
            </thead>
            <tbody>
                @php
                    $i = 0;
                @endphp
                @foreach ($purchase as $value)
                    <tr>
                        <td>{{ ++$i }}</td>
                        <td>{{ $value->date }}</td>
                        <td>{{ $value->invoice_no }}</td>
                        <td>{{ $value->supplier->name }}</td>
                        <td>{{ $value->purchase_type }}</td>
                        <td>{{ $value->user->name }}</td>
                        <td>{{ $value->remark }}</td>
                        <td>
                            <a href="{{ route('purchase.edit',['id'=>$value->id]) }}" class="btn btn-sm btn-outline-success">Edit</a>
                            @if ($value->status == 'Completed')
                                <a href="{{ route('purchase.bill', ['id'=>$value->id]) }}" class="btn btn-sm btn-outline-success">Statement</a>
                            @elseif ($value->status == 'Running' && $value->purchase_type != 'Return')
                                <a href="{{ route('purchaseitem.add', ['id'=>$value->id]) }}" class="btn btn-sm btn-outline-success">Continue</a>
                            @else
                                <a href="{{ route('purchase.return', ['id'=>$value->id]) }}" class="btn btn-sm btn-outline-success">Continue</a>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>
@endsection