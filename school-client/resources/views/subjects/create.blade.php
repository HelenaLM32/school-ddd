@extends('layouts.app')
@section('title', 'New Subject')

@section('content')
<div class="d-flex align-items-center gap-2 mb-4">
    <a href="{{ route('subjects.index') }}" class="btn btn-sm btn-outline-secondary">← Back</a>
    <h4 class="mb-0">New Subject</h4>
</div>

<div class="card p-4" style="max-width:520px">
    <form method="POST" action="{{ route('subjects.store') }}">
        @csrf

        <div class="mb-3">
            <label for="id" class="form-label fw-medium">Subject ID</label>
            <input type="text" class="form-control @error('id') is-invalid @enderror"
                   id="id" name="id" value="{{ old('id') }}"
                   placeholder="e.g. subject-math-01" required>
            @error('id')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="mb-4">
            <label for="name" class="form-label fw-medium">Subject Name</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror"
                   id="name" name="name" value="{{ old('name') }}"
                   placeholder="e.g. Mathematics, Physics..." required>
            @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-dark">Create Subject</button>
            <a href="{{ route('subjects.index') }}" class="btn btn-outline-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection
