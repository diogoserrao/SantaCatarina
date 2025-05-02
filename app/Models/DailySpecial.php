<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class DailySpecial extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'description', 'original_price', 'promo_price', 'image_url',
        'badge_text', 'portions_available', 'available_until', 'is_active',
        'alternative_name', 'alternative_description', 'alternative_price',
        'alternative_image_url', 'alternative_available_until'
    ];

    // Verifica se o prato tem porções disponíveis
    public function hasAvailablePortions(): bool
    {
        return $this->portions_available > 0;
    }

    // Formata a hora até quando o prato está disponível
    public function getFormattedAvailableUntilAttribute(): string
    {
        return Carbon::parse($this->available_until)->format('H\h');
    }

    // Formata a hora até quando o prato alternativo está disponível
    public function getFormattedAlternativeAvailableUntilAttribute(): string
    {
        return Carbon::parse($this->alternative_available_until)->format('H\h');
    }

    // Reduz o número de porções
    public function reducePortions(int $count = 1): void
    {
        if ($this->portions_available >= $count) {
            $this->portions_available -= $count;
            $this->save();
        }
    }

    // Retorna o prato ativo do dia
    public static function getActive()
    {
        return self::where('is_active', true)->latest()->first();
    }
}