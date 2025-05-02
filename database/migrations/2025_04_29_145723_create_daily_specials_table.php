<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('daily_specials', function (Blueprint $table) {
            $table->id();
            $table->string('name');                           // Nome do prato
            $table->text('description');                      // Descrição completa
            $table->decimal('original_price', 8, 2);          // Preço original
            $table->decimal('promo_price', 8, 2);             // Preço promocional
            $table->string('image_url');                      // URL da imagem
            $table->string('badge_text')->default('Especial'); // Texto do distintivo
            $table->integer('portions_available')->default(12); // Porções disponíveis
            $table->time('available_until')->default('20:00:00'); // Disponível até
            $table->boolean('is_active')->default(true);      // Está ativo?
            
            // Informação de alternativa (quando esgotado)
            $table->string('alternative_name');               // Nome da alternativa
            $table->text('alternative_description');          // Descrição da alternativa
            $table->decimal('alternative_price', 8, 2);       // Preço da alternativa
            $table->string('alternative_image_url');          // URL da imagem alternativa
            $table->time('alternative_available_until')->default('21:00:00'); // Horário alternativo
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('daily_specials');
    }
};