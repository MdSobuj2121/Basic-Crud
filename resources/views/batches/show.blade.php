@extends('layout')

@section('content')
    <div class="card">
        <div class="card-header">Batch Details</div>
        <div class="card-body">
            <h5 class="card-title">Batch Name: {{ $batch->name }}</h5>
            <p class="card-text">Course: {{ $batch->course->name }}</p>
            <p class="card-text">Start Date: {{ $batch->start_date }}</p>
            <hr>
            <a href="{{ url('/batches') }}" class="btn btn-secondary">Back to List</a>
        </div>
    </div>
@endsection
