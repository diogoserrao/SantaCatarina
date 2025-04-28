<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Santa Catarina | Café e Retaurante</title>
    <style>
        /* Estilos Gerais */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Montserrat', sans-serif;
        }
        
        body {
            background-color: #f9f5f0;
            color: #333;
            line-height: 1.6;
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }
        
        section {
            padding: 80px 0;
        }
        
        h2 {
            font-size: 36px;
            color: #5a3921;
            margin-bottom: 40px;
            text-align: center;
            position: relative;
        }
        
        h2:after {
            content: '';
            display: block;
            width: 80px;
            height: 3px;
            background: #c7a17a;
            margin: 15px auto;
        }
        
        .btn {
            display: inline-block;
            background-color: #c7a17a;
            color: white;
            padding: 12px 25px;
            border-radius: 30px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s;
            border: none;
            cursor: pointer;
        }
        
        .btn:hover {
            background-color: #8b5a2b;
            transform: translateY(-3px);
        }
        
        /* Cabeçalho */
        header {
            background-color: #fff;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
            transition: all 0.3s;
        }
        
        header.sticky {
            padding: 10px 0;
            background-color: rgba(255,255,255,0.95);
        }
        
        .header-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 5%;
            max-width: 1400px;
            margin: 0 auto;
        }
        
        .logo {
            display: flex;
            align-items: center;
        }
        
        .logo img {
            height: 50px;
            margin-right: 15px;
        }
        
        .logo-text h1 {
            font-size: 24px;
            color: #8b5a2b;
            font-weight: 700;
        }
        
        .logo-text p {
            font-size: 14px;
            color: #a38b71;
            font-weight: 300;
        }
        
        /* Navegação */
        nav ul {
            display: flex;
            list-style: none;
        }
        
        nav ul li {
            margin-left: 30px;
        }
        
        nav ul li a {
            text-decoration: none;
            color: #5a3921;
            font-weight: 500;
            font-size: 16px;
            transition: color 0.3s;
        }
        
        nav ul li a:hover {
            color: #c7a17a;
        }
        
        .btn-reserva {
            background-color: #c7a17a;
            color: white;
            padding: 10px 20px;
            border-radius: 30px;
            font-weight: 600;
            transition: background-color 0.3s;
        }
        
        .btn-reserva:hover {
            background-color: #8b5a2b;
        }
        
        /* Hero Section */
        .hero {
            height: 100vh;
            background: linear-gradient(rgba(0,0,0,0.4), rgba(0,0,0,0.4)), 
                        url('https://images.unsplash.com/photo-1414235077428-338989a2e8c0?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80');
            background-size: cover;
            background-position: center;
            display: flex;
            align-items: center;
            text-align: center;
            color: white;
            padding: 0 10%;
            margin-top: 90px;
        }
        
        .hero-content {
            max-width: 800px;
            margin: 0 auto;
        }
        
        .hero h2 {
            font-size: 48px;
            margin-bottom: 20px;
            font-weight: 700;
            color: white;
        }
        
        .hero h2:after {
            background: white;
        }
        
        .hero p {
            font-size: 20px;
            margin-bottom: 30px;
            font-weight: 300;
        }
        
        .btn-hero {
            background-color: #c7a17a;
            color: white;
            padding: 15px 30px;
            border-radius: 30px;
            font-weight: 600;
            font-size: 18px;
            text-decoration: none;
            display: inline-block;
            transition: all 0.3s;
        }
        
        .btn-hero:hover {
            background-color: #8b5a2b;
            transform: translateY(-3px);
        }
        
        /* Sobre Nós */
        .about {
            background-color: white;
        }
        
        .about-content {
            display: flex;
            align-items: center;
            gap: 50px;
        }
        
        .about-text {
            flex: 1;
        }
        
        .about-text h3 {
            font-size: 24px;
            color: #5a3921;
            margin-bottom: 20px;
        }
        
        .about-text p {
            margin-bottom: 20px;
        }
        
        .about-image {
            flex: 1;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }
        
        .about-image img {
            width: 100%;
            height: auto;
            display: block;
        }
        
        /* Cardápio */
        .menu {
            background-color: #f9f5f0;
        }
        
        .menu-categories {
            display: flex;
            justify-content: center;
            margin-bottom: 40px;
            flex-wrap: wrap;
        }
        
        .menu-categories button {
            background: none;
            border: none;
            padding: 10px 20px;
            margin: 0 10px;
            font-size: 16px;
            font-weight: 600;
            color: #5a3921;
            cursor: pointer;
            transition: all 0.3s;
        }
        
        .menu-categories button.active,
        .menu-categories button:hover {
            color: #c7a17a;
        }
        
        .menu-items {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 30px;
        }
        
        .menu-item {
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            transition: transform 0.3s;
        }
        
        .menu-item:hover {
            transform: translateY(-10px);
        }
        
        .menu-item img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }
        
        .menu-item-info {
            padding: 20px;
        }
        
        .menu-item-info h3 {
            font-size: 20px;
            color: #5a3921;
            margin-bottom: 10px;
        }
        
        .menu-item-info p {
            color: #777;
            margin-bottom: 15px;
        }
        
        .menu-item-info .price {
            font-size: 18px;
            font-weight: 700;
            color: #c7a17a;
        }
        
        /* Galeria */
        .gallery {
            background-color: white;
        }
        
        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
        }
        
        .gallery-item {
            position: relative;
            overflow: hidden;
            border-radius: 10px;
            height: 250px;
        }
        
        .gallery-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s;
        }
        
        .gallery-item:hover img {
            transform: scale(1.1);
        }
        
        /* Contato */
        .contact {
            background-color: #f9f5f0;
        }
        
        .contact-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 40px;
        }
        
        .contact-info h3 {
            font-size: 24px;
            color: #5a3921;
            margin-bottom: 20px;
        }
        
        .contact-info p {
            margin-bottom: 15px;
        }
        
        .contact-info i {
            color: #c7a17a;
            margin-right: 10px;
            width: 20px;
            text-align: center;
        }
        
        .contact-form input,
        .contact-form textarea {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-family: 'Montserrat', sans-serif;
        }
        
        .contact-form textarea {
            height: 150px;
            resize: vertical;
        }
        
        /* Rodapé */
        footer {
            background-color: #5a3921;
            color: white;
            padding: 50px 0 20px;
            text-align: center;
        }
        
        .footer-content {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
            margin-bottom: 30px;
        }
        
        .footer-column {
            flex: 1;
            min-width: 250px;
            margin-bottom: 30px;
        }
        
        .footer-column h3 {
            font-size: 20px;
            margin-bottom: 20px;
            color: #c7a17a;
        }
        
        .footer-column p {
            margin-bottom: 15px;
        }
        
        .social-links {
            display: flex;
            justify-content: center;
            gap: 15px;
        }
        
        .social-links a {
            color: white;
            font-size: 20px;
            transition: color 0.3s;
        }
        
        .social-links a:hover {
            color: #c7a17a;
        }
        
        .copyright {
            border-top: 1px solid rgba(255,255,255,0.1);
            padding-top: 20px;
            font-size: 14px;
        }
    </style>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body>
    <!-- Cabeçalho -->
    <header id="header">
        <div class="header-container">
            <div class="logo">
                <img src="logo.png" alt="Santa Catarina">
                <div class="logo-text">
                    <h1>Santa Catarina</h1>
                    <p>Café & Gastronomia</p>
                </div>
            </div>
            
            <nav>
                <ul>
                    <li><a href="#home">Início</a></li>
                    <li><a href="#about">Sobre Nós</a></li>
                    <li><a href="#menu">Cardápio</a></li>
                    <li><a href="#gallery">Galeria</a></li>
                    <li><a href="#contact">Contato</a></li>
                    <li><a href="#" class="btn-reserva">Reservas</a></li>
                </ul>
            </nav>
        </div>
    </header>
    
    <!-- Página Inicial -->
    <section class="hero" id="home">
        <div class="hero-content">
            <h2>Experiências gastronômicas memoráveis</h2>
            <p>Descubra o equilíbrio perfeito entre tradição e inovação em nosso cardápio cuidadosamente elaborado.</p>
            <a href="#menu" class="btn-hero">Ver Cardápio</a>
        </div>
    </section>
    
    <!-- Sobre Nós -->
    <section class="about" id="about">
        <div class="container">
            <h2>Sobre Nós</h2>
            <div class="about-content">
                <div class="about-text">
                    <h3>Nossa História</h3>
                    <p>Fundado em 2010, o Santa Catarina nasceu da paixão por gastronomia e pelo prazer de servir. O que começou como um pequeno café de bairro transformou-se em um dos estabelecimentos mais queridos da cidade.</p>
                    <p>Nossa filosofia é simples: ingredientes frescos, preparo artesanal e atendimento caloroso. Trabalhamos diretamente com produtores locais para oferecer o melhor da região em cada prato.</p>
                    <p>Venha nos visitar e experimente a diferença que o amor pela culinária pode fazer em cada detalhe da sua refeição.</p>
                    <a href="#gallery" class="btn">Conheça Nossos Espaços</a>
                </div>
                <div class="about-image">
                    <img src="https://images.unsplash.com/photo-1555396273-367ea4eb4db5?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80" alt="Interior do restaurante">
                </div>
            </div>
        </div>
    </section>
    
    <!-- Cardápio -->
    <section class="menu" id="menu">
        <div class="container">
            <h2>Nosso Cardápio</h2>
            <div class="menu-categories">
                <button class="active" data-category="all">Tudo</button>
                <button data-category="cafe">Cafés</button>
                <button data-category="breakfast">Café da Manhã</button>
                <button data-category="lunch">Almoço</button>
                <button data-category="dessert">Sobremesas</button>
            </div>
            <div class="menu-items">
                <!-- Item 1 -->
                <div class="menu-item" data-category="cafe">
                    <img src="https://images.unsplash.com/photo-1517701550927-30cf4ba1dba5?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80" alt="Café Especial">
                    <div class="menu-item-info">
                        <h3>Café Especial da Casa</h3>
                        <p>Nosso blend exclusivo, torrado artesanalmente e preparado com cuidado.</p>
                        <div class="price">R$ 8,90</div>
                    </div>
                </div>
                
                <!-- Item 2 -->
                <div class="menu-item" data-category="breakfast">
                    <img src="https://images.unsplash.com/photo-1484723091739-30a097e8f929?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80" alt="Café da Manhã Completo">
                    <div class="menu-item-info">
                        <h3>Café da Manhã Completo</h3>
                        <p>Pão artesanal, frios selecionados, ovos, frutas e suco natural.</p>
                        <div class="price">R$ 24,90</div>
                    </div>
                </div>
                
                <!-- Item 3 -->
                <div class="menu-item" data-category="lunch">
                    <img src="https://images.unsplash.com/photo-1546069901-ba9599a7e63c?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80" alt="Risoto de Cogumelos">
                    <div class="menu-item-info">
                        <h3>Risoto de Cogumelos</h3>
                        <p>Risoto cremoso com mix de cogumelos frescos e trufa negra.</p>
                        <div class="price">R$ 42,90</div>
                    </div>
                </div>
                
                <!-- Item 4 -->
                <div class="menu-item" data-category="dessert">
                    <img src="https://images.unsplash.com/photo-1563805042-7684c019e1cb?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80" alt="Cheesecake de Frutas Vermelhas">
                    <div class="menu-item-info">
                        <h3>Cheesecake de Frutas Vermelhas</h3>
                        <p>Sobremesa cremosa com calda de frutas vermelhas frescas.</p>
                        <div class="price">R$ 18,90</div>
                    </div>
                </div>
                
                <!-- Item 5 -->
                <div class="menu-item" data-category="cafe">
                    <img src="https://images.unsplash.com/photo-1511920170033-f8396924c348?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80" alt="Cappuccino Clássico">
                    <div class="menu-item-info">
                        <h3>Cappuccino Clássico</h3>
                        <p>Espresso, leite vaporizado e uma generosa camada de espuma.</p>
                        <div class="price">R$ 12,90</div>
                    </div>
                </div>
                
                <!-- Item 6 -->
                <div class="menu-item" data-category="lunch">
                    <img src="https://images.unsplash.com/photo-1544025162-d76694265947?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80" alt="Salada Caesar">
                    <div class="menu-item-info">
                        <h3>Salada Caesar com Frango</h3>
                        <p>Alface romana, croutons, parmesão e molho caesar com tiras de frango grelhado.</p>
                        <div class="price">R$ 32,90</div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Galeria -->
    <section class="gallery" id="gallery">
        <div class="container">
            <h2>Nossa Galeria</h2>
            <div class="gallery-grid">
                <div class="gallery-item">
                    <img src="https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80" alt="Ambiente do restaurante">
                </div>
                <div class="gallery-item">
                    <img src="https://images.unsplash.com/photo-1555396273-367ea4eb4db5?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80" alt="Interior do café">
                </div>
                <div class="gallery-item">
                    <img src="https://images.unsplash.com/photo-1551218808-94e220e084d2?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80" alt="Preparo de alimentos">
                </div>
                <div class="gallery-item">
                    <img src="https://images.unsplash.com/photo-1414235077428-338989a2e8c0?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80" alt="Pratos servidos">
                </div>
                <div class="gallery-item">
                    <img src="https://images.unsplash.com/photo-1470337458703-46ad1756a187?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80" alt="Evento no restaurante">
                </div>
                <div class="gallery-item">
                    <img src="https://images.unsplash.com/photo-1517701550927-30cf4ba1dba5?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80" alt="Cafés especiais">
                </div>
            </div>
        </div>
    </section>
    
    <!-- Contato -->
    <section class="contact" id="contact">
        <div class="container">
            <h2>Entre em Contato</h2>
            <div class="contact-container">
                <div class="contact-info">
                    <h3>Informações</h3>
                    <p><i class="fas fa-map-marker-alt"></i> Rua Gastronomia, 123 - Centro, Cidade</p>
                    <p><i class="fas fa-phone"></i> (11) 1234-5678</p>
                    <p><i class="fas fa-envelope"></i> contato@deliciaearoma.com</p>
                    <p><i class="fas fa-clock"></i> Seg-Sex: 8h-20h | Sáb-Dom: 9h-22h</p>
                    
                    <h3 style="margin-top: 30px;">Redes Sociais</h3>
                    <div class="social-links">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-whatsapp"></i></a>
                    </div>
                </div>
                
                <div class="contact-form">
                    <form>
                        <input type="text" placeholder="Seu Nome" required>
                        <input type="email" placeholder="Seu E-mail" required>
                        <input type="tel" placeholder="Seu Telefone">
                        <textarea placeholder="Sua Mensagem" required></textarea>
                        <button type="submit" class="btn">Enviar Mensagem</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Rodapé -->
    <footer>
        <div class="container">
            <div class="footer-content">
                <div class="footer-column">
                    <h3>Santa Catarina</h3>
                    <p>Onde cada xícara e cada prato contam uma história de paixão pela gastronomia.</p>
                    <div class="social-links">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-whatsapp"></i></a>
                    </div>
                </div>
                
                <div class="footer-column">
                    <h3>Horário de Funcionamento</h3>
                    <p>Segunda a Sexta: 8h - 20h</p>
                    <p>Sábado e Domingo: 9h - 22h</p>
                    <p>Feriados: 10h - 18h</p>
                </div>
                
            </div>
            
            <div class="copyright">
                <p>&copy; 2025 Santa Catarina. Todos os direitos reservados.</p>
            </div>
        </div>
    </footer>
    
    <script>
        // Efeito de scroll suave
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });
        
        // Efeito de header ao scrollar
        window.addEventListener('scroll', function() {
            const header = document.getElementById('header');
            if (window.scrollY > 100) {
                header.classList.add('sticky');
            } else {
                header.classList.remove('sticky');
            }
        });
        
        // Filtro do cardápio
        const filterButtons = document.querySelectorAll('.menu-categories button');
        const menuItems = document.querySelectorAll('.menu-item');
        
        filterButtons.forEach(button => {
            button.addEventListener('click', () => {
                // Remove a classe active de todos os botões
                filterButtons.forEach(btn => btn.classList.remove('active'));
                // Adiciona a classe active apenas no botão clicado
                button.classList.add('active');
                
                const category = button.getAttribute('data-category');
                
                menuItems.forEach(item => {
                    if (category === 'all' || item.getAttribute('data-category') === category) {
                        item.style.display = 'block';
                    } else {
                        item.style.display = 'none';
                    }
                });
            });
        });
    </script>
</body>
</html>