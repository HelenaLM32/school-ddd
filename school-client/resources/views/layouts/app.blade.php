<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'School Client') }} – @yield('title', 'Dashboard')</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css">
    <style>
        body { background-color: #f8f9fa; }
        .navbar-brand { font-weight: 700; letter-spacing: -0.5px; }
        .sidebar {
            min-height: calc(100vh - 56px);
            background: #fff;
            border-right: 1px solid #dee2e6;
        }
        .sidebar .nav-link { color: #495057; border-radius: 6px; margin-bottom: 2px; }
        .sidebar .nav-link:hover, .sidebar .nav-link.active { background: #e9ecef; color: #212529; }
        .sidebar .nav-link i { width: 20px; display: inline-block; }
        .card { border: 1px solid #dee2e6; border-radius: 10px; }
        .table th { font-size: 0.8rem; text-transform: uppercase; letter-spacing: 0.05em; color: #6c757d; }
        .btn-action { padding: 3px 10px; font-size: 0.82rem; }
        .badge-count { font-size: 0.7rem; }
    </style>
</head>

<body>

    {{-- Navbar --}}
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark px-3">
        <a class="navbar-brand" href="{{ route('home') }}">School</a>

        @auth
        <div class="ms-auto d-flex align-items-center gap-3">
            @if(Auth::user()->avatar)
                <img src="{{ Auth::user()->avatar }}" class="rounded-circle" width="30" height="30" alt="avatar">
            @endif
            <span class="text-white small">{{ Auth::user()->name }}</span>
            <form method="POST" action="{{ route('logout') }}" class="m-0">
                @csrf
                <button type="submit" class="btn btn-sm btn-outline-light">Logout</button>
            </form>
        </div>
        @endauth
    </nav>

    <div class="container-fluid">
        <div class="row">

            @auth
            {{-- Sidebar --}}
            <nav class="col-md-2 sidebar py-3 px-2">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}"
                            href="{{ route('dashboard') }}">Dashboard</a>
                    </li>
                    <hr class="my-2">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('teachers.*') ? 'active' : '' }}"
                            href="{{ route('teachers.index') }}">Teachers</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('students.*') ? 'active' : '' }}"
                            href="{{ route('students.index') }}">Students</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('subjects.*') ? 'active' : '' }}"
                            href="{{ route('subjects.index') }}">Subjects</a>
                    </li>
                </ul>
            </nav>
            @endauth

            {{-- Main content --}}
            <main class="{{ Auth::check() ? 'col-md-10' : 'col-12' }} py-4 px-4">

                @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    ✅ {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
                @endif
                @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    ❌ {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
                @endif

                @yield('content')
            </main>

        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>

</html>
