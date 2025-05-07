<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Santa Catarina | Café e Restaurante</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <style>
        /* Cabeçalho fixo */
        .navbar {
            z-index: 1000;
        }

        /* Espaçamento dos itens */
        .navbar-nav .nav-item {
            margin-right: 1rem;
        }

        .admin-content {
            padding: 1.5rem;
            margin-top: 1rem;
        }
    </style>
</head>

<body>
    <!-- Cabeçalho -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('admin.dashboard') }}">
                <i class="fas fa-utensils me-2"></i> Santa Catarina Admin
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav"
                aria-controls="mainNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="mainNav">
    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"
                href="{{ route('admin.dashboard') }}">
                <i class="fas fa-tachometer-alt me-1"></i> Dashboard
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.daily-specials.*') ? 'active' : '' }}"
                href="{{ route('admin.daily-specials.index') }}">
                <i class="fas fa-star me-1"></i> Prato do Dia
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.menu-items.*') ? 'active' : '' }}"
                href="{{ route('admin.menu-items.index') }}">
                <i class="fas fa-hamburger me-1"></i> Items do Menu
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}"
                href="{{ route('admin.categories.index') }}">
                <i class="fas fa-list me-1"></i> Categorias
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.gallery-images.*') ? 'active' : '' }}"
                href="{{ route('admin.gallery-images.index') }}">
                <i class="fas fa-list me-1"></i> Galeria
            </a>
        </li>
        <!-- <li class="nav-item"> BANNERS******************
            <a class="nav-link {{ request()->routeIs('admin.banners.*') ? 'active' : '' }}"
                href="{{ route('admin.banners.index') }}">
                <i class="fas fa-list me-1"></i> Banners
            </a>
        </li> -->
    </ul>
    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        <li class="nav-item">
            <a class="nav-link" href="{{ url('/') }}" target="_blank">
                <i class="fas fa-external-link-alt me-1"></i> Ver Site
            </a>
        </li>
        <li class="nav-item">
            <form action="{{ route('logout') }}" method="POST" class="m-0">
                @csrf
                <button type="submit" class="nav-link border-0 bg-transparent">
                    <i class="fas fa-sign-out-alt me-1 text-danger"></i> Sair
                </button>
            </form>
        </li>
    </ul>
</div>
    </nav>

    <!-- Conteúdo Principal -->
    <div class="container-fluid">
        <div class="row">
            <main class="col-12 admin-content">
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
    @yield('scripts')
</body>

</html>