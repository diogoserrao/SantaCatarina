<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // ======== INSERIR CATEGORIAS =========
        $categories = [
            ['name' => 'Entradas', 'slug' => 'entradas', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Carnes', 'slug' => 'carnes', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Peixes', 'slug' => 'peixes', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Sandes', 'slug' => 'sandes', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Sobremesas', 'slug' => 'sobremesas', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Bebidas', 'slug' => 'bebidas', 'created_at' => now(), 'updated_at' => now()],
        ];
        DB::table('categories')->insert($categories);

        // ======== INSERIR ITENS DE MENU =========
        // Entradas (ID 1)
        DB::table('menu_items')->insert([
            [
                'name' => 'Croquetes de Bacalhau',
                'description' => 'Croquetes caseiros de bacalhau com molho tártaro',
                'price' => 8.90,
                'category_id' => 1,
                'featured' => false,
                'display_order' => 0,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Tábua de Enchidos',
                'description' => 'Seleção de enchidos tradicionais portugueses',
                'price' => 12.00,
                'category_id' => 1,
                'featured' => false,
                'display_order' => 0,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);

        // Carnes (ID 2)
        DB::table('menu_items')->insert([
            [
                'name' => 'Bife à Portuguesa',
                'description' => 'Bife grelhado com ovo a cavalo, batata frita e arroz',
                'price' => 24.50,
                'category_id' => 2,
                'featured' => false,
                'display_order' => 0,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Costeletas de Borrego',
                'description' => 'Servidas com puré de batata e legumes salteados',
                'price' => 21.00,
                'category_id' => 2,
                'featured' => false,
                'display_order' => 0,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);

        // Peixes (ID 3)
        DB::table('menu_items')->insert([
            [
                'name' => 'Bacalhau à Brás',
                'description' => 'Desfiado com batata palha, ovo e azeitonas',
                'price' => 17.90,
                'category_id' => 3,
                'featured' => false,
                'display_order' => 0,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Dourada Grelhada',
                'description' => 'Acompanhada de legumes e batata cozida',
                'price' => 19.50,
                'category_id' => 3,
                'featured' => false,
                'display_order' => 0,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);

        // Sandes (ID 4)
        DB::table('menu_items')->insert([
            [
                'name' => 'Sandes de Frango Grelhado',
                'description' => 'Frango grelhado com alface e molho de iogurte',
                'price' => 6.50,
                'category_id' => 4,
                'featured' => false,
                'display_order' => 0,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Sandes de Prego',
                'description' => 'Prego no pão com mostarda e batata frita',
                'price' => 7.00,
                'category_id' => 4,
                'featured' => false,
                'display_order' => 0,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);

        // Sobremesas (ID 5)
        DB::table('menu_items')->insert([
            [
                'name' => 'Mousse de Chocolate',
                'description' => 'Cremosa e intensa, com raspas de chocolate',
                'price' => 4.20,
                'category_id' => 5,
                'featured' => false,
                'display_order' => 0,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Tarte de Amêndoa',
                'description' => 'Base crocante com cobertura de amêndoas caramelizadas',
                'price' => 4.80,
                'category_id' => 5,
                'featured' => false,
                'display_order' => 0,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);

        // Bebidas (ID 6)
        DB::table('menu_items')->insert([
            [
                'name' => 'Copo de Vinho Tinto',
                'description' => 'Vinho da casa, de produção regional',
                'price' => 3.80,
                'category_id' => 6,
                'featured' => false,
                'display_order' => 0,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Sumo Natural de Laranja',
                'description' => 'Espremido na hora',
                'price' => 3.00,
                'category_id' => 6,
                'featured' => false,
                'display_order' => 0,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);

        // Itens em destaque
        DB::table('menu_items')->insert([
            [
                'name' => 'Café Especial da Casa',
                'description' => 'O nosso blend exclusivo, torrado artesanalmente e preparado com cuidado.',
                'price' => 8.90,
                'category_id' => 6, // Bebidas
                'image_url' => '/images/menu1.webp',
                'featured' => true,
                'display_order' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Pequeno-almoço Completo',
                'description' => 'Pão artesanal, frios selecionados, ovos, fruta e sumo natural.',
                'price' => 24.90,
                'category_id' => 1, //Entradas
                'image_url' => '/images/menu2.webp',
                'featured' => true,
                'display_order' => 2,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Risoto de Cogumelos',
                'description' => 'Risoto cremoso com mistura de cogumelos frescos e trufa negra',
                'price' => 42.90,
                'category_id' => 2, //Carnes 
                'image_url' => '/images/menu3.webp',
                'featured' => true,
                'display_order' => 3,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Cheesecake de Frutos Vermelhos',
                'description' => 'Sobremesa cremosa com calda de frutos vermelhos frescos.',
                'price' => 18.90,
                'category_id' => 5, //Sobremesas
                'image_url' => '/images/menu4.webp',
                'featured' => true,
                'display_order' => 4,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Cappuccino Clássico',
                'description' => 'Expresso, leite vaporizado e uma generosa camada de espuma.',
                'price' => 12.90,
                'category_id' => 6, //Bebidas
                'image_url' => '/images/menu5.webp',
                'featured' => true,
                'display_order' => 5,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Salada César com Frango',
                'description' => 'Alface romana, croutons, queijo parmesão e molho César com tiras de frango grelhado.',
                'price' => 32.90,
                'category_id' => 2, //Carnes
                'image_url' => '/images/menu6.webp',
                'featured' => true,
                'display_order' => 6,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);

        // ======== INSERIR ESPECIAIS DO DIA =========
        DB::table('daily_specials')->insert([
            [
                'name' => 'Frango Assado no Forno',
                'description' => 'Frango inteiro assado lentamente no forno com ervas aromáticas, alho e limão. Acompanha batatas rústicas, legumes da época e molho especial da casa. Serve até 2 pessoas.',
                'price' => 10.99,
                'image_url' => '/images/pratodia.webp',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);

        // ======== INSERIR IMAGENS DA GALERIA =========
        DB::table('gallery_images')->insert([
            [
                'title' => 'Ambiente do restaurante',
                'image_url' => '/images/galeria1.webp',
                'is_active' => true,
                'description' => 'Vista interna do restaurante',
                'display_order' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'Interior do café',
                'image_url' => '/images/galeria2.webp',
                'is_active' => true,
                'description' => 'Área de café',
                'display_order' => 2,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'Preparo de alimentos',
                'image_url' => '/images/galeria3.webp',
                'is_active' => true,
                'description' => 'Chef preparando refeições',
                'display_order' => 3,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'Pratos servidos',
                'image_url' => '/images/galeria4.webp',
                'is_active' => true,
                'description' => 'Exemplos dos nossos pratos',
                'display_order' => 4,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'Evento no restaurante',
                'image_url' => '/images/galeria5.webp',
                'is_active' => true,
                'description' => 'Eventos especiais',
                'display_order' => 5,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'Cafés especiais',
                'image_url' => '/images/galeria6.webp',
                'is_active' => true,
                'description' => 'Nossa seleção de cafés',
                'display_order' => 6,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
        
        // ======== INSERIR BANNERS =========
        DB::table('banners')->insert([
            [
                'title' => 'Bem-vindo ao Santa Catarina',
                'description' => 'Descubra o sabor autêntico da nossa cozinha portuguesa.',
                'image_url' => '/images/banner2.webp',
                'button_text' => 'Conheça nosso menu',
                'button_link' => '#menu',
                'is_active' => true,
                'display_order' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'Especialidades da Casa',
                'description' => 'Experimente nossos pratos especiais do dia, preparados com ingredientes frescos e locais.',
                'image_url' => '/images/banner1.webp',
                'button_text' => 'Ver Especiais',
                'button_link' => '#pratododia',
                'is_active' => true,
                'display_order' => 2,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Limpa todas as tabelas na ordem inversa para evitar problemas com chaves estrangeiras
        DB::table('banners')->delete();
        DB::table('gallery_images')->delete();
        DB::table('daily_specials')->delete();
        DB::table('menu_items')->delete();
        DB::table('categories')->delete();
    }
};