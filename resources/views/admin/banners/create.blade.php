@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Adicionar Banner</h1>
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

<form action="{{ route('admin.banners.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-header">Informações do Banner</div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="title" class="form-label">Título <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Descrição <span class="text-danger">*</span></label>
                        <textarea class="form-control" id="description" name="description" rows="3" required>{{ old('description') }}</textarea>
                        <div class="form-text">Texto curto que aparece abaixo do título do banner.</div>
                    </div>

                    <div class="mb-3">
                        <label for="image" class="form-label">Imagem <span class="text-danger">*</span></label>
                        <input type="file" class="form-control" id="image" name="image" accept="image/*" required>
                        <div class="form-text">Dimensão recomendada: 1920x1080px. Tamanho máximo: 2MB.</div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="button_text" class="form-label">Texto do Botão <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="button_text" name="button_text" value="{{ old('button_text') }}" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="button_link" class="form-label">Link do Botão <span class="text-danger">*</span></label>
                                <select class="form-select" id="button_link" name="button_link" required>
                                    <option value="" selected>-- Selecione uma seção --</option>
                                    <option value="#home">Início</option>
                                    <option value="#pratododia">Prato do Dia</option>
                                    <option value="#about">Sobre Nós</option>
                                    <option value="#menu">Menu</option>
                                    <option value="#gallery">Galeria</option>
                                    <option value="#contact">Contactos</option>
                                </select>
                                <div class="form-text">Escolha para qual seção da página o botão irá direcionar.</div>
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
                            {{ old('is_active', true) ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_active">Banner Ativo</label>
                    </div>

                    <div class="mb-3">
                        <label for="display_order" class="form-label">Ordem de Exibição</label>
                        <input type="number" class="form-control" id="display_order" name="display_order"
                            min="0" value="{{ old('display_order', 0) }}">
                        <div class="form-text">Números menores aparecem primeiro</div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="fas fa-save me-1"></i> Salvar
                    </button>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <i ></i> Pré-visualização
                </div>
                <div class="card-body">
                    <div id="imagePreview" class="text-center p-3 bg-light rounded">
                        <i class="fas fa-image fa-3x text-muted"></i>
                        <p class="mt-2 text-muted">Selecione uma imagem para visualizar</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection


<script>
    document.addEventListener('DOMContentLoaded', function() {
        console.log('DOM carregado, iniciando script');
        
        // Pré-visualização da imagem
        const imageInput = document.getElementById('image');
        const imagePreview = document.getElementById('imagePreview');
        
        if (!imageInput) {
            console.error('Elemento input#image não encontrado');
            return;
        }
        
        if (!imagePreview) {
            console.error('Elemento #imagePreview não encontrado');
            return;
        }
        
        console.log('Elementos encontrados, configurando evento change');
        
        imageInput.addEventListener('change', function(event) {
            console.log('Arquivo selecionado:', event.target.files);
            
            if (event.target.files && event.target.files[0]) {
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    console.log('Arquivo lido com sucesso');
                    imagePreview.innerHTML = `
                        <img src="${e.target.result}" class="img-fluid rounded" 
                             style="max-height: 300px; width: auto; object-fit: contain;" 
                             alt="Pré-visualização">
                    `;
                };
                
                reader.onerror = function() {
                    console.error('Erro ao ler o arquivo');
                    imagePreview.innerHTML = `
                        <div class="alert alert-danger">Erro ao carregar imagem</div>
                    `;
                };
                
                reader.readAsDataURL(event.target.files[0]);
            }
        });
        
        // Parte do feedback do botão (código existente mantido)
        const buttonLink = document.getElementById('button_link');
        
        // Criar um elemento para o feedback visual
        const feedbackDiv = document.createElement('div');
        feedbackDiv.className = 'form-text text-success mt-2';
        buttonLink.parentNode.appendChild(feedbackDiv);
        
        buttonLink.addEventListener('change', function() {
            const selectedValue = this.value;
            const selectedText = this.options[this.selectedIndex].text;
            
            if (selectedValue) {
                // Mostra feedback visual
                feedbackDiv.innerHTML = `<i class="fas fa-check-circle"></i> Link configurado para a seção "${selectedText}"`;
                
                // Limpa o feedback após 3 segundos
                setTimeout(() => {
                    feedbackDiv.innerHTML = '';
                }, 3000);
            }
        });
    });
</script>
