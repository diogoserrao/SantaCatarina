<head>
    <link rel="stylesheet" href="{{ asset('header.css') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<header id="header">
    <div class="header-container">
        <div class="logo">

            <a href="/" style="text-decoration: none;">
                <div class="logo-text">
                    <h1>Santa Catarina</h1>
                    <p>Café & Restaurante</p>
                </div>
            </a>
        </div>
        <div class="mobile-menu-toggle">
            <span></span>
            <span></span>
            <span></span>
        </div>
        <nav id="main-nav">
            <ul>
                <li><a href="#home">Início</a></li>
                <li><a href="#pratododia">Prato do Dia</a></li>
                <li><a href="#about">Sobre Nós</a></li>
                <li><a href="#menu">Menu</a></li>
                <li><a href="#gallery">Galeria</a></li>
                <li><a href="#contact">Contactos</a></li>
                <li><a href="#contact" class="btn-reserva">Reservas</a></li>
            </ul>
        </nav>
    </div>
</header>


<!-- Carrossel de Banners -->
<section id="home" class="banner-carousel">
    <div id="bannerCarousel" class="carousel slide" data-bs-ride="carousel">

        <!-- Slides -->
        <div class="carousel-inner">
            @forelse($banners as $index => $banner)
            <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                <div class="banner-hero" style="background-image: url('{{ $banner->image_url }}');">
                    <div class="banner-overlay">
                        <div class="banner-content">
                            <h2>{{ $banner->title }}</h2>
                            <p>{{ $banner->description }}</p>
                            @if($banner->button_text && $banner->button_link)
                            <a href="{{ $banner->button_link }}" class="btn-hero">{{ $banner->button_text }}</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <!-- Banners estáticos de fallback caso não exista nenhum no banco -->

            <div class="carousel-inner">
            <!-- Banner 1 -->
            <div class="carousel-item active">
                <div class="banner-hero" style="background-image: url('/images/banner1.webp');">
                    <div class="banner-overlay">
                        <div class="banner-content">
                            <h2>Descubra Nossa Culinária</h2>
                            <p>Pratos tradicionais com um toque moderno</p>
                            <a href="#menu" class="btn-hero">Ver Menu</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Banner 2 -->
            <div class="carousel-item">
                <div class="banner-hero" style="background-image: url('/images/banner2.webp');" loading="lazy">
                    <div class="banner-overlay">
                        <div class="banner-content">
                            <h2>Um Ambiente Único</h2>
                            <p>Venha conhecer nosso espaço acolhedor</p>
                            <a href="#about" class="btn-hero">Sobre Nós</a>
                        </div>
                    </div>
                </div>
            </div>
            @endforelse
        </div>

        <!-- Controles (setas - invisíveis por padrão) -->
        <button class="carousel-control-prev" type="button" data-bs-target="#bannerCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Anterior</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#bannerCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Próximo</span>
        </button>
    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Inicialização do carrossel com opções
        const carousel = new bootstrap.Carousel(document.getElementById('bannerCarousel'), {
            interval: 10000,
            wrap: true,
            keyboard: true,
            pause: 'hover',
            touch: true, // Garante que o swipe funcione em mobile
            swipe: true // Habilita explicitamente o swipe
        });

        // Efeito do menu mobile - CORRIGIDO
        const mobileMenuToggle = document.querySelector('.mobile-menu-toggle');
        const nav = document.querySelector('#main-nav');

        if (mobileMenuToggle) {
            // Remover event listeners antigos que podem estar causando conflito
            mobileMenuToggle.replaceWith(mobileMenuToggle.cloneNode(true));

            // Re-selecionar após clonar
            const newMobileMenuToggle = document.querySelector('.mobile-menu-toggle');

            // Adicionar evento com debugging
            newMobileMenuToggle.addEventListener('click', function(e) {
                e.preventDefault(); // Prevenir comportamento padrão
                e.stopPropagation(); // Impedir propagação do evento

                this.classList.toggle('active');
                nav.classList.toggle('open');

                console.log('Menu toggle clicked', {
                    toggleActive: this.classList.contains('active'),
                    navOpen: nav.classList.contains('open')
                });
            });
        }

        // Verificar se está em mobile para ajustar comportamento
        const isMobile = window.innerWidth <= 768;


        if (isMobile) {
            document.querySelector('.banner-carousel').classList.add('mobile-carousel');
        } else {
            const carouselElement = document.querySelector('#bannerCarousel');
            const arrows = document.querySelectorAll('.carousel-control-prev, .carousel-control-next');

            if (carouselElement && arrows.length) {
                carouselElement.addEventListener('mouseenter', function() {
                    arrows.forEach(arrow => arrow.style.opacity = '0.7');
                });

                carouselElement.addEventListener('mouseleave', function() {
                    arrows.forEach(arrow => arrow.style.opacity = '0');
                });
            }
        }
    });
</script>