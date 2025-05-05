<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ImageUploadController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|max:5120', // 5MB max
        ]);

        try {
            $image = $request->file('image');
            $filename = 'dish-image-' . Str::uuid() . '.' . $image->getClientOriginalExtension();
            
            // Salvar no diretório público
            $path = $image->storeAs('images/dishes', $filename, 'public');
            
            // URL completa da imagem
            $imageUrl = asset('storage/' . $path);
            
            return response()->json([
                'success' => true,
                'image_url' => $imageUrl
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }
}