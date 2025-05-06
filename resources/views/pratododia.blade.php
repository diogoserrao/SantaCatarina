<head>
    <link rel="stylesheet" href="{{ asset('pratododia.css') }}">
</head>

<section class="dish-of-the-day" id="pratododia">
    <h2> Prato do Dia</h2>

    <div class="daily-special-container">
        @if(isset($dailySpecial) && $dailySpecial->is_active)
        <!-- Mostrar prato do dia quando está ativo -->
        <div class="dish-container status-active">
            <div class="dish-image">
                <img src="{{ $dailySpecial->image_url }}" alt="{{ $dailySpecial->name }}">
            </div>
            <div class="dish-info">
                <h3>{{ $dailySpecial->name }}</h3>
                <div class="dish-description">
                    <p>{{ $dailySpecial->description }}</p>
                </div>
                <div class="dish-price">
                    <span class="promo-price">€{{ number_format($dailySpecial->price, 2, ',', ' ') }}</span>
                </div>
            </div>
        </div>
        @else
        <!-- Mostrar o prato alternativo quando não há prato do dia ativo -->
        <div class="dish-container status-active">
            <div class="dish-image">
                <img src="https://th.bing.com/th/id/OIP.97kl_JAqZUu7PSvr2FVH2AHaFj?rs=1&pid=ImgDetMain" alt="Prego">
            </div>
            <div class="dish-info">
                <h3>Prego no Prato</h3>
                <div class="dish-description">
                    <p>Mas não se preocupe — hoje temos um delicioso <strong>Prego no Prato</strong> com bife suculento, batatas fritas crocantes, arroz branco e ovo estrelado Uma opção prática e saborosa!</p>
                </div>
                <div class="dish-price">
                    <span class="promo-price">€7,90</span>
                </div>
            </div>
        </div>
        <div class="see-more">
                <a href="#menu" class="see-more-button">Ver mais pratos</a>
            </div>
        @endif
    </div>

</section>