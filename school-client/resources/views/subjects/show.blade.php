@extends('layouts.app')
@section('title', 'Subject')

@section('content')
<div class="d-flex align-items-center gap-2 mb-4">
    <a href="{{ route('subjects.index') }}" class="btn btn-sm btn-outline-secondary">← Back</a>
    <h4 class="mb-0">Subject details</h4>
</div>

<div class="card p-4" style="max-width:520px">
    <dl class="row mb-0">
        <dt class="col-sm-3 text-muted small">ID</dt>
        <dd class="col-sm-9 font-monospace">{{ $subject['id'] }}</dd>

        <dt class="col-sm-3 text-muted small">Name</dt>
        <dd class="col-sm-9 fw-medium">{{ $subject['name'] }}</dd>

        <dt class="col-sm-3 text-muted small">Teacher</dt>
        <dd class="col-sm-9">
            @if(!empty($subject['teacher']))
                {{ $subject['teacher']['name'] ?? '—' }}
            @else
                <span class="text-muted">Not assigned</span>
            @endif
        </dd>
    </dl>

    <div class="d-flex gap-2 mt-3">
        <a href="{{ route('subjects.edit', $subject['id']) }}" class="btn btn-dark">Edit / Assign teacher</a>
        <form method="POST" action="{{ route('subjects.destroy', $subject['id']) }}"
              onsubmit="return confirm('Delete this subject?')">
            @csrf @method('DELETE')
            <button class="btn btn-outline-danger">Delete</button>
        </form>
    </div>
</div>
@endsection
