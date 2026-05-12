@extends('layouts.app')
@section('title', 'Edit Subject')

@section('content')
<div class="d-flex align-items-center gap-2 mb-4">
    <a href="{{ route('subjects.index') }}" class="btn btn-sm btn-outline-secondary">← Back</a>
    <h4 class="mb-0">Edit Subject</h4>
</div>

@if(session('error'))
<div class="alert alert-danger">{{ session('error') }}</div>
@endif
@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="row g-3" style="max-width:900px">

    {{-- Edit name --}}
    <div class="col-md-6">
        <div class="card p-4 h-100">
            <h6 class="mb-3">Subject info</h6>
            <form method="POST" action="{{ route('subjects.update', $subject['id']) }}">
                @csrf @method('PUT')

                <div class="mb-3">
                    <label class="form-label fw-medium text-muted small">Subject ID</label>
                    <input type="text" class="form-control bg-light" value="{{ $subject['id'] }}" disabled>
                </div>

                <div class="mb-4">
                    <label for="name" class="form-label fw-medium">Subject Name</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                        id="name" name="name" value="{{ old('name', $subject['name']) }}" required>
                    @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <button type="submit" class="btn btn-dark">Update</button>
            </form>
        </div>
    </div>

    {{-- Assign teacher --}}
    <div class="col-md-6">
        <div class="card p-4 h-100">
            <h6 class="mb-3">Assign teacher</h6>

            {{-- FIX: la API devuelve 'teacherId' (camelCase), no 'teacher' ni 'teacher_id' --}}
            @if(!empty($subject['teacherId']))
            <div class="alert alert-light border mb-3 py-2">
                Current: <strong>
                    {{ collect($teachers)->firstWhere('id', $subject['teacherId'])['name'] ?? $subject['teacherId'] }}
                </strong>
            </div>
            @endif

            <form method="POST" action="{{ route('subjects.assign-teacher', $subject['id']) }}">
                @csrf

                <div class="mb-4">
                    <label for="teacher_id" class="form-label fw-medium">Select Teacher</label>
                    <select class="form-select @error('teacher_id') is-invalid @enderror"
                        id="teacher_id" name="teacher_id" required>
                        <option value="">— Choose a teacher —</option>
                        @foreach($teachers as $teacher)
                        {{-- FIX: comparar con 'teacherId' (camelCase) --}}
                        <option value="{{ $teacher['id'] }}"
                            {{ (!empty($subject['teacherId']) && $subject['teacherId'] === $teacher['id']) ? 'selected' : '' }}>
                            {{ $teacher['name'] }}
                        </option>
                        @endforeach
                    </select>
                    @error('teacher_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-dark">Assign Teacher</button>
            </form>
        </div>
    </div>

</div>
@endsection