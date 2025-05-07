<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class GalleryImage extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'title',
        'image_url', 
        'description', 
        'is_active', 
        'display_order'
    ];
    
    protected $casts = [
        'is_active' => 'boolean'
    ];
    
}
