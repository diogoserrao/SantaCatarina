<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Santa Catarina | Café e Retaurante</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <style>
        .admin-sidebar {
            min-height: calc(100vh - 56px);
            background-color: #343a40;
        }
        .admin-sidebar .nav-link {
            color: rgba(255,255,255,.75);
            padding: .75rem 1rem;
        }
        .admin-sidebar .nav-link.active {
            color: #fff;
            background-color: rgba(255,255,255,.1);
        }
        .admin-sidebar .nav-link:hover {
            color: #fff;
        }
        .admin-content {
            padding: 1.5rem;
        }
        .navbar-brand {
            font-family: 'Georgia', serif;
            font-weight: bold;
        }
        .badge-dot {
            width: 8px;
            height: 8px;
            display: inline-block;
            border-radius: 50%;
            margin-right: 5px;
        }
        .bg-success-soft {
            background-color: rgba(25, 135, 84, 0.1);
        }
        .bg-warning-soft {
            background-color: rgba(255, 193, 7, 0.1);
        }
        .bg-primary-soft {
            background-color: rgba(13, 110, 253, 0.1);
        }
    </style>
</head>
<body>
    <!-- Header -->
    <nav class="navbar navbar-dark bg-dark sticky-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('admin.dashboard') }}">
                <i class="fas fa-utensils me-2"></i>
                Santa Catarina Admin
            </a>
            <div class="d-flex">
                <div class="dropdown">
                    <button class="btn btn-outline-light dropdown-toggle" type="button" id="adminMenu" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-user-circle me-1"></i> Admin
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="adminMenu">
                        <li><a class="dropdown-item" href="{{ url('/') }}" target="_blank">Ver Site</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form action="{{ route('admin.logout') }}" method="POST">
                                @csrf
                                <button class="dropdown-item" type="submit">Sair</button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Container -->
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3 col-lg-2 admin-sidebar p-0 d-md-block">
                <nav class="nav flex-column">
                    <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                        <i class="fas fa-tachometer-alt me-2"></i> Dashboard
                    </a>
                    <a class="nav-link {{ request()->routeIs('admin.daily-specials.*') ? 'active' : '' }}" href="{{ route('admin.daily-specials.index') }}">
                        <i class="fas fa-star me-2"></i> Prato do Dia
                    </a>
                    <a class="nav-link {{ request()->routeIs('admin.menu-items.*') ? 'active' : '' }}" href="{{ route('admin.menu-items.index') }}">
                        <i class="fas fa-hamburger me-2"></i> Items do Menu
                    </a>
                    <a class="nav-link {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}" href="{{ route('admin.categories.index') }}">
                        <i class="fas fa-list me-2"></i> Categorias
                    </a>
                </nav>
            </div>

            <!-- Content Area -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 admin-content">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Initialize tooltips
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        });
    </script>
    @yield('scripts')
</body>
</html>