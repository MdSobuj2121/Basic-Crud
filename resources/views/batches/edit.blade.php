@extends('layout')

@section('content')
    <div class="card">
        <div class="card-header">Edit batch</div>
        <div class="card-body">
            <form action="{{ url('batches/' . $batch->id) }}" method="post">
                @csrf
                @method('PATCH')
                <input type="hidden" name="id" id="id" value="{{ $batch->id }}" />

                <label>Name</label>
                <input type="text" name="name" id="name" value="{{ $batch->name }}" class="form-control" />

                <label>Course</label>
                <input type="text" name="course_id" id="course_id" value="{{ $batch->course_id }}" class="form-control" />

                <label>Duration</label>
                <input type="text" name="start_date" id="start_date" value="{{ $batch->start_date }}" class="form-control" />

                <br>
                <input type="submit" value="Update" class="btn btn-success" />
            </form>
        </div>
    </div>
@stop
