@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Editar Banner</h1>
    <a href="{{ route('admin.banners.index') }}" class="btn btn-sm btn-secondary">
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

<form action="{{ route('admin.banners.update', $banner) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="row">
        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-header">Informações do Banner</div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="title" class="form-label">Título <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $banner->title) }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="image" class="form-label">Imagem</label>
                        <input type="file" class="form-control" id="image" name="image" accept="image/*">
                        <div class="form-text">Dimensão recomendada: 1920x1080px. Tamanho máximo: 2MB.</div>

                        @if($banner->image_url)
                        <div class="mt-2">
                            <small class="text-muted">Imagem atual:</small>
                            <div class="mt-2">
                                <img src="{{ $banner->image_url }}" alt="{{ $banner->title }}"
                                    class="img-thumbnail" style="max-height: 200px;">
                            </div>
                        </div>
                        @endif
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="button_text" class="form-label">Texto do Botão</label>
                                <input type="text" class="form-control" id="button_text" name="button_text"
                                    value="{{ old('button_text', $banner->button_text) }}">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="button_link" class="form-label">Link do Botão</label>
                                <div class="input-group">
                                    <select class="form-select" id="section_selector" aria-label="Selecione a seção">
                                        <option value="" selected>Selecione uma seção</option>
                                        <option value="#home">Início</option>
                                        <option value="#pratododia">Prato do Dia</option>
                                        <option value="#about">Sobre Nós</option>
                                        <option value="#menu">Menu</option>
                                        <option value="#gallery">Galeria</option>
                                        <option value="#contact">Contactos</option>
                                    </select>
                                    <button class="btn btn-outline-secondary" type="button" id="apply_section">Aplicar</button>
                                </div>
                                <div class="form-text mb-2">Ou digite manualmente o link abaixo:</div>
                                <input type="text" class="form-control" id="button_link" name="button_link"
                                    value="{{ old('button_link', $banner->button_link) }}" placeholder="Ex: #menu ou https://...">
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
                        <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1"
                            {{ old('is_active', $banner->is_active) ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_active">Banner Ativo</label>
                    </div>

                    <div class="mb-3">
                        <label for="display_order" class="form-label">Ordem de Exibição</label>
                        <input type="number" class="form-control" id="display_order" name="display_order"
                            min="0" value="{{ old('display_order', $banner->display_order) }}">
                        <div class="form-text">Números menores aparecem primeiro</div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="fas fa-save me-1"></i> Atualizar
                    </button>
                </div>
            </div>

            <div class="card">
                <div class="card-header">Pré-visualização</div>
                <div class="card-body">
                    <div id="imagePreview" class="text-center">
                        @if($banner->image_url)
                        <img src="{{ $banner->image_url }}" class="img-fluid rounded" alt="{{ $banner->title }}">
                        @else
                        <div class="bg-light py-4 rounded">
                            <i class="fas fa-image fa-3x text-muted"></i>
                            <p class="mt-2 text-muted">Sem imagem</p>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const imageInput = document.getElementById('image');
        const imagePreview = document.getElementById('imagePreview');

        imageInput.addEventListener('change', function(event) {
            if (event.target.files && event.target.files[0]) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    imagePreview.innerHTML = `<img src="${e.target.result}" class="img-fluid rounded" alt="Pré-visualização">`;
                }

                reader.readAsDataURL(event.target.files[0]);
            }
        });

        const sectionSelector = document.getElementById('section_selector');
        const buttonLink = document.getElementById('button_link');
        const applyButton = document.getElementById('apply_section');
        
        // Pré-selecionar a seção com base no link atual
        const currentLink = buttonLink.value;
        if (currentLink) {
            // Procura uma opção que corresponda ao link atual
            for(let i = 0; i < sectionSelector.options.length; i++) {
                if (sectionSelector.options[i].value === currentLink) {
                    sectionSelector.selectedIndex = i;
                    break;
                }
            }
        }
        
        applyButton.addEventListener('click', function() {
            const selectedValue = sectionSelector.value;
            if (selectedValue) {
                // Define o valor no campo de link
                buttonLink.value = selectedValue;
                
                // Feedback visual que funcionou
                buttonLink.classList.add('bg-success', 'text-white');
                setTimeout(() => {
                    buttonLink.classList.remove('bg-success', 'text-white');
                }, 500);
                
                // Foca no campo para o usuário ver a mudança
                buttonLink.focus();
            }
        });
    });
</script>
@endpush