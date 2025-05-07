<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class ImageUploadController extends Controller
{
    public function store(Request $request)
    {
        try {
            // Validar que é uma imagem e não excede 10MB
            $request->validate([
                'image' => 'required|image|max:10240',
            ]);

            if (!$request->hasFile('image')) {
                return response()->json([
                    'success' => false,
                    'message' => 'Nenhuma imagem enviada'
                ], 400);
            }

            // Obter o arquivo
            $image = $request->file('image');
            
            // Gerar nome único
            $filename = 'gallery_' . time() . '_' . Str::random(10) . '.' . $image->getClientOriginalExtension();
            
            // Salvar no disco
            $path = $image->storeAs('public/uploads/gallery', $filename);
            
            // Retornar URL
            return response()->json([
                'success' => true,
                'image_url' => Storage::url($path),
                'message' => 'Imagem carregada com sucesso'
            ]);
            
        } catch (\Exception $e) {
            Log::error('Erro ao fazer upload de imagem: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Erro: ' . $e->getMessage()
            ], 500);
        }
    }
}