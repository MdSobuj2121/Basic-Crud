@extends('layout')

@section('content')
    <div class="card">
        <div class="card-header">
            <h2>Batches</h2>
        </div>
        <div class="card-body">
            <a href="{{ url('/batches/create') }}" class="btn btn-success btn-sm" title="Add New Course">
                <i class="fa fa-plus" aria-hidden="true"></i> Add New
            </a>
            <br />
            <br />
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>SL</th>
                            <th>Batch Name</th>
                            <th>Course</th>
                            <th>Start Date</th>
                            <th>Actions</th> <!-- Added this header for the buttons -->
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($batches as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->course->name }}</td>
                                <td>{{ $item->start_date }}</td>
                                <td>
                                    <a href="{{ url('/batches/' . $item->id) }}" class="btn btn-info btn-sm" title="View Batch">
                                        <i class="fa fa-eye" aria-hidden="true"></i> View
                                    </a>
                                    <a href="{{ url('/batches/' . $item->id . '/edit') }}" class="btn btn-warning btn-sm" title="Edit Batch">
                                        <i class="fa fa-edit" aria-hidden="true"></i> Edit
                                    </a>
                                    <form method="POST" action="{{ url('/batches/' . $item->id) }}" accept-charset="UTF-8" style="display:inline;">
                                        {{ method_field('DELETE') }}
                                        {{ csrf_field() }}
                                        <button type="submit" class="btn btn-danger btn-sm" title="Delete Batch" onclick="return confirm('Are you sure you want to delete this batch?');">
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
