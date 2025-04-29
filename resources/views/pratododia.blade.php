<head>
    <link rel="stylesheet" href="pratododia.css">
</head>

<section class="dish-of-the-day">
    <div class="container">
        <div class="dish-header">
            <h2>PRATO DO DIA</h2>
            <div class="urgency-badge">
                <i class="fas fa-fire"></i>
                <span>HOJE APENAS | RESTAM <span id="remaining-portions">12</span> DOSE(S)</span>
            </div>
        </div>

        <!-- Prato disponível -->
        <div class="dish-container status-active" id="available-state">
            <div class="dish-image">
                <img src="https://th.bing.com/th/id/OIP.dIv643iFDSvHo0z0kN0YAwHaFj?w=224&h=180&c=7&r=0&o=5&pid=1.7" alt="Frango Assado no Forno">
                <div class="dish-badge">
                    <span>Especial</span>
                </div>
            </div>
            <div class="dish-info">
                <h3>Frango Assado no Forno</h3>
                <div class="dish-price">
                    <span class="original-price">€ 10,99</span>
                    <span class="promo-price">€ 5,49</span>
                </div>
                <p class="dish-description">Frango inteiro assado lentamente no forno com ervas aromáticas, alho e limão. Acompanha batatas rústicas, legumes da época e molho especial da casa. Serve até 2 pessoas.</p>
                <div class="dish-details">
                    <div class="detail-item">
                        <i class="fas fa-clock"></i>
                        <span>Disponível até às 20h</span>
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
            <div class="dish-image">
                <img src="https://th.bing.com/th/id/OIP.97kl_JAqZUu7PSvr2FVH2AHaFj?rs=1&pid=ImgDetMain" alt="Prego no Prato">
                <div class="dish-badge">Sugestão</div>
            </div>
            <div class="dish-info">
                <h3>O Frango Assado esgotou!</h3>
                <div class="dish-price">
                    <span class="promo-price">€ 7,90</span>
                </div>
                <p class="dish-description">Mas não se preocupe — hoje temos um delicioso <strong>Prego no Prato</strong> com bife suculento, batatas fritas crocantes, arroz branco e ovo estrelado. Uma opção prática e saborosa!</p>
                <div class="dish-details">
                    <div class="detail-item">
                        <i class="fas fa-clock"></i>
                        <span>Disponível até às 21h</span>
                    </div>
                    <div class="detail-item">
                        <i class="fas fa-calendar-alt"></i>
                        <span id="alt-dish-date">Hoje</span>
                    </div>
                </div>
                <div>
                    <a href="#menu" class="btn btn-reserve">Ver no Menu</a>
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
        const dateString = today.toLocaleDateString('pt-PT', options);

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
            alert(`Pedido confirmado! Restam ${portions} dose(s).`);
        }
    });

    // Atualização automática a cada 30 segundos (simulação)
    //setTimeout(function() { portions = 0; updatePortions(); }, 2000);
</script>