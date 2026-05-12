@extends('layouts.app')
@section('title', 'Teacher')

@section('content')
<div class="d-flex align-items-center gap-2 mb-4">
    <a href="{{ route('teachers.index') }}" class="btn btn-sm btn-outline-secondary">← Back</a>
    <h4 class="mb-0">Teacher details</h4>
</div>

<div class="card p-4" style="max-width:520px">
    <dl class="row mb-0">
        <dt class="col-sm-3 text-muted small">ID</dt>
        <dd class="col-sm-9 font-monospace">{{ $teacher['id'] }}</dd>

        <dt class="col-sm-3 text-muted small">Name</dt>
        <dd class="col-sm-9 fw-medium">{{ $teacher['name'] }}</dd>
    </dl>

    <div class="d-flex gap-2 mt-3">
        <a href="{{ route('teachers.edit', $teacher['id']) }}" class="btn btn-dark">Edit</a>
        <form method="POST" action="{{ route('teachers.destroy', $teacher['id']) }}"
            onsubmit="return confirm('Delete this teacher?')">
            @csrf @method('DELETE')
            <button class="btn btn-outline-danger">Delete</button>
        </form>
    </div>
</div>
@endsection