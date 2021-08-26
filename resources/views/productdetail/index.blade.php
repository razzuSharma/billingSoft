@extends('layouts.app')
@section('content')
    <h2 class="text-center text-primary mt-3">Item Stock</h2>
    <div class="card card-body shadow-sm mt-1 mb-5">
        <div class="table-responsive">
            <table class="table text-center table-bordered mt-3 bg-light">
                <thead class="fw-bold">
                    <tr>
                        <td>S.N.</td>
                        <td>Name</td>
                        <td>Batch</td>
                        <td>Quantity</td>
                        <td>SP</td>
                        <td>Mrp</td>
                        <td>Purchase</td>
                        <td>Supplier</td>
                    </tr>
                </thead>

                <tbody>
                    @php
                        $i = 0;
                    @endphp
                    @foreach ($productDetail as $row)
                        @if ($row->quantity != 0)
                            <tr>
                                <td>{{ ++$i }}</td>
                                <td>{{ $row->product->name }}</td>
                                <td>{{ $row->batch }}</td>
                                <td>{{ $row->quantity }}</td>
                                <td>{{ $row->sp }}</td>
                                <td>{{ $row->mrp }}</td>
                                <td>{{ $row->purchase_id }}</td>
                                <td>{{ $row->purchase->supplier->name }}</td>
                            </tr>
                        @endif   
                    @endforeach
                </tbody>

            </table>
        </div>
    </div>

@endsection