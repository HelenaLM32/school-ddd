@extends('layouts.app')
@section('title', 'Students')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="mb-0">Students</h4>
    <a href="{{ route('students.create') }}" class="btn btn-dark">+ New Student</a>
</div>

<div class="card">
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($students as $student)
                <tr>
                    <td class="text-muted small align-middle font-monospace">{{ $student['id'] }}</td>
                    <td class="align-middle fw-medium">{{ $student['name'] }}</td>
                    <td class="text-end align-middle">
                        <a href="{{ route('students.show', $student['id']) }}"
                            class="btn btn-sm btn-outline-secondary btn-action me-1">View</a>
                        <a href="{{ route('students.edit', $student['id']) }}"
                            class="btn btn-sm btn-outline-primary btn-action me-1">Edit</a>
                        <form method="POST" action="{{ route('students.destroy', $student['id']) }}"
                            class="d-inline"
                            onsubmit="return confirm('Delete student ?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger btn-action">Delete</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="text-center text-muted py-4">
                        No students found.
                        <a href="{{ route('students.create') }}">Create the first one</a>.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection