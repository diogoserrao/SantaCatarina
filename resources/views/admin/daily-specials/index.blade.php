@extends('layouts.admin')

@section('content')
<div class="page-header d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom">
    <h1 class="h3 m-0">Gerenciar Pratos do Dia</h1>
    <div class="d-flex gap-2">
        <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-1"></i> Voltar
        </a>
        <a href="{{ route('admin.daily-specials.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-1"></i> Novo Prato do Dia
        </a>
    </div>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle text-center">
                <thead class="table-light">
                    <tr>
                        <th width="60">Foto</th>
                        <th>Nome</th>
                        <th>Preço</th>
                        <th>Status</th>
                        <th width="220">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($dailySpecials as $special)
                    <tr>
                        <td>
                            @if($special->image_url)
                            <img src="{{ $special->image_url }}" alt="{{ $special->name }}" class="rounded" style="width: 50px; height: 50px; object-fit: cover;">
                            @else
                            <div class="bg-light border rounded d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                <i class="fas fa-image text-muted"></i>
                            </div>
                            @endif
                        </td>
                        <td>{{ $special->name }}</td>
                        <td><strong class="text-success">€{{ number_format($special->price, 2, ',', ' ') }}</strong></td>
                        <td>
                            <span class="badge {{ $special->is_active ? 'bg-success' : 'bg-secondary' }}">
                                {{ $special->is_active ? 'Ativo' : 'Inativo' }}
                            </span>
                        </td>
                        <td>
                            <div class="d-flex flex-wrap justify-content-center gap-2">
                                <a href="{{ route('admin.daily-specials.edit', $special) }}" class="btn btn-sm btn-primary" title="Editar">
                                    <i class="fas fa-edit d-md-none"></i>
                                    <span class="d-none d-md-inline">Editar</span>
                                </a>

                                <form action="{{ route('admin.daily-specials.toggle-status', $special) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-sm {{ $special->is_active ? 'btn-secondary' : 'btn-success' }}">
                                        <i class="fas {{ $special->is_active ? 'fa-toggle-off' : 'fa-toggle-on' }} d-md-none"></i>
                                        <span class="d-none d-md-inline">{{ $special->is_active ? 'Desativar' : 'Ativar' }}</span>
                                    </button>
                                </form>

                                <form action="{{ route('admin.daily-specials.destroy', $special) }}" method="POST"
                                    onsubmit="return confirm('Tem certeza que deseja excluir este prato do dia?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        <i class="fas fa-trash d-md-none"></i>
                                        <span class="d-none d-md-inline">Excluir</span>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-4">
                            <p class="text-muted mb-2">Nenhum prato do dia cadastrado.</p>
                            <a href="{{ route('admin.daily-specials.create') }}" class="btn btn-sm btn-primary">
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