@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Gerenciar Itens do Menu</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-1"></i> Voltar
        </a>
        <a href="{{ route('admin.menu-items.create') }}" class="btn btn-sm btn-primary">
            <i class="fas fa-plus me-1"></i> Novo Item
        </a>
    </div>
</div>

<div class="card mb-4">
    <div class="card-body">
        <form method="GET" action="{{ route('admin.menu-items.index') }}" class="row g-3">
            <div class="col-md-4">
                <label for="search" class="form-label">Buscar</label>
                <input type="text" class="form-control" id="search" name="search" value="{{ request('search') }}" placeholder="Nome do item...">
            </div>
            <div class="col-md-3">
                <label for="category" class="form-label">Categoria</label>
                <select class="form-select" id="category" name="category">
                    <option value="">Todas as categorias</option>
                    @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <label for="featured" class="form-label">Destaque</label>
                <select class="form-select" id="featured" name="featured">
                    <option value="">Todos os itens</option>
                    <option value="1" {{ request('featured') == '1' ? 'selected' : '' }}>Em destaque</option>
                    <option value="0" {{ request('featured') == '0' ? 'selected' : '' }}>Não destacados</option>
                </select>
            </div>
            <div class="col-md-2 d-flex align-items-end">
                <button type="submit" class="btn btn-primary me-2">Filtrar</button>
                <a href="{{ route('admin.menu-items.index') }}" class="btn btn-secondary">Limpar</a>
            </div>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th width="50">Foto</th>
                        <th>Nome</th>
                        <th>Categoria</th>
                        <th>Preço</th>
                        <th>Destaque</th>
                        <th>Ordem</th>
                        <th width="150">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($menuItems as $item)
                    <tr>
                        <td>
                            @if($item->image_url)
                            <img src="{{ $item->image_url }}" alt="{{ $item->name }}" class="img-thumbnail"
                                style="width: 50px; height: 50px; object-fit: cover;">
                            @else
                            <div class="bg-secondary text-white d-flex align-items-center justify-content-center"
                                style="width: 50px; height: 50px;">
                                <i class="fas fa-image"></i>
                            </div>
                            @endif
                        </td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->category->name }}</td>
                        <td>€{{ number_format($item->price, 2, ',', ' ') }}</td>
                        <td>
                            @if($item->featured)
                            <span class="badge bg-warning">Destaque</span>
                            @else
                            <span class="badge bg-secondary">Normal</span>
                            @endif
                        </td>
                        <td>{{ $item->display_order }}</td>
                        <td>
                            <div class="btn-group" role="group">
                                <a href="{{ route('admin.menu-items.edit', $item) }}" class="btn btn-sm btn-primary">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <form action="{{ route('admin.menu-items.toggle-featured', $item) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-sm {{ $item->featured ? 'btn-secondary' : 'btn-warning' }}"
                                        title="{{ $item->featured ? 'Remover destaque' : 'Destacar item' }}">
                                        <i class="fas {{ $item->featured ? 'fa-star-half-alt' : 'fa-star' }}"></i>
                                    </button>
                                </form>

                                <form action="{{ route('admin.menu-items.destroy', $item) }}" method="POST" class="d-inline"
                                    onsubmit="return confirm('Tem certeza que deseja excluir este item?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-4">
                            <p class="text-muted mb-0">Nenhum item encontrado.</p>
                            <a href="{{ route('admin.menu-items.create') }}" class="btn btn-sm btn-primary mt-3">
                                <i class="fas fa-plus me-1"></i> Criar Novo
                            </a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="d-flex justify-content-center mt-4">
                {{ $menuItems->links() }}
            </div>
        </div>
    </div>
</div>
@endsection