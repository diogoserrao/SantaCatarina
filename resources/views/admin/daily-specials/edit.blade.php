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

<form action="{{ route('admin.daily-specials.update', $dailySpecial) }}" method="POST" enctype="multipart/form-data">
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
                            <label for="price" class="form-label">Preço <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text">€</span>
                                <input type="number" class="form-control" id="price" name="price" step="0.01" min="0" value="{{ old('price', $dailySpecial->price) }}" required>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label for="image" class="form-label">Imagem <span class="text-danger">*</span></label>
                            <input type="file" class="form-control" id="image" name="image" accept="image/*">
                            <div class="form-text">Selecione uma imagem do seu dispositivo (JPG, PNG, GIF, WebP)</div>

                            <input type="hidden" name="current_image" value="{{ $dailySpecial->image_url }}">

                            @if($dailySpecial->image_url)
                            <div class="form-text mt-2">Imagem atual: <a href="{{ $dailySpecial->image_url }}" target="_blank">Ver imagem</a></div>
                            @endif
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="col-md-4">
            <!-- Seção de Publicação (mantida conforme original) -->
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
            </div>

            <!-- Pré-visualização simplificada -->
            <div class="card mb-4">
                <div class="card-header">Pré-visualização</div>
                <div class="card-body">
                    <div id="imagePreview" class="text-center">
                        @if($dailySpecial->image_url)
                        <img src="{{ $dailySpecial->image_url }}" alt="{{ $dailySpecial->name }}" class="img-fluid rounded mb-3">
                        @else
                        <div class="bg-light text-center py-5 mb-3 rounded">
                            <i class="fas fa-image fa-3x text-muted"></i>
                            <p class="mt-2 text-muted">Sem imagem</p>
                        </div>
                        @endif
                    </div>
                    
                    <h5>{{ $dailySpecial->name }}</h5>
                    <p class="text-muted small">{{ Str::limit($dailySpecial->description, 100) }}</p>
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="badge bg-success">€{{ number_format($dailySpecial->price, 2, ',', ' ') }}</span>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="fas fa-save me-1"></i> Atualizar
                    </button>
                </div>
            </div>
        </div>
    </div>

</form>
@endsection

<script>
     document.addEventListener('DOMContentLoaded', function() {
        const imageInput = document.getElementById('image');
        const imagePreview = document.getElementById('imagePreview');
        const currentImageUrl = "{{ $dailySpecial->image_url }}";
        
        // Função para atualizar a pré-visualização
        imageInput.addEventListener('change', function() {
            if (this.files && this.files[0]) {
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    imagePreview.innerHTML = `<img src="${e.target.result}" class="img-fluid rounded mb-3" alt="Pré-visualização">`;
                }
                
                reader.readAsDataURL(this.files[0]);
            } else {
                // Caso nenhum arquivo seja selecionado, mostrar a imagem atual
                if (currentImageUrl) {
                    imagePreview.innerHTML = `<img src="${currentImageUrl}" class="img-fluid rounded mb-3" alt="Imagem atual">`;
                } else {
                    imagePreview.innerHTML = `<div class="bg-light text-center py-5 mb-3 rounded">
                        <i class="fas fa-image fa-3x text-muted"></i>
                        <p class="mt-2 text-muted">Sem imagem</p>
                    </div>`;
                }
            }
        });
    });
</script>