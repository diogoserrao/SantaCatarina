<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MenuItem extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name', 'description', 'price', 'category_id', 
        'image_url', 'featured', 'display_order'
    ];
    
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}