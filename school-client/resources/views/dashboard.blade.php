@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<h4 class="mb-4">Dashboard</h4>

<div class="row g-3 mb-4">
    <div class="col-md-4">
        <div class="card p-3 text-center">
            <h2 class="mb-0">{{ count($teachers) }}</h2>
            <div class="text-muted small">Teachers</div>
            <a href="{{ route('teachers.index') }}" class="btn btn-sm btn-outline-dark mt-2">Manage</a>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card p-3 text-center">
            <h2 class="mb-0">{{ count($students) }}</h2>
            <div class="text-muted small">Students</div>
            <a href="{{ route('students.index') }}" class="btn btn-sm btn-outline-dark mt-2">Manage</a>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card p-3 text-center">
            <h2 class="mb-0">{{ count($subjects) }}</h2>
            <div class="text-muted small">Subjects</div>
            <a href="{{ route('subjects.index') }}" class="btn btn-sm btn-outline-dark mt-2">Manage</a>
        </div>
    </div>
</div>

<div class="row g-3">
    {{-- Recent teachers --}}
    <div class="col-md-6">
        <div class="card p-3">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <h6 class="mb-0">Recent Teachers</h6>
                <a href="{{ route('teachers.create') }}" class="btn btn-sm btn-dark">+ New</a>
            </div>
            @forelse(array_slice($teachers, 0, 5) as $teacher)
            <div class="d-flex justify-content-between align-items-center py-1 border-bottom">
                <span>{{ $teacher['name'] ?? '—' }}</span>
                <small class="text-muted">{{ $teacher['id'] ?? '' }}</small>
            </div>
            @empty
            <p class="text-muted small mb-0">No teachers yet.</p>
            @endforelse
        </div>
    </div>

    {{-- Recent subjects --}}
    <div class="col-md-6">
        <div class="card p-3">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <h6 class="mb-0">Recent Subjects</h6>
                <a href="{{ route('subjects.create') }}" class="btn btn-sm btn-dark">+ New</a>
            </div>
            @forelse(array_slice($subjects, 0, 5) as $subject)
            <div class="d-flex justify-content-between align-items-center py-1 border-bottom">
                <span>{{ $subject['name'] ?? '—' }}</span>
                <small class="text-muted">{{ $subject['id'] ?? '' }}</small>
            </div>
            @empty
            <p class="text-muted small mb-0">No subjects yet.</p>
            @endforelse
        </div>
    </div>
</div>
@endsection