php
@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Gerenciar Pratos do Dia</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <a href="{{ route('admin.daily-specials.create') }}" class="btn btn-sm btn-primary">
            <i class="fas fa-plus me-1"></i> Novo Prato do Dia
        </a>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th width="50">Foto</th>
                        <th>Nome</th>
                        <th>Preço</th>
                        <th>Porções</th>
                        <th>Status</th>
                        <th width="200">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($dailySpecials as $special)
                        <tr>
                            <td>
                                @if($special->image_url)
                                    <img src="{{ $special->image_url }}" alt="{{ $special->name }}" class="img-thumbnail" 
                                        style="width: 50px; height: 50px; object-fit: cover;">
                                @else
                                    <div class="bg-secondary text-white d-flex align-items-center justify-content-center" 
                                        style="width: 50px; height: 50px;">
                                        <i class="fas fa-image"></i>
                                    </div>
                                @endif
                            </td>
                            <td>{{ $special->name }}</td>
                            <td>
                                <span class="text-decoration-line-through text-muted">€{{ number_format($special->original_price, 2, ',', ' ') }}</span><br>
                                <strong class="text-success">€{{ number_format($special->promo_price, 2, ',', ' ') }}</strong>
                            </td>
                            <td>{{ $special->portions_available }}</td>
                            <td>
                                @if($special->is_active)
                                    <span class="badge bg-success">Ativo</span>
                                @else
                                    <span class="badge bg-secondary">Inativo</span>
                                @endif
                            </td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('admin.daily-specials.show', $special) }}" class="btn btn-sm btn-info">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.daily-specials.edit', $special) }}" class="btn btn-sm btn-primary">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    
                                    @if(!$special->is_active)
                                        <form action="{{ route('admin.daily-specials.activate', $special) }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-success" title="Ativar">
                                                <i class="fas fa-check"></i>
                                            </button>
                                        </form>
                                    @endif
                                    
                                    <form action="{{ route('admin.daily-specials.destroy', $special) }}" method="POST" class="d-inline" 
                                        onsubmit="return confirm('Tem certeza que deseja excluir este prato do dia?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-4">
                                <p class="text-muted mb-0">Nenhum prato do dia cadastrado.</p>
                                <a href="{{ route('admin.daily-specials.create') }}" class="btn btn-sm btn-primary mt-3">
                                    <i class="fas fa-plus me-1"></i> Criar Novo
                                </a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="d-flex justify-content-center mt-4">
                {{ $dailySpecials->links() }}
            </div>
        </div>
    </div>
</div>
@endsection