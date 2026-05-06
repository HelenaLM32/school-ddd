@extends('layouts.app')
@section('title', 'Subjects')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="mb-0">Subjects</h4>
    <a href="{{ route('subjects.create') }}" class="btn btn-dark">+ New Subject</a>
</div>

<div class="card">
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Teacher</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($subjects as $subject)
                <tr>
                    <td class="text-muted small align-middle font-monospace">{{ $subject['id'] }}</td>
                    <td class="align-middle fw-medium">{{ $subject['name'] }}</td>
                    <td class="align-middle">
                        @if(!empty($subject['teacher']))
                        <span class="badge bg-secondary">{{ $subject['teacher']['name'] ?? $subject['teacher_id'] ?? '—' }}</span>
                        @else
                        <span class="text-muted small">—</span>
                        @endif
                    </td>
                    <td class="text-end align-middle">
                        <a href="{{ route('subjects.edit', $subject['id']) }}"
                            class="btn btn-sm btn-outline-primary btn-action me-1">Edit / Assign</a>
                        <form method="POST" action="{{ route('subjects.destroy', $subject['id']) }}"
                            class="d-inline"
                            onsubmit="return confirm('Delete subject ?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger btn-action">Delete</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center text-muted py-4">
                        No subjects found.
                        <a href="{{ route('subjects.create') }}">Create the first one</a>.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection