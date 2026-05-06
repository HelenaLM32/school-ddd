@extends('layouts.app')

@section('title', 'Welcome')

@section('content')
<div class="row justify-content-center mt-5">
    <div class="col-md-5 text-center">
        <div class="card shadow-sm p-5">
            <h2 class="mb-1">School Client</h2>
            <p class="text-muted mb-4">
                SPA client for the <strong>school-ddd</strong> REST API.<br>
                Manage teachers, students and subjects.
            </p>
            <a href="{{ route('dashboard') }}" class="btn btn-dark btn-lg w-100">
                Go to Dashboard →
            </a>
        </div>
    </div>
</div>
@endsection