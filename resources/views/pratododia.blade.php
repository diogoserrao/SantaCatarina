<head>
    <link rel="stylesheet" href="{{ asset('pratododia.css') }}">
</head>

<section class="dish-of-the-day" id="pratododia">
    <div class="section-decoration">
        <span class="decoration-icon"><i class="fas fa-utensils"></i></span>
    </div>

    <h2>Pratos do Dia</h2>

    <div class="daily-special-container">
        @if(isset($dailySpecials) && count($dailySpecials) > 0)
        <div class="dishes-grid {{ count($dailySpecials) === 1 ? 'single-dish' : '' }}">
            @foreach($dailySpecials as $dailySpecial)
            <div class="dish-container status-active">
                <div class="dish-image">
                    <img src="{{ $dailySpecial->image_url }}" alt="{{ $dailySpecial->name }}">
                    <div class="dish-badge">Especial de Hoje</div>
                </div>
                <div class="dish-info">
                    <h3>{{ $dailySpecial->name }}</h3>
                    <div class="dish-separator"></div>
                    <div class="dish-description">
                        <p>{{ $dailySpecial->description }}</p>
                    </div>
                    <div class="dish-price">
                        <span class="price-label">Apenas</span>
                        <span class="promo-price">€{{ number_format($dailySpecial->price, 2, ',', ' ') }}</span>
                    </div>
                    <div class="dish-cta">
                        <a href="tel:+351123456789" class="btn-call-now">Reservar</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @else

        <!-- Mostrar o prato alternativo quando não há prato do dia ativo -->
        <div class="dish-container status-alternative">
            <div class="dish-image">
                <img src="https://th.bing.com/th/id/OIP.97kl_JAqZUu7PSvr2FVH2AHaFj?rs=1&pid=ImgDetMain" alt="Prego">
                <div class="dish-badge"><i class="fas fa-star-half-alt"></i> Recomendação do Chef</div>
            </div>
            <div class="dish-info">
                <h3>Prego no Prato</h3>
                <div class="dish-separator"></div>
                <div class="dish-description">
                    <p>Delicie-se com nosso <strong>Prego no Prato</strong>, preparado com um bife suculento, acompanhado de batatas fritas crocantes, arroz branco e um perfeito ovo estrelado. Uma combinação tradicional e irresistível!</p>
                    <p class="note">O prato do dia não está mais disponível hoje.</p>
                </div>
                <div class="dish-price">
                    <span class="price-label">Apenas</span>
                    <span class="promo-price">€7,90</span>
                </div>
                <div class="dish-cta">
                    <a href="#menu" class="reserve-button">Ver Menu</a>
                </div>
            </div>
        </div>
        @endif
    </div>
</section>