@extends('layouts.admin')


<style>
    .card {
        border: none;
        box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
        border-radius: 0.5rem;
        transition: all 0.2s ease;
    }

    .card:hover {
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
    }

    .card-header {
        background-color: #fff;
        border-bottom: 1px solid rgba(0, 0, 0, .05);
        padding: 1rem 1.25rem;
    }

    .page-header {
        background-color: #f8f9fa;
        padding: 1.5rem;
        border-radius: 0.5rem;
        margin-bottom: 1.5rem;
    }

    .table th {
        background-color: #f8f9fa;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.75rem;
        letter-spacing: 0.5px;
        color: #495057;
        border-top: none;
    }

    .table td {
        vertical-align: middle;
        padding: 0.6rem;
    }

    .table th.image-column {
        width: 55px;
        /* Alterado de 70px para 55px */
    }

    .badge {
        font-weight: 500;
        padding: 0.5em 0.75em;
    }

    .badge-warning {
        background-color: #ffc107;
        color: #212529;
    }

    .badge-secondary {
        background-color: #e9ecef;
        color: #6c757d;
    }

    .btn-toolbar .btn {
        box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
        margin-left: 0.5rem;
        border-radius: 0.3rem;
        padding: 0.375rem 0.75rem;
    }

    .item-image {
        width: 45px !important;
        /* Alterado de max-width:60px para width:45px */
        height: 45px !important;
        /* Adicionado height fixo */
        object-fit: cover;
        border-radius: 0.3rem;
        box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
    }

    .image-placeholder {
        width: 45px !important;
        /* Reduzido de 60px para 45px */
        height: 45px !important;
        /* Reduzido de 60px para 45px */
        border-radius: 0.3rem;
        font-size: 0.8rem;
    }

    .action-buttons .btn {
        margin: 0 2px;
        width: 36px;
        /* Largura fixa para todos os botões */
        height: 36px;
        /* Altura fixa para todos os botões */
        padding: 0;
        /* Remove padding interno */
        display: flex;
        /* Permite centralizar o ícone */
        justify-content: center;
        /* Centraliza horizontalmente */
        align-items: center;
    }

    .action-buttons .btn i {
        font-size: 14px;
        /* Tamanho consistente para ícones */
    }

    .filter-card {
        margin-bottom: 1.5rem;
        border-left: 4px solid #6c757d;
    }

    .items-card {
        border-left: 4px solid #007bff;
    }

    .empty-state {
        padding: 3rem 1rem;
        text-align: center;
    }

    .empty-state .icon {
        font-size: 3rem;
        color: #dee2e6;
        margin-bottom: 1rem;
    }

    .highlight-new {
        animation: fadeIn 1s;
    }

    /* Paginação mais moderna */
    .pagination {
        margin-bottom: 0;
    }

    .pagination .page-item .page-link {
        border: none !important;
        border-radius: 6px !important;
        margin: 0 4px !important;
        color: var(--primary) !important;
        padding: 8px 14px !important;
        background-color: #fff !important;
        box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
        font-weight: 500;
        transition: all 0.2s ease;
    }

    .pagination .page-item .page-link:hover {
        background-color: var(--light-bg) !important;
        transform: translateY(-1px);
    }

    .pagination .page-item.active .page-link {
        background-color: var(--primary) !important;
        color: #fff !important;
        box-shadow: 0 0.25rem 0.5rem rgba(0, 123, 255, 0.2);
    }

    .pagination .page-item.disabled .page-link {
        color: #6c757d !important;
        opacity: 0.6;
        pointer-events: none;
    }

    @keyframes fadeIn {
        from {
            background-color: rgba(0, 123, 255, 0.1);
        }

        to {
            background-color: transparent;
        }
    }
</style>


@section('content')
<div class="page-header d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center">
    <div>
        <h1 class="h2 mb-1">Gerenciar Itens do Menu</h1>
        <p class="text-muted mb-0">Gerencie todos os itens disponíveis no cardápio</p>
    </div>
    <div class="btn-toolbar">
        <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-1"></i> Voltar
        </a>
        <a href="{{ route('admin.menu-items.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-1"></i> Novo Item
        </a>
    </div>
</div>

<!--  Filtros -->

<div class="card filter-card mb-4">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="fas fa-filter me-2"></i> Filtros</h5>
        <a href="{{ route('admin.menu-items.index') }}" class="btn btn-sm btn-outline-secondary">
            <i class="fas fa-sync-alt me-1"></i> Limpar
        </a>
    </div>
    <div class="card-body">
        <form method="GET" action="{{ route('admin.menu-items.index') }}">
            <div class="row g-3">

                <!-- Filtro Nome -->

                <div class="col-md-4">
                    <label for="search" class="form-label">Buscar por Nome</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-search"></i></span>
                        <input type="text" class="form-control" id="search" name="search"
                            value="{{ request('search') }}" placeholder="Nome ou descrição...">
                        @if(request('search'))
                        <button type="button" class="btn btn-outline-secondary"
                            onclick="document.getElementById('search').value = ''; this.form.submit();">
                            <i class="fas fa-times"></i>
                        </button>
                        @endif
                    </div>
                </div>

                <!-- Filtro Categoria -->

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

                <!-- Filtro Status -->

                <div class="col-md-3">
                    <label for="featured" class="form-label">Destaque</label>
                    <select class="form-select" id="featured" name="featured">
                        <option value="">Todos os itens</option>
                        <option value="1" {{ request('featured') == '1' ? 'selected' : '' }}>Em destaque</option>
                        <option value="0" {{ request('featured') == '0' ? 'selected' : '' }}>Não destacados</option>
                    </select>
                </div>

                <div class="col-md-2 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="fas fa-search me-1"></i> Filtrar
                    </button>
                </div>

            </div>
        </form>

        @if(request('search') || request('category') || request('featured') !== null)
        <div class="alert alert-info mt-3 d-flex align-items-center">
            <i class="fas fa-filter me-2"></i>
            <div>
                <strong>Filtros aplicados:</strong>
                @if(request('search'))
                <span class="badge bg-primary ms-2">Busca: {{ request('search') }}</span>
                @endif
                @if(request('category'))
                <span class="badge bg-primary ms-2">Categoria: {{ $categories->find(request('category'))->name ?? '' }}</span>
                @endif
                @if(request('featured') !== null)
                <span class="badge bg-primary ms-2">{{ request('featured') ? 'Em destaque' : 'Não destacados' }}</span>
                @endif
            </div>
            <a href="{{ route('admin.menu-items.index') }}" class="btn btn-sm btn-outline-primary ms-auto">
                Limpar todos os filtros
            </a>
        </div>
        @endif
        
    </div>
</div>

<div class="card items-card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="fas fa-utensils me-2"></i> Itens do Menu</h5>
        <span class="badge bg-primary">{{ $menuItems->total() }} itens</span>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th class="image-column">IMAGEM</th> <!-- Adicionada classe para controlar largura -->
                        <th>NOME</th>
                        <th>CATEGORIA</th>
                        <th>PREÇO</th>
                        <th>STATUS</th>
                        <th>ORDEM</th>
                        <th width="150" class="text-center">AÇÕES</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($menuItems as $item)
                    <tr class="{{ request('highlight') == $item->id ? 'highlight-new' : '' }}">
                        <td>
                            @if($item->image_url)
                            <img src="{{ $item->image_url }}" alt="{{ $item->name }}" class="item-image">
                            @else
                            <div class="image-placeholder bg-secondary text-white d-flex align-items-center justify-content-center">
                                <i class="fas fa-image"></i>
                            </div>
                            @endif
                        </td>
                        <td>
                            <strong>{{ $item->name }}</strong>
                            @if($item->description)
                            <div class="small text-muted text-truncate" style="max-width: 200px;">
                                {{ Str::limit($item->description, 40) }}
                            </div>
                            @endif
                        </td>
                        <td>
                            <span class="badge bg-light text-dark">
                                {{ $item->category->name }}
                            </span>
                        </td>
                        <td>
                            <span class="fw-bold">€{{ number_format($item->price, 2, ',', ' ') }}</span>
                        </td>
                        <td>
                            @if($item->featured)
                            <span class="badge bg-warning text-dark">
                                <i class="fas fa-star me-1"></i> Destaque
                            </span>
                            @else
                            <span class="badge bg-light text-muted">
                                Normal
                            </span>
                            @endif
                        </td>
                        <td class="text-center">
                            {{ $item->display_order }}
                        </td>
                        <td>
                            <div class="action-buttons d-flex justify-content-end">
                                <a href="{{ route('admin.menu-items.edit', $item) }}" class="btn btn-sm btn-primary" title="Editar">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <form action="{{ route('admin.menu-items.toggle-featured', $item) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-sm {{ $item->featured ? 'btn-secondary' : 'btn-warning' }}"
                                        title="{{ $item->featured ? 'Remover destaque' : 'Destacar item' }}">
                                        <i class="fas {{ $item->featured ? 'fa-star-half-alt' : 'fa-star' }}"></i>
                                    </button>
                                </form>

                                <form action="{{ route('admin.menu-items.destroy', $item) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" title="Excluir"
                                        onclick="return confirm('Tem certeza que deseja excluir o item {{ $item->name }}?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7">
                            <div class="empty-state">
                                <div class="icon">
                                    <i class="fas fa-utensils"></i>
                                </div>
                                <h4>Nenhum item encontrado</h4>
                                <p class="text-muted mb-3">Não foi encontrado nenhum item com os filtros atuais.</p>
                                <a href="{{ route('admin.menu-items.create') }}" class="btn btn-primary">
                                    <i class="fas fa-plus me-1"></i> Criar Novo Item
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer">
        <div class="d-flex justify-content-center mt-2">
            {{ $menuItems->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Destacar a linha de item recém-criado ou atualizado
    document.addEventListener('DOMContentLoaded', function() {
        setTimeout(() => {
            const highlightedRow = document.querySelector('.highlight-new');
            if (highlightedRow) {
                highlightedRow.scrollIntoView({
                    behavior: 'smooth',
                    block: 'center'
                });
            }
        }, 300);
    });
</script>

@endsection