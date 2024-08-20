@extends('layout')

@section('content')
    <div class="card">
        <div class="card-header">
            <h2>Enrollment Management</h2>
        </div>
        <div class="card-body">
            <a href="{{ url('/enrollments/create') }}" class="btn btn-success btn-sm" title="Add New Enrollment">
                <i class="fa fa-plus" aria-hidden="true"></i> Add New
            </a>
            <br />
            <br />
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>SL</th>
                            <th>Enroll No</th>
                            <th>Batch</th>
                            <th>Student</th>
                            <th>Join</th>
                            <th>Fee</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($enrollments as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->enroll_no }}</td>
                                <td>{{ $item->batch->name }}</td>
                                <td>{{ $item->student->name }}</td>
                                <td>{{ $item->join_date }}</td>
                                <td>{{ $item->fee }}</td>
                                <td>
                                    <a href="{{ url('/enrollments/' . $item->id) }}" class="btn btn-info btn-sm" title="View Enrollment">
                                        <i class="fa fa-eye" aria-hidden="true"></i> View
                                    </a>
                                    <a href="{{ url('/enrollments/' . $item->id . '/edit') }}" class="btn btn-warning btn-sm" title="Edit Enrollment">
                                        <i class="fa fa-edit" aria-hidden="true"></i> Edit
                                    </a>
                                    <form method="POST" action="{{ url('/enrollments/' . $item->id) }}" accept-charset="UTF-8" style="display:inline;">
                                        {{ method_field('DELETE') }}
                                        {{ csrf_field() }}
                                        <button type="submit" class="btn btn-danger btn-sm" title="Delete Enrollment" onclick="return confirm('Are you sure you want to delete this enrollment?');">
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
