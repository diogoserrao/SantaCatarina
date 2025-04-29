<head>
    <link rel="stylesheet" href="menu.css">
</head>

<section class="menu" id="menu">
    <div class="container">
        <h2>Menu</h2>
        <div class="menu-categories">
            <button class="active" data-category="all">Tudo</button>
            <button data-category="entradas">Entradas</button>
            <button data-category="carnes">Carnes</button>
            <button data-category="peixes">Peixes</button>
            <button data-category="sandes">Sandes</button>
            <button data-category="sobremesas">Sobremesas</button>
            <button data-category="bebidas">Bebidas</button>
        </div>

        <h3 class="section-subtitle">Destaques</h3>
        <div class="featured-items">
            <!-- Item 1 -->
            <div class="menu-item" data-category="cafe">
                <img src="https://images.unsplash.com/photo-1517701550927-30cf4ba1dba5?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80" alt="Café Especial">
                <div class="menu-item-info">
                    <h3>Café Especial da Casa</h3>
                    <p>O nosso blend exclusivo, torrado artesanalmente e preparado com cuidado.</p>
                    <div class="price">8,90 €</div>
                </div>
            </div>

            <!-- Item 2 -->
            <div class="menu-item" data-category="breakfast">
                <img src="https://images.unsplash.com/photo-1484723091739-30a097e8f929?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80" alt="Café da Manhã Completo">
                <div class="menu-item-info">
                    <h3>Pequeno-almoço Completo</h3>
                    <p>Pão artesanal, frios selecionados, ovos, fruta e sumo natural.</p>
                    <div class="price">€ 24,90</div>
                </div>
            </div>

            <!-- Item 3 -->
            <div class="menu-item" data-category="lunch">
                <img src="https://images.unsplash.com/photo-1546069901-ba9599a7e63c?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80" alt="Risoto de Cogumelos">
                <div class="menu-item-info">
                    <h3>Risoto de Cogumelos</h3>
                    <p>Risoto cremoso com mistura de cogumelos frescos e trufa negra.</p>
                    <div class="price">€ 42,90</div>
                </div>
            </div>

            <!-- Item 4 -->
            <div class="menu-item" data-category="dessert">
                <img src="https://images.unsplash.com/photo-1563805042-7684c019e1cb?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80" alt="Cheesecake de Frutas Vermelhas">
                <div class="menu-item-info">
                    <h3>Cheesecake de Frutos Vermelhos</h3>
                    <p>Sobremesa cremosa com calda de frutos vermelhos frescos.</p>
                    <div class="price">€ 18,90</div>
                </div>
            </div>

            <!-- Item 5 -->
            <div class="menu-item" data-category="cafe">
                <img src="https://images.unsplash.com/photo-1511920170033-f8396924c348?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80" alt="Cappuccino Clássico">
                <div class="menu-item-info">
                    <h3>Cappuccino Clássico</h3>
                    <p>Expresso, leite vaporizado e uma generosa camada de espuma.</p>
                    <div class="price">€ 12,90</div>
                </div>
            </div>

            <!-- Item 6 -->
            <div class="menu-item" data-category="lunch">
                <img src="https://images.unsplash.com/photo-1544025162-d76694265947?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80" alt="Salada Caesar">
                <div class="menu-item-info">
                    <h3>Salada César com Frango</h3>
                    <p>Alface romana, croutons, queijo parmesão e molho César com tiras de frango grelhado.</p>
                    <div class="price">€ 32,90</div>
                </div>
            </div>
        </div>
        
        <h3 class="section-subtitle">Menu Completo</h3>
        <div class="menu-list">
            <!-- Entradas -->
            <div class="menu-section" data-category="entradas">
                <h4>Entradas</h4>
                <ul class="menu-items-list">
                    <li>
                        <div class="item-name">Croquetes de Bacalhau</div>
                        <div class="item-dots"></div>
                        <div class="item-price">€ 8,90</div>
                        <div class="item-description">Croquetes caseiros de bacalhau com molho tártaro</div>
                    </li>
                    <li>
                        <div class="item-name">Tábua de Enchidos</div>
                        <div class="item-dots"></div>
                        <div class="item-price">€ 12,00</div>
                        <div class="item-description">Seleção de enchidos tradicionais portugueses</div>
                    </li>
                </ul>
            </div>

            <!-- Carnes -->
            <div class="menu-section" data-category="carnes">
                <h4>Carnes</h4>
                <ul class="menu-items-list">
                    <li>
                        <div class="item-name">Bife à Portuguesa</div>
                        <div class="item-dots"></div>
                        <div class="item-price">€ 24,50</div>
                        <div class="item-description">Bife grelhado com ovo a cavalo, batata frita e arroz</div>
                    </li>
                    <li>
                        <div class="item-name">Costeletas de Borrego</div>
                        <div class="item-dots"></div>
                        <div class="item-price">€ 21,00</div>
                        <div class="item-description">Servidas com puré de batata e legumes salteados</div>
                    </li>
                </ul>
            </div>

            <!-- Peixes -->
            <div class="menu-section" data-category="peixes">
                <h4>Peixes</h4>
                <ul class="menu-items-list">
                    <li>
                        <div class="item-name">Bacalhau à Brás</div>
                        <div class="item-dots"></div>
                        <div class="item-price">€ 17,90</div>
                        <div class="item-description">Desfiado com batata palha, ovo e azeitonas</div>
                    </li>
                    <li>
                        <div class="item-name">Dourada Grelhada</div>
                        <div class="item-dots"></div>
                        <div class="item-price">€ 19,50</div>
                        <div class="item-description">Acompanhada de legumes e batata cozida</div>
                    </li>
                </ul>
            </div>

            <!-- Sandes -->
            <div class="menu-section" data-category="sandes">
                <h4>Sandes</h4>
                <ul class="menu-items-list">
                    <li>
                        <div class="item-name">Sandes de Prego</div>
                        <div class="item-dots"></div>
                        <div class="item-price">€ 7,00</div>
                        <div class="item-description">Prego no pão com mostarda e batata frita</div>
                    </li>
                    <li>
                        <div class="item-name">Sandes de Frango Grelhado</div>
                        <div class="item-dots"></div>
                        <div class="item-price">€ 6,50</div>
                        <div class="item-description">Frango grelhado com alface e molho de iogurte</div>
                    </li>
                </ul>
            </div>

            <!-- Sobremesas -->
            <div class="menu-section" data-category="sobremesas">
                <h4>Sobremesas</h4>
                <ul class="menu-items-list">
                    <li>
                        <div class="item-name">Mousse de Chocolate</div>
                        <div class="item-dots"></div>
                        <div class="item-price">€ 4,20</div>
                        <div class="item-description">Cremosa e intensa, com raspas de chocolate</div>
                    </li>
                    <li>
                        <div class="item-name">Tarte de Amêndoa</div>
                        <div class="item-dots"></div>
                        <div class="item-price">€ 4,80</div>
                        <div class="item-description">Base crocante com cobertura de amêndoas caramelizadas</div>
                    </li>
                </ul>
            </div>

            <!-- Bebidas -->
            <div class="menu-section" data-category="bebidas">
                <h4>Bebidas</h4>
                <ul class="menu-items-list">
                    <li>
                        <div class="item-name">Sumo Natural de Laranja</div>
                        <div class="item-dots"></div>
                        <div class="item-price">€ 3,00</div>
                        <div class="item-description">Espremido na hora</div>
                    </li>
                    <li>
                        <div class="item-name">Copo de Vinho Tinto</div>
                        <div class="item-dots"></div>
                        <div class="item-price">€ 3,80</div>
                        <div class="item-description">Vinho da casa, de produção regional</div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const categoryButtons = document.querySelectorAll('.menu-categories button');
        const menuSections = document.querySelectorAll('.menu-section');
        const featuredItems = document.querySelector('.featured-items');

        categoryButtons.forEach(button => {
            button.addEventListener('click', () => {
                // Remove active de todos os botões
                categoryButtons.forEach(btn => btn.classList.remove('active'));
                button.classList.add('active');

                const category = button.getAttribute('data-category');

                if (category === 'all') {
                    menuSections.forEach(section => section.style.display = 'block');
                    featuredItems.style.display = 'grid';
                } else {
                    menuSections.forEach(section => {
                        if (section.getAttribute('data-category') === category) {
                            section.style.display = 'block';
                        } else {
                            section.style.display = 'none';
                        }
                    });
                    featuredItems.style.display = 'none';
                }
            });
        });
    });
</script>