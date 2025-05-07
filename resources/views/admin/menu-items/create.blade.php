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

<form action="{{ route('admin.menu-items.store') }}" method="POST" enctype="multipart/form-data">
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

                        <div class="col-md-6">
                            <label for="image" class="form-label">Imagem <span class="text-danger featured-required d-none">*</span></label>
                            <div class="input-group mb-2">
                                <input type="file" class="form-control" id="image" name="image" accept="image/*">
                                <button class="btn btn-outline-secondary d-none" type="button" id="removeImage">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                            <div class="form-text">Selecione uma imagem do seu dispositivo (JPG, PNG, GIF, WebP)</div>
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
                        <i class="fas fa-info-circle me-1"></i> Itens marcados como destaque <strong>precisam obrigatoriamente</strong> ter uma imagem. Para itens normais, a imagem é opcional.
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="fas fa-save me-1"></i> Salvar
                    </button>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header">Pré-visualização</div>
                <div class="card-body">
                    <div id="imagePreview" class="text-center">
                        <div class="bg-light text-center py-5 mb-3 rounded">
                            <i class="fas fa-image fa-3x text-muted"></i>
                            <p class="mt-2 text-muted">Sem imagem</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</form>
@endsection

@section('scripts')
<script>
     document.addEventListener('DOMContentLoaded', function() {
        const featuredCheckbox = document.getElementById('featured');
        const imageInput = document.getElementById('image');
        const imagePreview = document.getElementById('imagePreview');
        const featureRequired = document.querySelector('.featured-required');
        const removeImageBtn = document.getElementById('removeImage');
        
        // Função para atualizar requerimento de imagem
        function updateImageRequirement() {
            if (featuredCheckbox.checked) {
                imageInput.setAttribute('required', true);
                featureRequired.classList.remove('d-none');
            } else {
                imageInput.removeAttribute('required');
                featureRequired.classList.add('d-none');
            }
        }
        
        // Executar na inicialização
        updateImageRequirement();
        
        // Executar quando o checkbox for alterado
        featuredCheckbox.addEventListener('change', updateImageRequirement);
        
        // Pré-visualização da imagem
        imageInput.addEventListener('change', function() {
            if (this.files && this.files[0]) {
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    imagePreview.innerHTML = `<img src="${e.target.result}" class="img-fluid rounded mb-3" alt="Pré-visualização">`;
                    // Mostrar botão de remoção
                    removeImageBtn.classList.remove('d-none');
                }
                
                reader.readAsDataURL(this.files[0]);
            } else {
                resetImage();
            }
        });
        
        // Função para remover a imagem
        removeImageBtn.addEventListener('click', function() {
            resetImage();
            
            // Se item estiver marcado como destaque, validar novamente
            if (featuredCheckbox.checked) {
                alert('Atenção: Itens em destaque precisam ter uma imagem.');
            }
        });
        
        // Função para resetar a imagem
        function resetImage() {
            // Limpar o input de arquivo
            imageInput.value = '';
            
            // Ocultar botão de remoção
            removeImageBtn.classList.add('d-none');
            
            // Restaurar o placeholder
            imagePreview.innerHTML = `<div class="bg-light text-center py-5 mb-3 rounded">
                <i class="fas fa-image fa-3x text-muted"></i>
                <p class="mt-2 text-muted">Sem imagem</p>
            </div>`;
        }
    });
</script>
@endsection