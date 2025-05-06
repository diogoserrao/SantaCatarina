@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Criar Novo Item do Menu</h1>
    <a href="{{ route('admin.menu-items.index') }}" class="btn btn-sm btn-secondary">
        <i class="fas fa-arrow-left me-1"></i> Voltar
    </a>
</div>

@if($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('admin.menu-items.store') }}" method="POST">
    @csrf
    
    <div class="row">
        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-header">Informações do Item</div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-8">
                            <label for="name" class="form-label">Nome <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
                        </div>
                        
                        <div class="col-md-4">
                            <label for="price" class="form-label">Preço <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text">€</span>
                                <input type="number" class="form-control" id="price" name="price" step="0.01" min="0" value="{{ old('price') }}" required>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label for="description" class="form-label">Descrição</label>
                            <textarea class="form-control" id="description" name="description" rows="3">{{ old('description') }}</textarea>
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="category_id" class="form-label">Categoria <span class="text-danger">*</span></label>
                            <select class="form-select" id="category_id" name="category_id" required>
                                <option value="">Selecione uma categoria</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="image_url" class="form-label">URL da Imagem <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="url" class="form-control" id="image_url" name="image_url" value="{{ old('image_url') }}" required>
                                <button type="button" class="btn btn-secondary" id="openCameraBtn">
                                    <i class="fas fa-camera"></i>
                                </button>
                            </div>
                            <div class="form-text">Cole uma URL ou capture uma imagem com a câmera</div>
                        </div>

                    </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-header">Configurações</div>
                <div class="card-body">
                    <div class="form-check form-switch mb-3">
                        <input class="form-check-input" type="checkbox" id="featured" name="featured" value="1" {{ old('featured') ? 'checked' : '' }}>
                        <label class="form-check-label" for="featured">Mostrar em Destaques</label>
                    </div>
                    
                    <div class="mb-3">
                        <label for="display_order" class="form-label">Ordem de Exibição</label>
                        <input type="number" class="form-control" id="display_order" name="display_order" min="0" value="{{ old('display_order', 0) }}">
                        <small class="form-text text-muted">Números menores aparecem primeiro.</small>
                    </div>
                    
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle me-1"></i> Itens marcados como destaque precisam ter uma imagem.
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="fas fa-save me-1"></i> Salvar
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection