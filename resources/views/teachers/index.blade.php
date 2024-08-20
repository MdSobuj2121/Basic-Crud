@extends('layout')

@section('content')
    <div class="card">
        <div class="card-header">
            <h2>Teacher Application</h2>
        </div>
        <div class="card-body">
            <a href="{{ url('/teachers/create') }}" class="btn btn-success btn-sm" title="Add New Teacher">
                <i class="fa fa-plus" aria-hidden="true"></i> Add New
            </a>
            <br />
            <br />
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>SL</th>
                            <th>Name</th>
                            <th>Address</th>
                            <th>Mobile</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($teachers as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->address }}</td>
                                <td>{{ $item->mobile }}</td>
                                <td>
                                    <a href="{{ url('/teachers/' . $item->id) }}" class="btn btn-info btn-sm" title="View Teacher">
                                        <i class="fa fa-eye" aria-hidden="true"></i> View
                                    </a>
                                    <a href="{{ url('/teachers/' . $item->id . '/edit') }}" class="btn btn-warning btn-sm" title="Edit Teacher">
                                        <i class="fa fa-edit" aria-hidden="true"></i> Edit
                                    </a>
                                    <form method="POST" action="{{ url('/teachers/' . $item->id) }}" accept-charset="UTF-8" style="display:inline;">
                                        {{ method_field('DELETE') }}
                                        {{ csrf_field() }}
                                        <button type="submit" class="btn btn-danger btn-sm" title="Delete Teacher" onclick="return confirm('Are you sure you want to delete this teacher?');">
                                            <i class="fa fa-trash" aria-hidden="true"></i> Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
