@extends('layouts.app')
@section('content')

    <div class="container">
        <form class="row mt-3" method="POST" action="{{ route('supplierledger.show') }}">
            @csrf
            <div class="col-md-4">
                <select name="supplier_id" id="" class="form-control" required>
                    <option value="">Select Supplier</option>
                    @foreach ($suppliers as $supplier)
                        <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <input class="btn btn-primary" value="Generate" type="submit">
            </div>
        </form>
        {{-- <a href="{{ route('supplier.pay') }}">Pay</a> --}}

        <div class="row mt-5">

            @if ($supplierLedger)
                @if ($supplierLedger->count() != 0)
                    <h3 class="text-primary text-center">Supplier Ledger of {{ $supplierName->name }}</h3><hr size="3">
                    <div class="table-responsive">
                        <table class="table table-bordered mt-2 bg-light">
                            <thead class="fw-bold text-center">
                                <th>S.N.</th>
                                <th>Date</th>
                                <th>Invoice Number</th>
                                <th>Dr.</th>
                                <th>Cr.</th>
                                <th>Balance</th>
                                <th>Remark</th>
                            </thead>
                            <tbody>
                                @php
                                    $i = 0;
                                @endphp
                                @foreach ($supplierLedger as $value)
                                    <tr>
                                        <td>{{ ++$i }}</td>
                                        <td>{{ $value->date }}</td>
                                        <td>{{ $value->invoice_no }}</td>
                                        <td>{{ $value->dr }}</td>
                                        <td>{{ $value->cr }}</td>
                                        <td>{{ $value->balance }}</td>
                                        <td>{{ $value->purchase_type }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                
                @else
                    <h1 class="text-center text-danger mt-5">Ledger doesn't exist of {{ $supplierName->name }} Supplier</h1>
                    <h5 class="text-center text-danger">No Purchase Yet</h5>
                @endif
            @else
                <h1 class="text-center text-black-50 mt-5">Your Content Will Appear Here...</h1>              
            @endif
        </div>

    </div>
@endsection