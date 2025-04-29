<head>
    <link rel="stylesheet" href="pratododia.css">
</head>

<section class="dish-of-the-day">
    <div class="container">
        <div class="dish-header">
            <h2>PRATO DO DIA</h2>
            <div class="urgency-badge">  
                <i class="fas fa-fire"></i>
                <span>HOJE APENAS | RESTAM <span id="remaining-portions">12</span> PORÇÕES</span>
            </div>
        </div>

        <!-- Prato disponível -->
        <div class="dish-container status-active" id="available-state">
            <div class="dish-image">
                <img src="https://images.unsplash.com/photo-1598103442097-8b74394b95c6?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80" alt="Frango Assado no Forno">
                <div class="dish-badge">
                    <span>Especial</span>
                </div>
            </div>
            <div class="dish-info">
                <h3>Frango Assado no Forno</h3>
                <div class="dish-price">
                    <span class="original-price">10,99 $</span>
                    <span class="promo-price">5,49 $</span>
                </div>
                <p class="dish-description">Frango inteiro assado lentamente no forno com ervas aromáticas, alho e limão. Acompanha batatas rústicas, legumes da estação e molho especial da casa. Serve até 2 pessoas.</p>
                <div class="dish-details">
                    <div class="detail-item">
                        <i class="fas fa-clock"></i>
                        <span>Disponível até 20h</span>
                    </div>
                    <div class="detail-item">
                        <i class="fas fa-calendar-alt"></i>
                        <span>Terça-feira, 28 de Novembro</span>
                    </div>
                </div>
                <div>
                    <a href="#" id="order-btn" class="btn btn-reserve">Reservar Agora</a>
                </div>
            </div>
        </div>

        <!-- Sold Out (ainda dentro do container!) -->
        <div class="soldout-container status-hidden" id="soldout-state">
            <div class="soldout-banner">
                <i class="fas fa-hourglass-end"></i> ESGOTADO POR HOJE
            </div>
            <div class="soldout-content">
                <div class="soldout-image">
                    <img src="https://images.unsplash.com/photo-1551218808-94e220e084d2?ixlib=rb-4.0.3&auto=format&fit=crop&w=700&q=80" alt="Esgotado" style="width:100%; border-radius:10px; margin: 20px 0;">
                </div>

                <p class="soldout-message">O prato do dia já esgotou, mas não se preocupe!</p>
                <div class="alternatives">
                    <h4>Experimente a Especialidade da Casa:</h4>
                    <p><a href="#especialidade" class="highlight-link">Bacalhau à Brás (R$ 49,90)</a></p>

                    <h4>Ou veja o nosso Menu Completo:</h4>
                    <a href="#menu" class="btn-see-menu">Ver Menu</a>
                </div>

            </div>
        </div>

    </div> <!-- fecha o .container -->
</section>

<script>
    function updateDailyDishDate() {
        const options = {
            weekday: 'long',
            day: 'numeric',
            month: 'long'
        };
        const today = new Date();
        const dateString = today.toLocaleDateString('pt-BR', options);

        // Capitaliza o dia da semana
        const formattedDate = dateString.charAt(0).toUpperCase() + dateString.slice(1);

        document.querySelector('.detail-item:nth-child(2) span').textContent = formattedDate;
    }

    // Chama a função quando a página carrega
    window.addEventListener('DOMContentLoaded', updateDailyDishDate);

    let portions = 1;

    function updatePortions() {
        const remaining = document.getElementById('remaining-portions');
        remaining.textContent = portions;

        if (portions <= 0) {
            document.getElementById('available-state').classList.remove('status-active');
            document.getElementById('available-state').classList.add('status-hidden');
            document.getElementById('soldout-state').classList.remove('status-hidden');
            document.getElementById('soldout-state').classList.add('status-active');
        }
    }

    // Simula vendas (remover na implementação real)
    document.getElementById('order-btn').addEventListener('click', function() {
        if (portions > 0) {
            portions--;
            updatePortions();
            // Aqui você integraria com seu sistema de pedidos real
            alert(`Pedido confirmado! ${portions} porções restantes.`);
        }
    });

    // Atualização automática a cada 30 segundos (simulação)
    //setTimeout(function() { portions = 0; updatePortions(); }, 2000);
</script>