<?php

namespace Database\Seeders;

use App\Models\GalleryImage;
use Illuminate\Database\Seeder;

class GalleryImageSeeder extends Seeder
{
    public function run(): void
    {
        // Usando as imagens existentes na view galeria.blade.php
        $galleryImages = [
            [
                'title' => 'Ambiente do restaurante',
                'image_url' => 'https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80',
                'is_active' => true,
                'description' => 'Vista interna do restaurante',
                'display_order' => 1
            ],
            [
                'title' => 'Interior do café',
                'image_url' => 'https://images.unsplash.com/photo-1555396273-367ea4eb4db5?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80',
                'is_active' => true,
                'description' => 'Área de café',
                'display_order' => 2
            ],
            [
                'title' => 'Preparo de alimentos',
                'image_url' => 'https://images.unsplash.com/photo-1551218808-94e220e084d2?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80',
                'is_active' => true,
                'description' => 'Chef preparando refeições',
                'display_order' => 3
            ],
            [
                'title' => 'Pratos servidos',
                'image_url' => 'https://images.unsplash.com/photo-1414235077428-338989a2e8c0?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80',
                'is_active' => true,
                'description' => 'Exemplos dos nossos pratos',
                'display_order' => 4
            ],
            [
                'title' => 'Evento no restaurante',
                'image_url' => 'https://images.unsplash.com/photo-1470337458703-46ad1756a187?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80',
                'is_active' => true,
                'description' => 'Eventos especiais',
                'display_order' => 5
            ],
            [
                'title' => 'Cafés especiais',
                'image_url' => 'https://images.unsplash.com/photo-1517701550927-30cf4ba1dba5?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80',
                'is_active' => true,
                'description' => 'Nossa seleção de cafés',
                'display_order' => 6
            ],
        ];

        foreach ($galleryImages as $image) {
            GalleryImage::create($image);
        }
    }
}