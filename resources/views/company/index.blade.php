@extends('layouts.app')
@section('content')

    <div class="card card-body shadow-sm mt-5 mb-5">
        @if (Session::has('success'))
        <script>
            swal("Added", "{{ Session::get('success') }}", "success");
        </script>
        @elseif (Session::has('remove'))
        <script>
            swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this imaginary file!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
              if (willDelete) {
                swal("{{ Session::get('remove') }}", {
                  icon: "success",
                });
              } else {
                swal("Your imaginary file is safe!");
              }
            });
        </script>
        @endif
        
        <div class="card card-body mt-4 bg-light">
            <div class="row">
                <div class="col-md-10">
                    <p class="fw-bold text-secondary">Company List</p>
                </div>
                <div class="col-md-2">
                    <a href="{{ route('company.add') }}" class="btn btn-sm btn-outline-primary float-right">Add Company</a>
                </div>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table text-center table-bordered mt-3 bg-light">
                <thead class="fw-bold">
                    <tr>
                        <td>S.N.</td>
                        <td>Name</td>
                        <td>Address</td>
                        <td>Country</td>
                        <td>User</td>
                        <td>Action</td>
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
                        <td>{{ $value->user->name }}</td>
                        <td>
                            <div class="row">
                                <div class="col-md-6">
                                    <a href="{{ route('company.edit',['id'=>$value->id]) }}" class="btn btn-sm btn-success">Edit</a>
                                </div>
                                <div class="col-md-6">
                                    <form action="{{ route('company.delete', ['id'=>$value->id]) }}" method="POST">
                                        @csrf
                                        <button class="btn btn-outline-danger btn-sm" role="submit">Delete</button>
                                    </form>
                                </div>
                            </div>
                        </td>
                    </tr>
                        
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection