<head>
    <link rel="stylesheet" href="{{ asset('header.css') }}">
    <!-- Adicionar CSS do Glide.js -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Glide.js/3.6.0/css/glide.core.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Glide.js/3.6.0/css/glide.theme.min.css">
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
                <li><a href="#" class="btn-reserva">Reservas</a></li>
            </ul>
        </nav>
    </div>
</header>

<!-- Carrossel de Banners -->
<section id="home" class="banner-carousel">
    <div class="glide">
        <div class="glide__track" data-glide-el="track">
            <ul class="glide__slides">
                @if(isset($banners) && count($banners) > 0)
                @foreach($banners as $banner)
                <li class="glide__slide">
                    <div class="banner-hero" style="background-image: url('{{ $banner->image_url }}');">
                        <div class="banner-overlay">
                            <div class="banner-content">
                                <h2>{{ $banner->title }}</h2>
                                @if($banner->button_text)
                                <a href="{{ $banner->button_link }}" class="btn-hero">{{ $banner->button_text }}</a>
                                @endif
                            </div>
                        </div>
                    </div>
                </li>
                @endforeach
                @else

                <!-- Banner padrão caso não tenha nenhum no banco de dados -->
                <li class="glide__slide">
                    <div class="banner-hero" style="background-image: url('/images/banner1.webp');">
                        <div class="banner-overlay">
                            <div class="banner-content">
                                <h2>Experiências gastronómicas memoráveis</h2>
                                <p>Descubra o equilíbrio perfeito entre tradição e inovação no nosso Menu cuidadosamente elaborado.</p>
                                <a href="#menu" class="btn-hero">Ver Menu</a>
                            </div>
                        </div>
                    </div>
                </li>
                @endforelse
            </ul>
        </div>

        <!-- Setas de navegação -->
        <div class="glide__arrows" data-glide-el="controls">
            <button class="glide__arrow glide__arrow--left" data-glide-dir="<">
                <i class="fas fa-chevron-left"></i>
            </button>
            <button class="glide__arrow glide__arrow--right" data-glide-dir=">">
                <i class="fas fa-chevron-right"></i>
            </button>
        </div>

        
    </div>
</section>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Glide.js/3.6.0/glide.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Verificar quantos slides existem
        const slides = document.querySelectorAll('.glide__slide');
        console.log(`Carrossel inicializando com ${slides.length} slides`);
        
        if (slides.length > 1) {
            const glideCarousel = new Glide('.glide', {
                type: 'carousel',
                autoplay: 5000,
                animationDuration: 800,
                hoverpause: true,
                gap: 0,
                perView: 1,
                startAt: 0
            });
            
            glideCarousel.mount();
            
            // Forçar a mudança de slides para testar
            setInterval(() => {
                glideCarousel.go('>');
            }, 6000);
        }
    });
</script>