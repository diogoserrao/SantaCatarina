@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Criar Nova Categoria</h1>
    <a href="{{ route('admin.categories.index') }}" class="btn btn-sm btn-secondary">
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

<form action="{{ route('admin.categories.store') }}" method="POST">
    @csrf
    
    <div class="row">
        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-header">Informações da Categoria</div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label for="name" class="form-label">Nome da Categoria <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
                            <small class="form-text text-muted">O nome da categoria como será exibido no menu.</small>
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label for="slug" class="form-label">Slug</label>
                            <input type="text" class="form-control" id="slug" name="slug" value="{{ old('slug') }}">
                            <small class="form-text text-muted">Identificador único para URLs (deixe em branco para gerar automaticamente).</small>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-1"></i> Salvar
                    </button>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-header">Dicas</div>
                <div class="card-body">
                    <p class="mb-0">As categorias são utilizadas para organizar os itens do menu em seções.</p>
                    <hr>
                    <p class="mb-0">Exemplos de categorias:</p>
                    <ul class="mb-0">
                        <li>Entradas</li>
                        <li>Pratos Principais</li>
                        <li>Sobremesas</li>
                        <li>Bebidas</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</form>

<script>
    document.getElementById('name').addEventListener('input', function() {
        // Gera slug a partir do nome automaticamente se o campo slug estiver vazio
        const slugField = document.getElementById('slug');
        if (!slugField.value) {
            slugField.value = this.value
                .toLowerCase()
                .replace(/[^\w ]+/g, '')
                .replace(/ +/g, '-');
        }
    });
</script>
@endsection