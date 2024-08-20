@extends('layout')

@section('content')
<div class="container">
    <h2>Enrollment Status</h2>
    @if(isset($message))
        <p>{{ $message }}</p>
    @endif
    @if(isset($course))
        <p>You have successfully enrolled in the course: {{ $course->name }}</p>
    @endif
</div>
@endsection
