@extends('layouts.app')
@section('title', 'New Student')

@section('content')
<div class="d-flex align-items-center gap-2 mb-4">
    <a href="{{ route('students.index') }}" class="btn btn-sm btn-outline-secondary">← Back</a>
    <h4 class="mb-0">New Student</h4>
</div>

<div class="card p-4" style="max-width:520px">
    <form method="POST" action="{{ route('students.store') }}">
        @csrf

        <div class="mb-3">
            <label for="id" class="form-label fw-medium">Student ID</label>
            <input type="text" class="form-control @error('id') is-invalid @enderror"
                   id="id" name="id" value="{{ old('id') }}"
                   placeholder="e.g. student-001 or a UUID" required>
            @error('id')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="mb-3">
            <label for="name" class="form-label fw-medium">Full Name</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror"
                   id="name" name="name" value="{{ old('name') }}"
                   placeholder="e.g. Joan Puig" required>
            @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="mb-4">
            <label for="email" class="form-label fw-medium">Email</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror"
                   id="email" name="email" value="{{ old('email') }}"
                   placeholder="e.g. joan@school.com" required>
            @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-dark">Create Student</button>
            <a href="{{ route('students.index') }}" class="btn btn-outline-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection
