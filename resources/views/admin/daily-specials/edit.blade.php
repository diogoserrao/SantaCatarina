php
@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Editar Prato do Dia</h1>
    <a href="{{ route('admin.daily-specials.index') }}" class="btn btn-sm btn-secondary">
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

<form action="{{ route('admin.daily-specials.update', $dailySpecial) }}" method="POST">
    @csrf
    @method('PUT')
    
    <div class="row">
        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-header">Informações do Prato</div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label for="name" class="form-label">Nome do Prato <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $dailySpecial->name) }}" required>
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label for="description" class="form-label">Descrição <span class="text-danger">*</span></label>
                            <textarea class="form-control" id="description" name="description" rows="3" required>{{ old('description', $dailySpecial->description) }}</textarea>
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="original_price" class="form-label">Preço Original <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text">€</span>
                                <input type="number" class="form-control" id="original_price" name="original_price" step="0.01" min="0" value="{{ old('original_price', $dailySpecial->original_price) }}" required>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <label for="promo_price" class="form-label">Preço Promocional <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text">€</span>
                                <input type="number" class="form-control" id="promo_price" name="promo_price" step="0.01" min="0" value="{{ old('promo_price', $dailySpecial->promo_price) }}" required>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="image_url" class="form-label">URL da Imagem <span class="text-danger">*</span></label>
                            <input type="url" class="form-control" id="image_url" name="image_url" value="{{ old('image_url', $dailySpecial->image_url) }}" required>
                        </div>
                        
                        <div class="col-md-6">
                            <label for="badge_text" class="form-label">Texto do Distintivo</label>
                            <input type="text" class="form-control" id="badge_text" name="badge_text" value="{{ old('badge_text', $dailySpecial->badge_text) }}">
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="portions_available" class="form-label">Porções Disponíveis <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" id="portions_available" name="portions_available" min="0" value="{{ old('portions_available', $dailySpecial->portions_available) }}" required>
                        </div>
                        
                        <div class="col-md-6">
                            <label for="available_until" class="form-label">Disponível Até <span class="text-danger">*</span></label>
                            <input type="time" class="form-control" id="available_until" name="available_until" value="{{ old('available_until', substr($dailySpecial->available_until, 0, 5)) }}" required>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="card mb-4">
                <div class="card-header">Alternativa (Quando Esgotado)</div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label for="alternative_name" class="form-label">Nome da Alternativa <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="alternative_name" name="alternative_name" value="{{ old('alternative_name', $dailySpecial->alternative_name) }}" required>
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label for="alternative_description" class="form-label">Descrição da Alternativa <span class="text-danger">*</span></label>
                            <textarea class="form-control" id="alternative_description" name="alternative_description" rows="3" required>{{ old('alternative_description', $dailySpecial->alternative_description) }}</textarea>
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="alternative_price" class="form-label">Preço da Alternativa <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text">€</span>
                                <input type="number" class="form-control" id="alternative_price" name="alternative_price" step="0.01" min="0" value="{{ old('alternative_price', $dailySpecial->alternative_price) }}" required>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <label for="alternative_image_url" class="form-label">URL da Imagem Alternativa <span class="text-danger">*</span></label>
                            <input type="url" class="form-control" id="alternative_image_url" name="alternative_image_url" value="{{ old('alternative_image_url', $dailySpecial->alternative_image_url) }}" required>
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="alternative_available_until" class="form-label">Alternativa Disponível Até <span class="text-danger">*</span></label>
                            <input type="time" class="form-control" id="alternative_available_until" name="alternative_available_until" value="{{ old('alternative_available_until', substr($dailySpecial->alternative_available_until, 0, 5)) }}" required>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-header">Publicação</div>
                <div class="card-body">
                    <div class="form-check form-switch mb-3">
                        <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', $dailySpecial->is_active) ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_active">Ativar Este Prato do Dia</label>
                    </div>
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle me-1"></i> Ao ativar, qualquer outro prato do dia ativo será desativado automaticamente.
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="fas fa-save me-1"></i> Atualizar
                    </button>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header">Pré-visualização</div>
                <div class="card-body">
                    @if($dailySpecial->image_url)
                        <img src="{{ $dailySpecial->image_url }}" alt="{{ $dailySpecial->name }}" class="img-fluid rounded mb-3">
                    @endif
                    <h5>{{ $dailySpecial->name }}</h5>
                    <p class="text-muted small">{{ Str::limit($dailySpecial->description, 100) }}</p>
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="badge bg-success">€{{ number_format($dailySpecial->promo_price, 2, ',', ' ') }}</span>
                        <span class="badge {{ $dailySpecial->hasAvailablePortions() ? 'bg-primary' : 'bg-danger' }}">
                            {{ $dailySpecial->hasAvailablePortions() ? $dailySpecial->portions_available . ' porções' : 'Esgotado' }}
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection