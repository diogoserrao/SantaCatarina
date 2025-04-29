<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\MenuItem;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    public function run(): void
    {
        // Criar categorias
        $categories = [
            ['name' => 'Entradas', 'slug' => 'entradas'],
            ['name' => 'Carnes', 'slug' => 'carnes'],
            ['name' => 'Peixes', 'slug' => 'peixes'],
            ['name' => 'Sandes', 'slug' => 'sandes'],
            ['name' => 'Sobremesas', 'slug' => 'sobremesas'],
            ['name' => 'Bebidas', 'slug' => 'bebidas'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }

        // Adicionar itens do menu - Entradas
        $entradas = [
            [
                'name' => 'Croquetes de Bacalhau',
                'description' => 'Croquetes caseiros de bacalhau com molho tártaro',
                'price' => 8.90,
                'category_id' => 1,
                'featured' => false,
            ],
            [
                'name' => 'Tábua de Enchidos',
                'description' => 'Seleção de enchidos tradicionais portugueses',
                'price' => 12.00,
                'category_id' => 1,
                'featured' => false,
            ],
        ];

        foreach ($entradas as $item) {
            MenuItem::create($item);
        }
        // Entradas (ID 1)
        MenuItem::insert([
            [
                'name' => 'Croquetes de Bacalhau',
                'description' => 'Croquetes caseiros de bacalhau com molho tártaro',
                'price' => 8.90,
                'category_id' => 1,
                'featured' => false,
            ],
            [
                'name' => 'Tábua de Enchidos',
                'description' => 'Seleção de enchidos tradicionais portugueses',
                'price' => 12.00,
                'category_id' => 1,
                'featured' => false,
            ],
        ]);

        // Carnes (ID 2)
        MenuItem::insert([
            [
                'name' => 'Bife à Portuguesa',
                'description' => 'Bife grelhado com ovo a cavalo, batata frita e arroz',
                'price' => 24.50,
                'category_id' => 2,
                'featured' => false,
            ],
            [
                'name' => 'Costeletas de Borrego',
                'description' => 'Servidas com puré de batata e legumes salteados',
                'price' => 21.00,
                'category_id' => 2,
                'featured' => false,
            ],
        ]);

        // Peixes (ID 3)
        MenuItem::insert([
            [
                'name' => 'Bacalhau à Brás',
                'description' => 'Desfiado com batata palha, ovo e azeitonas',
                'price' => 17.90,
                'category_id' => 3,
                'featured' => false,
            ],
            [
                'name' => 'Dourada Grelhada',
                'description' => 'Acompanhada de legumes e batata cozida',
                'price' => 19.50,
                'category_id' => 3,
                'featured' => false,
            ],
        ]);

        // Sandes (ID 4)
        MenuItem::insert([
            [
                'name' => 'Sandes de Prego',
                'description' => 'Prego no pão com mostarda e batata frita',
                'price' => 7.00,
                'category_id' => 4,
                'featured' => false,
            ],
            [
                'name' => 'Sandes de Frango Grelhado',
                'description' => 'Frango grelhado com alface e molho de iogurte',
                'price' => 6.50,
                'category_id' => 4,
                'featured' => false,
            ],
        ]);

        // Sobremesas (ID 5)
        MenuItem::insert([
            [
                'name' => 'Mousse de Chocolate',
                'description' => 'Cremosa e intensa, com raspas de chocolate',
                'price' => 4.20,
                'category_id' => 5,
                'featured' => false,
            ],
            [
                'name' => 'Tarte de Amêndoa',
                'description' => 'Base crocante com cobertura de amêndoas caramelizadas',
                'price' => 4.80,
                'category_id' => 5,
                'featured' => false,
            ],
        ]);

        // Bebidas (ID 6)
        MenuItem::insert([
            [
                'name' => 'Sumo Natural de Laranja',
                'description' => 'Espremido na hora',
                'price' => 3.00,
                'category_id' => 6,
                'featured' => false,
            ],
            [
                'name' => 'Copo de Vinho Tinto',
                'description' => 'Vinho da casa, de produção regional',
                'price' => 3.80,
                'category_id' => 6,
                'featured' => false,
            ],
        ]);

        // Destaques (featured items)
        $featuredItems = [
            [
                'name' => 'Café Especial da Casa',
                'description' => 'O nosso blend exclusivo, torrado artesanalmente e preparado com cuidado.',
                'price' => 8.90,
                'category_id' => 6, // Bebidas
                'image_url' => 'https://images.unsplash.com/photo-1517701550927-30cf4ba1dba5?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80',
                'featured' => true,
                'display_order' => 1,
            ],
            [
                'name' => 'Pequeno-almoço Completo',
                'description' => 'Pão artesanal, frios selecionados, ovos, fruta e sumo natural.',
                'price' => 24.90,
                'category_id' => 1,
                'image_url' => 'https://images.unsplash.com/photo-1484723091739-30a097e8f929?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80',
                'featured' => true,
                'display_order' => 2,
            ],
            [
                'name' => 'Risoto de Cogumelos',
                'description' => 'Risoto cremoso com mistura de cogumelos frescos e trufa negra',
                'price' => 42.90,
                'category_id' => 2,
                'image_url' => 'https://images.unsplash.com/photo-1546069901-ba9599a7e63c?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80',
                'featured' => true,
                'display_order' => 3,
            ],
            [
                'name' => 'Cheesecake de Frutos Vermelhos',
                'description' => 'Sobremesa cremosa com calda de frutos vermelhos frescos.',
                'price' => 18.90,
                'category_id' => 5,
                'image_url' => 'https://images.unsplash.com/photo-1563805042-7684c019e1cb?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80',
                'featured' => true,
                'display_order' => 4,
            ],
            [
                'name' => 'Cappuccino Clássico',
                'description' => 'Expresso, leite vaporizado e uma generosa camada de espuma.',
                'price' => 12.90,
                'category_id' => 6,
                'image_url' => 'https://images.unsplash.com/photo-1511920170033-f8396924c348?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80',
                'featured' => true,
                'display_order' => 5,
            ],
            [
                'name' => 'Salada César com Frango',
                'description' => 'Alface romana, croutons, queijo parmesão e molho César com tiras de frango grelhado.',
                'price' => 32.90,
                'category_id' => 2,
                'image_url' => 'https://images.unsplash.com/photo-1544025162-d76694265947?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80',
                'featured' => true,
                'display_order' => 6,
            ],
        ];

        foreach ($featuredItems as $item) {
            MenuItem::create($item);
        }
    }
}
