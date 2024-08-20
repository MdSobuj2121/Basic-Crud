@extends('layout')

@section('content')
    <div class="card">
        <div class="card-header">Teacher Details</div>
        <div class="card-body">
            <h5 class="card-title">Name: {{ $teacher->name }}</h5>
            <p class="card-text">Address: {{ $teacher->address }}</p>
            <p class="card-text">Mobile: {{ $teacher->mobile }}</p>
            <hr>
            <a href="{{ url('/teachers') }}" class="btn btn-secondary">Back to List</a>
        </div>
    </div>
@endsection
