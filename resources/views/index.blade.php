<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('global.css') }}">
    <title>Santa Catarina | Café e Retaurante</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>

<body>
    @include('header')
    @include('pratododia')
    @include('sobrenos')
    @include('menu')
    @include('galeria')
    @include('contacts')
    @include('footer')

    <script>
        // Efeito de scroll suave
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
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

       
        

        // Controle do menu mobile
        document.querySelector('.mobile-menu-toggle').addEventListener('click', function() {
            this.classList.toggle('active');
            document.getElementById('main-nav').classList.toggle('open');
        });

        // Fechar menu ao clicar em links
        document.querySelectorAll('#main-nav a').forEach(link => {
            link.addEventListener('click', function() {
                document.getElementById('main-nav').classList.remove('open');
                document.querySelector('.mobile-menu-toggle').classList.remove('active');

            });
        });
    </script>
</body>

</html>