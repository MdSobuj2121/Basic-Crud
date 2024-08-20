@extends('layout')

@section('content')
    <div class="card">
        <div class="card-header">Edit Enrollment</div>
        <div class="card-body">
            <form action="{{ url('enrollments/' . $enrollment->id) }}" method="post">
                @csrf
                @method('PATCH')
                <input type="hidden" name="id" id="id" value="{{ $enrollment->id }}" />

                <label>Enroll No</label>
                <input type="text" name="enroll_no" id="enroll_no" value="{{ $enrollment->enroll_no }}" class="form-control" />

                <label>Batch</label>
                <input type="text" name="batch_id" id="batch_id" value="{{ $enrollment->batch_id }}" class="form-control" />

                <label>Student</label>
                <input type="text" name="student_id" id="student_id" value="{{ $enrollment->student_id }}" class="form-control" />

                <label>Join Date</label>
                <input type="date" name="join_date" id="join_date" value="{{ $enrollment->join_date }}" class="form-control" />

                <label>Fee</label>
                <input type="text" name="fee" id="fee" value="{{ $enrollment->fee }}" class="form-control" />

                <br>
                <input type="submit" value="Update" class="btn btn-success" />
            </form>
        </div>
    </div>
@stop
