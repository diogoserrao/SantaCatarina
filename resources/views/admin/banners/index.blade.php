@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Gerenciar Banners</h1>
    <div class="d-flex gap-2">
        <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-1"></i> Voltar
        </a>
        <a href="{{ route('admin.banners.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-1"></i> Novo Banner
        </a>
    </div>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th style="width: 80px;">Imagem</th>
                        <th>Título</th>
                        <th>Botão</th>
                        <th>Status</th>
                        <th>Ordem</th>
                        <th style="width: 150px;">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($banners as $banner)
                    <tr>

                        <td>
                            @if($banner->image_url)
                            <img src="{{ $banner->image_url }}" alt="{{ $banner->title }}"
                                style="width: 100%; height: auto; max-height: 80px; object-fit: cover; border-radius: 4px;">
                            @else
                            <div class="bg-light text-center rounded p-2">
                                <i class="fas fa-image text-muted"></i>
                            </div>
                            @endif
                        </td>

                        <td>{{ $banner->title }}</td>
                        <td>
                            @if($banner->button_text)
                            <span class="badge bg-info">{{ $banner->button_text }}</span>
                            @else
                            <span class="badge bg-light text-muted">Sem botão</span>
                            @endif
                        </td>
                        <td>
                            <span class="badge {{ $banner->is_active ? 'bg-success' : 'bg-secondary' }}">
                                {{ $banner->is_active ? 'Ativo' : 'Inativo' }}
                            </span>
                        </td>
                        <td>{{ $banner->display_order }}</td>

                        <td>
                            <div class="d-flex gap-2">

                                <!-- Botão de editar -->
                                <a href="{{ route('admin.banners.edit', $banner) }}" class="btn btn-sm btn-primary d-flex align-items-center">
                                    <i class="fas fa-edit me-1"></i> Editar
                                </a>

                                <!-- Botão de toggle ativo/inativo -->
                                <form action="{{ route('admin.banners.toggle', $banner) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-sm {{ $banner->is_active ? 'btn-secondary' : 'btn-success' }} d-flex align-items-center">
                                        <i class="fas fa-{{ $banner->is_active ? 'eye-slash' : 'eye' }} me-1"></i>
                                        {{ $banner->is_active ? 'Desativar' : 'Ativar' }}
                                    </button>
                                </form>


                                <!-- Botão de excluir -->
                                <form action="{{ route('admin.banners.destroy', $banner) }}"
                                    method="POST"
                                    data-item-name="{{ $banner->title }}"
                                    data-item-type="banner">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        <i class="fas fa-trash me-1"></i>
                                    </button>
                                </form>


                            </div>
                        </td>

                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-4">
                            <p class="text-muted mb-2">Nenhum banner cadastrado.</p>
                            <a href="{{ route('admin.banners.create') }}" class="btn btn-sm btn-primary">
                                <i class="fas fa-plus me-1"></i> Adicionar Banner
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