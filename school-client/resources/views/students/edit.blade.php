@extends('layouts.app')
@section('title', 'Edit Student')

@section('content')
<div class="d-flex align-items-center gap-2 mb-4">
    <a href="{{ route('students.index') }}" class="btn btn-sm btn-outline-secondary">← Back</a>
    <h4 class="mb-0">Edit Student</h4>
</div>

<div class="card p-4" style="max-width:520px">
    <form method="POST" action="{{ route('students.update', $student['id']) }}">
        @csrf @method('PUT')

        <div class="mb-3">
            <label class="form-label fw-medium text-muted small">Student ID</label>
            <input type="text" class="form-control bg-light" value="{{ $student['id'] }}" disabled>
        </div>

        <div class="mb-3">
            <label for="name" class="form-label fw-medium">Full Name</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror"
                   id="name" name="name" value="{{ old('name', $student['name']) }}" required>
            @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="mb-4">
            <label for="email" class="form-label fw-medium">Email</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror"
                   id="email" name="email" value="{{ old('email', $student['email']) }}" required>
            @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-dark">Update Student</button>
            <a href="{{ route('students.index') }}" class="btn btn-outline-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection
