@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Dashboard</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group me-2">
            <a href="{{ route('admin.daily-specials.create') }}" class="btn btn-success shadow-sm me-2">
                <i class="fas fa-utensils me-1"></i> Novo Prato do Dia
            </a>
            <a href="{{ route('admin.menu-items.create') }}" class="btn btn-primary shadow-sm">
                <i class="fas fa-plus-circle me-1"></i> Novo Item de Menu
            </a>
        </div>
    </div>
</div>

<div class="row">
    <!-- Estatísticas Rápidas -->
    <div class="col-md-4 mb-4">
        <div class="card bg-primary-soft h-100">
            <div class="card-body">
                <h5 class="card-title"><i class="fas fa-utensils me-2"></i>Items no Menu</h5>
                <h2 class="display-4">{{ $menuItemsCount }}</h2>
                <p class="card-text">Total de items disponíveis no menu.</p>
                <a href="{{ route('admin.menu-items.index') }}" class="btn btn-sm btn-primary">Gerenciar</a>
            </div>
        </div>
    </div>
    <div class="col-md-4 mb-4">
        <div class="card bg-success-soft h-100">
            <div class="card-body">
                <h5 class="card-title"><i class="fas fa-th-list me-2"></i>Categorias</h5>
                <h2 class="display-4">{{ $categoriesCount }}</h2>
                <p class="card-text">Categorias de itens no menu.</p>
                <a href="{{ route('admin.categories.index') }}" class="btn btn-sm btn-success">Gerenciar</a>
            </div>
        </div>
    </div>
    <div class="col-md-4 mb-4">
        <div class="card bg-warning-soft h-100">
            <div class="card-body">
                <h5 class="card-title"><i class="fas fa-star me-2"></i>Prato do Dia</h5>
                <h2>{{ isset($activeDailySpecial) && $activeDailySpecial->count() > 0 ? 'Ativo' : 'Não Definido' }}</h2>
                <p class="card-text">
                    @if(isset($activeDailySpecial) && $activeDailySpecial->count() > 0)
                    <strong>{{ $activeDailySpecial->first()->name }}</strong><br>
                    @if($activeDailySpecial->count() > 1)
                    <span class="badge bg-info">+{{ $activeDailySpecial->count() - 1 }} adicional</span><br>
                    @endif
                    <span class="badge bg-success">Ativo</span>
                    @else
                    Não há prato do dia definido.
                    @endif
                </p>
                <a href="{{ route('admin.daily-specials.index') }}" class="btn btn-sm btn-warning">Gerenciar</a>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <!-- Prato do Dia Atual -->
    <div class="col-lg-6 mb-4">
        <div class="card h-100">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Pratos do Dia Ativos</h5>
                @if(isset($activeDailySpecial) && $activeDailySpecial->count() > 0)
                <a href="{{  route('admin.daily-specials.index') }}" class="btn btn-sm btn-outline-primary">
                    <i class="fas fa-edit"></i> Editar
                </a>
                @endif
            </div>
            <div class="card-body">
                @if(isset($activeDailySpecial) && $activeDailySpecial->count() > 0)
                @foreach($activeDailySpecial as $special)
                <div class="row mb-3">

                    <div class="col-md-4">
                        <div style="height: 160px; width: 100%; overflow: hidden;" class="rounded mb-2 mb-md-0">
                            <img src="{{ $special->image_url }}" alt="{{ $special->name }}"
                                style="width: 100%; height: 100%; object-fit: cover; object-position: center;"
                                class="rounded">
                        </div>
                    </div>

                    <div class="col-md-8">
                        <h5>{{ $special->name }}</h5>
                        <p class="text-muted">{{ Str::limit($special->description, 100) }}</p>
                        <div class="d-flex justify-content-between">
                            <span class="badge bg-primary">€{{ number_format($special->price, 2, ',', ' ') }}</span>
                            <span class="badge bg-success">Ativo</span>
                        </div>
                    </div>
                </div>
                @if(!$loop->last)
                <hr>
                @endif
                @endforeach
                @else
                <div class="text-center py-4">
                    <i class="fas fa-exclamation-circle fa-3x text-muted mb-3"></i>
                    <p>Não há prato do dia ativo no momento.</p>
                    <a href="{{ route('admin.daily-specials.create') }}" class="btn btn-primary">Criar Prato do Dia</a>
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Items em Destaque -->
    <div class="col-lg-6 mb-4">
        <div class="card h-100">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Itens em Destaque</h5>
                <a href="{{ route('admin.menu-items.index', ['featured' => 1]) }}" class="btn btn-sm btn-outline-primary">
                    Ver Todos
                </a>
            </div>
            <div class="card-body">
                @if($featuredItems->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Item</th>
                                <th>Categoria</th>
                                <th>Preço</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($featuredItems as $item)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        @if($item->image_url)
                                        <img src="{{ $item->image_url }}" alt="{{ $item->name }}" class="me-2" style="width: 40px; height: 40px; object-fit: cover; border-radius: 4px;">
                                        @endif
                                        {{ $item->name }}
                                    </div>
                                </td>
                                <td>{{ $item->category->name }}</td>
                                <td>€{{ number_format($item->price, 2, ',', ' ') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <div class="text-center py-4">
                    <p>Não há itens marcados como destaque.</p>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection