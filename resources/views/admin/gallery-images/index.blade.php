@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Gerenciar Imagens da Galeria</h1>
    <div class="btn-toolbar">
        <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary me-2">
            <i class="fas fa-arrow-left me-1"></i> Voltar
        </a>
        <a href="{{ route('admin.gallery-images.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-1"></i> Nova Imagem
        </a>
    </div>
</div>


<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th width="80">Imagem</th>
                        <th class="ps-3">Título</th>
                        <th>Descrição</th>
                        <th>Status</th>
                        <th>Ordem</th>
                        <th width="280">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($galleryImages as $image)
                    <tr>
                        <td>
                            <img src="{{ $image->image_url }}" alt="{{ $image->title }}"
                                class="img-thumbnail" style="width: 60px; height: 60px; object-fit: cover;">
                        </td>
                        <td class="ps-3">{{ $image->title }}</td>
                        <td>{{ Str::limit($image->description, 50) }}</td>
                        <td>
                            <span class="badge {{ $image->is_active ? 'bg-success' : 'bg-secondary' }}">
                                {{ $image->is_active ? 'Ativa' : 'Inativa' }}
                            </span>
                        </td>
                        <td>{{ $image->display_order }}</td>
                        <td>
                            <div class="d-flex gap-2">
                                <a href="{{ route('admin.gallery-images.edit', $image) }}"
                                    class="btn btn-sm btn-primary">
                                    <i class="fas fa-edit"></i> Editar
                                </a>

                                <form action="{{ route('admin.gallery-images.toggle-active', $image) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-sm {{ $image->is_active ? 'btn-secondary' : 'btn-success' }}">
                                        <i class="fas fa-{{ $image->is_active ? 'eye-slash' : 'eye' }}"></i>
                                        {{ $image->is_active ? 'Desativar' : 'Ativar' }}
                                    </button>
                                </form>

                                <form action="{{ route('admin.gallery-images.destroy', $image) }}"
                                    method="POST"
                                    data-item-name="{{ $image->title }}"
                                    data-item-type="imagem">
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
                        <td colspan="6" class="text-center py-4">
                            <p class="text-muted mb-2">Nenhuma imagem cadastrada.</p>
                            <a href="{{ route('admin.gallery-images.create') }}" class="btn btn-sm btn-primary">
                                <i class="fas fa-plus me-1"></i> Adicionar Imagem
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