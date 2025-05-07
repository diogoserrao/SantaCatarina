@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h2>Editar Imagem</h2>
    <a href="{{ route('admin.gallery-images.index') }}" class="btn btn-sm btn-secondary">
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

<form action="{{ route('admin.gallery-images.update', $galleryImage) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="row">
        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-header">Informações da Imagem</div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="title" class="form-label">Título <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="title" name="title"
                            value="{{ old('title', $galleryImage->title) }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Descrição</label>
                        <textarea class="form-control" id="description" name="description" rows="3">{{ old('description', $galleryImage->description) }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label for="image" class="form-label">Imagem <span class="text-danger">*</span></label>
                        <input type="file" class="form-control" id="image" name="image" accept="image/*">
                        <div class="form-text">Selecione uma imagem do seu dispositivo (JPG, PNG, GIF, WebP)</div>


                        <input type="hidden" name="current_image_url" value="{{ $galleryImage->image_url }}">
                    
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
                            {{ old('is_active', $galleryImage->is_active) ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_active">Imagem Ativa</label>
                    </div>

                    <div class="mb-3">
                        <label for="display_order" class="form-label">Ordem de Exibição</label>
                        <input type="number" class="form-control" id="display_order" name="display_order"
                            min="0" value="{{ old('display_order', $galleryImage->display_order) }}">
                        <div class="form-text">Números menores aparecem primeiro</div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="fas fa-save me-1"></i> Salvar Alterações
                    </button>
                </div>
            </div>

            <div class="card">
                <div class="card-header">Pré-visualização</div>
                <div class="card-body">
                    <div id="imagePreview" class="text-center">
                        <img src="{{ $galleryImage->image_url }}" class="img-fluid rounded" alt="{{ $galleryImage->title }}">
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
        const imageInput = document.getElementById('image');
        const imagePreview = document.getElementById('imagePreview');
        const currentImageUrl = "{{ $galleryImage->image_url }}";

        // Função para atualizar a pré-visualização
        imageInput.addEventListener('change', function() {
            if (this.files && this.files[0]) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    imagePreview.innerHTML = `<img src="${e.target.result}" class="img-fluid rounded" alt="Pré-visualização">`;
                }

                reader.readAsDataURL(this.files[0]);
            } else {
                // Caso nenhum arquivo seja selecionado, mostrar a imagem atual
                imagePreview.innerHTML = `<img src="${currentImageUrl}" class="img-fluid rounded" alt="Imagem atual">`;
            }
        });
    });
</script>
@endsection