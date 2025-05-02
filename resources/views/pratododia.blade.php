<head>
    <link rel="stylesheet" href="{{ asset('pratododia.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<section class="dish-of-the-day" id="pratododia">
    <div class="container">
        @if(isset($noDailySpecial))
        <div class="no-special">
            <h2>Sem prato do dia disponível</h2>
            <p>No momento, não temos um prato do dia especial. Consulte nosso menu regular para outras opções.</p>
            <a href="#menu" class="btn">Ver Menu</a>
        </div>
        @else
        <div class="dish-header">
            <h2>PRATO DO DIA</h2>
            <div class="urgency-badge">
                <i class="fas fa-fire"></i>
                <span>HOJE APENAS | RESTAM <span id="remaining-portions">{{ $dailySpecial->portions_available }}</span> DOSE(S)</span>
            </div>
        </div>

        <!-- Prato disponível -->
        <div class="dish-container {{ $dailySpecial->hasAvailablePortions() ? 'status-active' : 'status-hidden' }}" id="available-state">
            <div class="dish-image">
                <img src="{{ $dailySpecial->image_url }}" alt="{{ $dailySpecial->name }}">
                <div class="dish-badge">
                    <span>{{ $dailySpecial->badge_text }}</span>
                </div>
            </div>
            <div class="dish-info">
                <h3>{{ $dailySpecial->name }}</h3>
                <div class="dish-price">
                    <span class="original-price">€ {{ number_format($dailySpecial->original_price, 2, ',', ' ') }}</span>
                    <span class="promo-price">€ {{ number_format($dailySpecial->promo_price, 2, ',', ' ') }}</span>
                </div>
                <p class="dish-description">{{ $dailySpecial->description }}</p>
                <div class="dish-details">
                    <div class="detail-item">
                        <i class="fas fa-clock"></i>
                        <span>Disponível até às {{ $dailySpecial->formatted_available_until }}</span>
                    </div>
                    <div class="detail-item">
                        <i class="fas fa-calendar-alt"></i>
                        <span>Hoje</span>
                    </div>
                </div>
                <div>
                    <a href="#" id="order-btn" class="btn btn-reserve" data-id="{{ $dailySpecial->id }}">Reservar Agora</a>
                </div>
            </div>
        </div>

        <!-- Sold Out (quando esgotado) -->
        <div class="soldout-container {{ !$dailySpecial->hasAvailablePortions() ? 'status-active' : 'status-hidden' }}" id="soldout-state">
            <div class="dish-image">
                <img src="{{ $dailySpecial->alternative_image_url }}" alt="{{ $dailySpecial->alternative_name }}">
                <div class="dish-badge">Sugestão</div>
            </div>
            <div class="dish-info">
                <h3>O {{ $dailySpecial->name }} esgotou!</h3>
                <div class="dish-price">
                    <span class="promo-price">€ {{ number_format($dailySpecial->alternative_price, 2, ',', ' ') }}</span>
                </div>
                <p class="dish-description">{{ $dailySpecial->alternative_description }}</p>
                <div class="dish-details">
                    <div class="detail-item">
                        <i class="fas fa-clock"></i>
                        <span>Disponível até às {{ $dailySpecial->formatted_alternative_available_until }}</span>
                    </div>
                    <div class="detail-item">
                        <i class="fas fa-calendar-alt"></i>
                        <span id="alt-dish-date">Hoje</span>
                    </div>
                </div>
                <div>
                    <a href="#menu" class="btn btn-reserve">Ver no Menu</a>
                </div>
                <div style="margin-top: 50px; padding: 20px; border: 1px solid #ddd; background: #f9f9f9;">
                    <h4>Controles Administrativos</h4>
                    <form id="resetForm" style="display: flex; gap: 10px; align-items: center;">
                        <label for="portions">Definir porções:</label>
                        <input type="number" id="portions" value="12" min="0" style="width: 80px;">
                        <button type="submit" style="background: #c7a17a; color: white; border: none; padding: 5px 15px; cursor: pointer;">Atualizar</button>
                    </form>
                </div>
            </div>
        </div>
        @endif

    </div>
</section>

<script>
     document.getElementById('resetForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const portions = document.getElementById('portions').value;
            
            fetch(`/daily-special/{{ $dailySpecial->id }}/update-portions`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    portions: -Math.abs(parseInt(document.getElementById('remaining-portions').textContent)) + parseInt(portions)
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    document.getElementById('remaining-portions').textContent = data.remaining;
                    document.getElementById('available-state').classList.add('status-active');
                    document.getElementById('available-state').classList.remove('status-hidden');
                    document.getElementById('soldout-state').classList.add('status-hidden');
                    document.getElementById('soldout-state').classList.remove('status-active');
                    alert(`Porções atualizadas para: ${data.remaining}`);
                }
            });
        });
        
    document.addEventListener('DOMContentLoaded', function() {
        // Atualizar a data dinamicamente
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

            const dateElements = document.querySelectorAll('.detail-item:nth-child(2) span');
            dateElements.forEach(element => {
                element.textContent = formattedDate;
            });
        }

        updateDailyDishDate();

        // Gerenciar reservas do prato do dia
        const orderBtn = document.getElementById('order-btn');

        if (orderBtn) {
            orderBtn.addEventListener('click', function(e) {
                e.preventDefault();

                const specialId = this.getAttribute('data-id');

                // Envio AJAX para diminuir as porções
                fetch(`/daily-special/${specialId}/update-portions`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({
                            portions: 1
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Atualiza o número de porções
                            document.getElementById('remaining-portions').textContent = data.remaining;

                            // Verifica se esgotou
                            if (!data.hasPortionsLeft) {
                                document.getElementById('available-state').classList.remove('status-active');
                                document.getElementById('available-state').classList.add('status-hidden');
                                document.getElementById('soldout-state').classList.remove('status-hidden');
                                document.getElementById('soldout-state').classList.add('status-active');
                            }

                            alert(`Pedido confirmado! Restam ${data.remaining} dose(s).`);
                        }
                    })
                    .catch(error => {
                        console.error('Erro:', error);
                        alert('Não foi possível processar seu pedido. Por favor, tente novamente.');
                    });
            });
        }
    });
</script>