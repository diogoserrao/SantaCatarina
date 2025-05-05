@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Detalhes do Prato do Dia</h1>
    <div>
        <a href="{{ route('admin.daily-specials.edit', $dailySpecial) }}" class="btn btn-sm btn-primary me-2">
            <i class="fas fa-edit me-1"></i> Editar
        </a>
        <a href="{{ route('admin.daily-specials.index') }}" class="btn btn-sm btn-secondary">
            <i class="fas fa-arrow-left me-1"></i> Voltar
        </a>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="card mb-4">
            <div class="card-header">Informações do Prato</div>
            <div class="card-body">
                <div class="mb-3">
                    <h5>{{ $dailySpecial->name }}</h5>
                    <p>{{ $dailySpecial->description }}</p>
                    <div><strong>Preço:</strong> €{{ number_format($dailySpecial->price, 2, ',', ' ') }}</div>
                    <div><strong>Status:</strong> {!! $dailySpecial->is_active ? '<span class="badge bg-success">Ativo</span>' : '<span class="badge bg-secondary">Inativo</span>' !!}</div>
                </div>
            </div>
        </div>
        
        <div class="card mb-4">
            <div class="card-header">Alternativa (Quando Esgotado)</div>
            <div class="card-body">
                <div class="mb-3">
                    <h5>{{ $dailySpecial->alternative_name }}</h5>
                    <p>{{ $dailySpecial->alternative_description }}</p>
                    <div><strong>Preço:</strong> €{{ number_format($dailySpecial->alternative_price, 2, ',', ' ') }}</div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-6">
        <div class="card mb-4">
            <div class="card-header">Imagem Principal</div>
            <div class="card-body text-center">
                @if($dailySpecial->image_url)
                    <img src="{{ $dailySpecial->image_url }}" alt="{{ $dailySpecial->name }}" class="img-fluid rounded">
                @else
                    <p class="text-muted">Sem imagem disponível</p>
                @endif
            </div>
        </div>
        
        <div class="card mb-4">
            <div class="card-header">Imagem da Alternativa</div>
            <div class="card-body text-center">
                @if($dailySpecial->alternative_image_url)
                    <img src="{{ $dailySpecial->alternative_image_url }}" alt="{{ $dailySpecial->alternative_name }}" class="img-fluid rounded">
                @else
                    <p class="text-muted">Sem imagem disponível</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection