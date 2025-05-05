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

<form action="{{ route('admin.daily-specials.update', $dailySpecial) }}" method="POST">
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
                            <label for="image_url" class="form-label">URL da Imagem <span class="text-danger">*</span></label>
                            <input type="url" class="form-control" id="image_url" name="image_url" value="{{ old('image_url', $dailySpecial->image_url) }}" required>

                            <!-- Botão para abrir a câmera -->
                            <button type="button" class="btn btn-secondary mt-2" id="openCameraBtn">
                                <i class="fas fa-camera me-1"></i> Capturar da Câmera
                            </button>
                        </div>
                    </div>
                    <!-- Modal para captura de câmera -->
                    <div class="modal fade" id="cameraModal" tabindex="-1" aria-labelledby="cameraModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="cameraModalLabel">Capturar Imagem</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="camera-container">
                                        <video id="cameraFeed" autoplay></video>
                                        <canvas id="capturedImage" style="display:none;"></canvas>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                    <button type="button" class="btn btn-primary" id="captureBtn">Capturar</button>
                                    <button type="button" class="btn btn-success" id="saveImageBtn" style="display:none;">Usar esta Imagem</button>
                                </div>
                            </div>
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
                    @if($dailySpecial->image_url)
                    <img src="{{ $dailySpecial->image_url }}" alt="{{ $dailySpecial->name }}" class="img-fluid rounded mb-3">
                    @endif
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
        const openCameraBtn = document.getElementById('openCameraBtn');
        const cameraModal = new bootstrap.Modal(document.getElementById('cameraModal'));
        const cameraFeed = document.getElementById('cameraFeed');
        const capturedImage = document.getElementById('capturedImage');
        const captureBtn = document.getElementById('captureBtn');
        const saveImageBtn = document.getElementById('saveImageBtn');
        const imageUrlInput = document.getElementById('image_url');
        
        let stream;
        
        openCameraBtn.addEventListener('click', async () => {
            try {
                // Resetar o canvas e botões
                capturedImage.style.display = 'none';
                cameraFeed.style.display = 'block';
                captureBtn.style.display = 'block';
                saveImageBtn.style.display = 'none';
                
                // Obter acesso à câmera
                stream = await navigator.mediaDevices.getUserMedia({ 
                    video: { 
                        facingMode: 'environment',
                        width: { ideal: 1280 },
                        height: { ideal: 720 }
                    } 
                });
                cameraFeed.srcObject = stream;
                
                cameraModal.show();
            } catch (err) {
                console.error('Erro ao acessar câmera:', err);
                alert('Não foi possível acessar a câmera. Verifique se concedeu permissões.');
            }
        });
        
        captureBtn.addEventListener('click', () => {
            // Configurar canvas com as dimensões do vídeo
            capturedImage.width = cameraFeed.videoWidth;
            capturedImage.height = cameraFeed.videoHeight;
            
            // Desenhar o frame atual do vídeo no canvas
            const ctx = capturedImage.getContext('2d');
            ctx.drawImage(cameraFeed, 0, 0, capturedImage.width, capturedImage.height);
            
            // Mostrar a imagem capturada e botão para salvar
            capturedImage.style.display = 'block';
            cameraFeed.style.display = 'none';
            captureBtn.style.display = 'none';
            saveImageBtn.style.display = 'block';
        });
        
        saveImageBtn.addEventListener('click', async () => {
            try {
                // Converter canvas para blob
                const imgBlob = await new Promise(resolve => {
                    capturedImage.toBlob(resolve, 'image/jpeg', 0.85);
                });
                
                // Criar FormData e adicionar a imagem
                const formData = new FormData();
                formData.append('image', imgBlob, 'captured_image.jpg');
                
                // Enviar para o servidor
                const response = await fetch('/admin/upload-image', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: formData
                });
                
                const data = await response.json();
                
                if (data.success) {
                    // Atualizar o campo URL da imagem
                    imageUrlInput.value = data.image_url;
                    
                    // Fechar o modal
                    cameraModal.hide();
                    
                    // Parar a transmissão da câmera
                    if (stream) {
                        stream.getTracks().forEach(track => track.stop());
                    }
                } else {
                    alert('Erro ao fazer upload da imagem: ' + data.message);
                }
            } catch (err) {
                console.error('Erro ao processar imagem:', err);
                alert('Ocorreu um erro ao processar a imagem.');
            }
        });
        
        // Limpar recursos quando o modal for fechado
        document.getElementById('cameraModal').addEventListener('hidden.bs.modal', () => {
            if (stream) {
                stream.getTracks().forEach(track => track.stop());
            }
        });
    });
</script>
