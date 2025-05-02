@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Editar Categoria</h1>
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

<form action="{{ route('admin.categories.update', $category) }}" method="POST">
    @csrf
    @method('PUT')
    
    <div class="row">
        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-header">Informações da Categoria</div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label for="name" class="form-label">Nome da Categoria <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $category->name) }}" required>
                            <small class="form-text text-muted">O nome da categoria como será exibido no menu.</small>
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label for="slug" class="form-label">Slug</label>
                            <input type="text" class="form-control" id="slug" name="slug" value="{{ old('slug', $category->slug) }}">
                            <small class="form-text text-muted">Identificador único para URLs.</small>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-1"></i> Atualizar
                    </button>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-header">Estatísticas</div>
                <div class="card-body">
                    <p><strong>Itens nesta categoria:</strong> {{ $category->menuItems->count() }}</p>
                    
                    @if($category->menuItems->count() > 0)
                        <div class="alert alert-warning">
                            <i class="fas fa-exclamation-triangle me-1"></i> Esta categoria possui itens associados. 
                            Modificar o slug pode afetar a exibição no site.
                        </div>
                    @endif
                </div>
            </div>
            
            <div class="card mb-4">
                <div class="card-header">Ações</div>
                <div class="card-body">
                    <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" 
                        onsubmit="return confirm('Tem certeza que deseja excluir esta categoria? Esta ação não pode ser desfeita.')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger w-100" {{ $category->menuItems->count() > 0 ? 'disabled' : '' }}>
                            <i class="fas fa-trash me-1"></i> Excluir Categoria
                        </button>
                        
                        @if($category->menuItems->count() > 0)
                            <small class="form-text text-muted mt-2">
                                Esta categoria não pode ser excluída pois possui {{ $category->menuItems->count() }} itens associados.
                            </small>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
</form>

<script>
    document.getElementById('name').addEventListener('input', function() {
        // Auto-gera slug apenas se é um novo registro (slug vazio)
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