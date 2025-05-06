@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Gerenciar Categorias</h1>
    <div class="d-flex gap-2"> <!-- Substituído btn-toolbar por d-flex com gap-2 -->
        <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-1"></i> Voltar
        </a>
        <a href="{{ route('admin.categories.create') }}" class="btn btn-primary"> <!-- Removido btn-sm para consistência -->
            <i class="fas fa-plus me-1"></i> Nova Categoria
        </a>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Slug</th>
                        <th>Itens</th>
                        <th width="150">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($categories as $category)
                    <tr>
                        <td>{{ $category->name }}</td>
                        <td><code>{{ $category->slug }}</code></td>
                        <td>
                            <span class="badge bg-info">{{ $category->menu_items_count }} itens</span>
                        </td>
                        <td>
                            <div class="d-flex gap-2"> <!-- Substituindo btn-group por d-flex com gap -->
                                <a href="{{ route('admin.categories.edit', $category) }}"
                                    class="btn btn-sm btn-primary"
                                    title="Editar categoria">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <form action="{{ route('admin.categories.destroy', $category) }}"
                                    method="POST"
                                    onsubmit="return confirm('Tem certeza que deseja excluir esta categoria? Todos os itens relacionados serão desassociados.')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="btn btn-sm btn-danger"
                                        {{ $category->menu_items_count > 0 ? 'disabled' : '' }}
                                        title="{{ $category->menu_items_count > 0 ? 'Categoria em uso' : 'Excluir categoria' }}">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center py-4">
                            <p class="text-muted mb-0">Nenhuma categoria cadastrada.</p>
                            <a href="{{ route('admin.categories.create') }}" class="btn btn-sm btn-primary mt-3">
                                <i class="fas fa-plus me-1"></i> Criar Nova
                            </a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection