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
            'original_price' => 10.99,
            'promo_price' => 5.49,
            'image_url' => 'https://th.bing.com/th/id/OIP.dIv643iFDSvHo0z0kN0YAwHaFj?w=224&h=180&c=7&r=0&o=5&pid=1.7',
            'badge_text' => 'Especial',
            'portions_available' => 12,
            'available_until' => '20:00:00',
            'is_active' => true,
            
            'alternative_name' => 'Prego no Prato',
            'alternative_description' => 'Mas não se preocupe — hoje temos um delicioso Prego no Prato com bife suculento, batatas fritas crocantes, arroz branco e ovo estrelado. Uma opção prática e saborosa!',
            'alternative_price' => 7.90,
            'alternative_image_url' => 'https://th.bing.com/th/id/OIP.97kl_JAqZUu7PSvr2FVH2AHaFj?rs=1&pid=ImgDetMain',
            'alternative_available_until' => '21:00:00',
        ]);
    }


    public function toggleAvailability(DailySpecial $dailySpecial): JsonResponse
    {
        // Inverte o estado: se tinha porções fica sem, se não tinha fica com
        $dailySpecial->portions_available = $dailySpecial->hasAvailablePortions() ? 0 : 12;
        $dailySpecial->save();
        
        return response()->json([
            'success' => true,
            'isAvailable' => $dailySpecial->hasAvailablePortions(),
            'message' => $dailySpecial->hasAvailablePortions() ? 'Prato marcado como disponível' : 'Prato marcado como esgotado'
        ]);
    }
    
}