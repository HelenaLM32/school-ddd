@extends('layouts.app')
@section('title', 'Teachers')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="mb-0">Teachers</h4>
    <a href="{{ route('teachers.create') }}" class="btn btn-dark">+ New Teacher</a>
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
                @forelse($teachers as $teacher)
                <tr>
                    <td class="text-muted small align-middle font-monospace">{{ $teacher['id'] }}</td>
                    <td class="align-middle fw-medium">{{ $teacher['name'] }}</td>
                    <td class="text-end align-middle">
                        <a href="{{ route('teachers.show', $teacher['id']) }}"
                            class="btn btn-sm btn-outline-secondary btn-action me-1">View</a>
                        <a href="{{ route('teachers.edit', $teacher['id']) }}"
                            class="btn btn-sm btn-outline-primary btn-action me-1">Edit</a>
                        <form method="POST" action="{{ route('teachers.destroy', $teacher['id']) }}"
                            class="d-inline"
                            onsubmit="return confirm('Delete teacher?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger btn-action">Delete</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="text-center text-muted py-4">
                        No teachers found.
                        <a href="{{ route('teachers.create') }}">Create the first one</a>.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection