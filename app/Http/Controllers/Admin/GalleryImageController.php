<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GalleryImage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class GalleryImageController extends Controller
{
    /**
     * Display a listing of gallery images.
     */
    public function index()
    {
        $galleryImages = GalleryImage::orderBy('display_order')->get();
        return view('admin.gallery-images.index', compact('galleryImages'));  // AQUI ESTÁ A CORREÇÃO
    }

    /**
     * Show the form for creating a new gallery image.
     */
    public function create()
    {
        return view('admin.gallery-images.create');
    }

    /**
     * Store a newly created gallery image.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'required|image|max:10240', // max 10MB
            'is_active' => 'boolean',
            'display_order' => 'integer|min:0',
        ]);

        // Upload e salvar imagem
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $path = $image->storeAs('uploads/gallery', $filename, 'public');

            // Criar registro
            GalleryImage::create([
                'title' => $request->title,
                'description' => $request->description,
                'image_url' => '/storage/' . $path,
                'is_active' => $request->has('is_active'),
                'display_order' => $request->display_order,
            ]);

            return redirect()->route('admin.gallery-images.index')
                ->with('success', 'Imagem adicionada com sucesso!');
        }

        return back()->with('error', 'Falha ao fazer upload da imagem.');
    }

    /**
     * Show the form for editing the specified gallery image.
     */
    public function edit(GalleryImage $galleryImage)
    {
        return view('admin.gallery-images.edit', compact('galleryImage'));
    }

    /**
     * Update the specified gallery image.
     */
    public function update(Request $request, GalleryImage $galleryImage)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:10240', // Não é mais obrigatório
            'is_active' => 'boolean',
            'display_order' => 'integer|min:0',
        ]);

        $data = [
            'title' => $request->title,
            'description' => $request->description,
            'is_active' => $request->has('is_active'),
            'display_order' => $request->display_order,
        ];

        // Verifica se uma nova imagem foi enviada
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $path = $image->storeAs('uploads/gallery', $filename, 'public');

            // Apaga a imagem antiga se existir e não for padrão do sistema
            if ($galleryImage->image_url && !str_starts_with($galleryImage->image_url, '/images/')) {
                $oldPath = str_replace('/storage/', 'public/', $galleryImage->image_url);
                Storage::delete($oldPath);
            }

            $data['image_url'] = '/storage/' . $path;
        } else {
            // Mantém a imagem atual
            $data['image_url'] = $galleryImage->image_url;
        }

        $galleryImage->update($data);

        return redirect()->route('admin.gallery-images.index')
            ->with('success', 'Imagem atualizada com sucesso!');
    }

    /**
     * Remove the specified gallery image.
     */
    public function destroy(GalleryImage $galleryImage)
    {
        $galleryImage->delete();

        return redirect()->route('admin.gallery-images.index')
            ->with('success', 'Imagem removida com sucesso!');
    }

    /**
     * Toggle the active status of a gallery image.
     */
    public function toggleActive(GalleryImage $galleryImage)
    {
        $galleryImage->update([
            'is_active' => !$galleryImage->is_active
        ]);

        return redirect()->route('admin.gallery-images.index')
            ->with('success', 'Status da imagem alterado com sucesso!');
    }
}
