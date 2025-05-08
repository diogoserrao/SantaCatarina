<head>
    <link rel="stylesheet" href="menu.css">
</head>

<section class="menu" id="menu">
    <div class="container">
        <h2>Menu</h2>
        <div class="menu-categories">
            <div class="highlight-category">
                <button class="active" data-category="all">Destaques</button>
            </div>
            <div class="regular-categories">
                @foreach($categories as $category)
                <button data-category="{{ $category->slug }}">{{ $category->name }}</button>
                @endforeach
            </div>
        </div>

        <h3 class="section-subtitle featured-title">Destaques</h3>
        <div class="featured-items">
            @foreach($featuredItems as $item)
            <div class="menu-item" data-category="{{ $item->category->slug }}">
                @if($item->image_url)
                <img src="{{ $item->image_url }}" alt="{{ $item->name }}" loading="lazy">
                @endif
                <div class="menu-item-info">
                    <h3>{{ $item->name }}</h3>
                    <p>{{ $item->description }}</p>
                    <div class="price">€ {{ number_format($item->price, 2, ',', ' ') }}</div>
                </div>
            </div>
            @endforeach
        </div>

        <h3 class="section-subtitle menu-complete-title">Menu Completo</h3>
        <div class="menu-list">
            @foreach($categories as $category)
            <div class="menu-section" data-category="{{ $category->slug }}">
                <h4>{{ $category->name }}</h4>
                <ul class="menu-items-list">
                    @foreach($category->menuItems->sortBy('display_order') as $item)
                    <li>
                        <div class="item-name">{{ $item->name }}</div>
                        <div class="item-dots"></div>
                        <div class="item-price">€ {{ number_format($item->price, 2, ',', ' ') }}</div>
                        @if($item->description)
                        <div class="item-description">{{ $item->description }}</div>
                        @endif
                    </li>
                    @endforeach
                </ul>
            </div>
            @endforeach
        </div>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const categoryButtons = document.querySelectorAll('.menu-categories button');
        const menuSections = document.querySelectorAll('.menu-section');
        const featuredItems = document.querySelector('.featured-items');
        const featuredTitle = document.querySelector('.featured-title');
        const menuCompleteTitle = document.querySelector('.menu-complete-title');

        // Mostrar só os destaques no início
        menuSections.forEach(section => section.style.display = 'none');
        featuredItems.style.display = 'grid';
        featuredTitle.style.display = 'block';
        menuCompleteTitle.style.display = 'none';

        categoryButtons.forEach(button => {
            button.addEventListener('click', () => {
                categoryButtons.forEach(btn => btn.classList.remove('active'));
                button.classList.add('active');

                const category = button.getAttribute('data-category');

                if (category === 'all') {
                    menuSections.forEach(section => section.style.display = 'none');
                    featuredItems.style.display = 'grid';
                    featuredTitle.style.display = 'block';
                    menuCompleteTitle.style.display = 'none';
                } else {
                    menuSections.forEach(section => {
                        section.style.display = section.getAttribute('data-category') === category ? 'block' : 'none';
                    });
                    featuredItems.style.display = 'none';
                    featuredTitle.style.display = 'none';
                    menuCompleteTitle.style.display = 'block';
                }
            });
        });
    });
</script>