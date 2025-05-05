<?php

namespace Database\Seeders;

use App\Models\DailySpecial;
use Illuminate\Database\Seeder;
use Illuminate\Http\JsonResponse;

class DailySpecialSeeder extends Seeder
{
    public function run(): void
    {
        DailySpecial::create([
            'name' => 'Frango Assado no Forno',
            'description' => 'Frango inteiro assado lentamente no forno com ervas aromáticas, alho e limão. Acompanha batatas rústicas, legumes da época e molho especial da casa. Serve até 2 pessoas.',
            'price' => 10.99,
            'image_url' => 'https://th.bing.com/th/id/OIP.dIv643iFDSvHo0z0kN0YAwHaFj?w=224&h=180&c=7&r=0&o=5&pid=1.7',
            'is_active' => true,
            
        ]);
    }

    
}