<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class DailySpecial extends Model
{
    use HasFactory;

    protected $fillable = [
       'name',
        'description',
        'price',
        'image_url',
        'is_active',
    ];

    // Verifica se o prato tem porções disponíveis
    public function hasAvailablePortions(): bool
    {
        return $this->portions_available > 0;
    }


    public static function getActive()
    {
        return self::where('is_active', true)->latest()->first();
    }

}