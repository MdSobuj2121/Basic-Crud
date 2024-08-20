@extends('layout')

@section('content')
    <div class="card">
        <div class="card-header">Edit Teacher</div>
        <div class="card-body">
            <form action="{{ url('teachers/' . $teacher->id) }}" method="post">
                @csrf
                @method('PATCH')
                <input type="hidden" name="id" id="id" value="{{ $teacher->id }}" />

                <label>Name</label>
                <input type="text" name="name" id="name" value="{{ $teacher->name }}" class="form-control" />

                <label>Address</label>
                <input type="text" name="address" id="address" value="{{ $teacher->address }}" class="form-control" />

                <label>Mobile</label>
                <input type="text" name="mobile" id="mobile" value="{{ $teacher->mobile }}" class="form-control" />

                <br>
                <input type="submit" value="Update" class="btn btn-success" />
            </form>
        </div>
    </div>
@stop
