@extends('layout')

@section('content')
    <div class="card">
        <div class="card-header">Student Details</div>
        <div class="card-body">
            <h5 class="card-title">Name: {{ $student->name }}</h5>
            <p class="card-text">Address: {{ $student->address }}</p>
            <p class="card-text">Mobile: {{ $student->mobile }}</p>
            <hr>
            <a href="{{ url('/students') }}" class="btn btn-secondary">Back to List</a>
        </div>
    </div>
@endsection
