@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Detalhes da Categoria: {{ $category->name }}</h1>
    <div>
        <a href="{{ route('admin.categories.edit', $category) }}" class="btn btn-sm btn-primary">
            <i class="fas fa-edit me-1"></i> Editar
        </a>
        <a href="{{ route('admin.categories.index') }}" class="btn btn-sm btn-secondary">
            <i class="fas fa-arrow-left me-1"></i> Voltar
        </a>
    </div>
</div>

<div class="row">
    <div class="col-md-5">
        <div class="card mb-4">
            <div class="card-header">Informações da Categoria</div>
            <div class="card-body">
                <table class="table">
                    <tr>
                        <th style="width: 150px;">Nome:</th>
                        <td>{{ $category->name }}</td>
                    </tr>
                    <tr>
                        <th>Slug:</th>
                        <td><code>{{ $category->slug }}</code></td>
                    </tr>
                    <tr>
                        <th>Data de Criação:</th>
                        <td>{{ $category->created_at->format('d/m/Y H:i') }}</td>
                    </tr>
                    <tr>
                        <th>Última Atualização:</th>
                        <td>{{ $category->updated_at->format('d/m/Y H:i') }}</td>
                    </tr>
                    <tr>
                        <th>Itens:</th>
                        <td>{{ $category->menuItems->count() }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    
    <div class="col-md-7">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span>Itens nesta Categoria</span>
                <a href="{{ route('admin.menu-items.create') }}?category_id={{ $category->id }}" class="btn btn-sm btn-primary">
                    <i class="fas fa-plus me-1"></i> Novo Item
                </a>
            </div>
            <div class="card-body">
                @if($category->menuItems->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>Preço</th>
                                    <th>Destaque</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($category->menuItems as $item)
                                    <tr>
                                        <td>{{ $item->name }}</td>
                                        <td>€{{ number_format($item->price, 2, ',', ' ') }}</td>
                                        <td>
                                            @if($item->featured)
                                                <span class="badge bg-warning">Sim</span>
                                            @else
                                                <span class="badge bg-secondary">Não</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.menu-items.edit', $item) }}" class="btn btn-sm btn-primary">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p class="text-center text-muted my-3">Nenhum item cadastrado nesta categoria.</p>
                    <div class="text-center">
                        <a href="{{ route('admin.menu-items.create') }}?category_id={{ $category->id }}" class="btn btn-primary">
                            <i class="fas fa-plus me-1"></i> Adicionar Primeiro Item
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection