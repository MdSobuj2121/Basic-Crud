@extends('layout')

@section('content')
    <div class="card">
        <div class="card-header">Edit Course</div>
        <div class="card-body">
            <form action="{{ url('courses/' . $course->id) }}" method="post">
                @csrf
                @method('PATCH')
                <input type="hidden" name="id" id="id" value="{{ $course->id }}" />

                <label>Name</label>
                <input type="text" name="name" id="name" value="{{ $course->name }}" class="form-control" />

                <label>Syllabus</label>
                <input type="text" name="syllabus" id="syllabus" value="{{ $course->syllabus }}" class="form-control" />

                <label>Duration</label>
                <input type="text" name="duration" id="duration" value="{{ $course->duration }}" class="form-control" />

                <br>
                <input type="submit" value="Update" class="btn btn-success" />
            </form>
        </div>
    </div>
@stop
