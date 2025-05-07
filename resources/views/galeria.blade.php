
<head>
    <link rel="stylesheet" href="{{ asset('galeria.css') }}">
</head>

<section class="gallery" id="gallery">
    <div class="container">
        <h2>A Nossa Galeria</h2>
        <div class="gallery-grid">
            @forelse($galleryImages as $image)
            <div class="gallery-item">
                <img src="{{ $image->image_url }}" alt="{{ $image->title }}">
            </div>
            @empty
            <div class="text-center w-100 py-5">
                <p class="text-muted">Não há imagens na galeria.</p>
            </div>
            @endforelse
        </div>
    </div>
</section>