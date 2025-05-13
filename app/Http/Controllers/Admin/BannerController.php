<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{
    /**
     * Exibe a lista de banners
     */
    public function index()
    {
        $banners = Banner::orderBy('display_order')->get();
        return view('admin.banners.index', compact('banners'));
    }

    /**
     * Exibe o formulário para criar um banner
     */
    public function create()
    {
        return view('admin.banners.create');
    }

    /**
     * Armazena um novo banner
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:500',
            'image' => 'required|image|max:2048', // 2MB max
            'button_text' => 'nullable|string|max:50',
            'button_link' => 'nullable|string|max:255',
            'is_active' => 'boolean',
            'display_order' => 'integer|min:0',
        ]);

        // Upload da imagem
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $path = $image->storeAs('uploads/banners', $filename, 'public');

            Banner::create([
                'title' => $request->title,
                'description' => $request->description,
                'image_url' => '/storage/' . $path,
                'button_text' => $request->button_text,
                'button_link' => $request->button_link,
                'is_active' => $request->has('is_active'),
                'display_order' => $request->display_order,
            ]);

            return redirect()->route('admin.banners.index')
                ->with('success', 'Banner criado com sucesso!');
        }

        return back()->with('error', 'Erro ao fazer upload da imagem.');
    }

    /**
     * Exibe o formulário para editar um banner
     */
    public function edit(Banner $banner)
    {
        return view('admin.banners.edit', compact('banner'));
    }

    /**
     * Atualiza um banner existente
     */
    public function update(Request $request, Banner $banner)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:500',
            'image' => 'nullable|image|max:2048', // 2MB max
            'button_text' => 'nullable|string|max:50',
            'button_link' => 'nullable|string|max:255',
            'is_active' => 'boolean',
            'display_order' => 'integer|min:0',
        ]);

        $data = [
            'title' => $request->title,
            'description' => $request->description,
            'button_text' => $request->button_text,
            'button_link' => $request->button_link,
            'is_active' => $request->has('is_active'),
            'display_order' => $request->display_order,
        ];

        // Update da imagem se fornecida
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $path = $image->storeAs('uploads/banners', $filename, 'public');

            // Remover imagem antiga se não for uma imagem padrão
            if ($banner->image_url && !str_starts_with($banner->image_url, '/images/')) {
                $oldPath = str_replace('/storage/', 'public/', $banner->image_url);
                Storage::delete($oldPath);
            }

            $data['image_url'] = '/storage/' . $path;
        }

        $banner->update($data);

        return redirect()->route('admin.banners.index')
            ->with('success', 'Banner atualizado com sucesso!');
    }

    /**
     * Remove um banner
     */
    public function destroy(Banner $banner)
    {
        // Remover imagem se não for uma imagem padrão
        if ($banner->image_url && !str_starts_with($banner->image_url, '/images/')) {
            // Remove o prefixo '/storage/' para obter o caminho relativo ao disco 'public'
            $storagePath = str_replace('/storage/', '', $banner->image_url);
            if (Storage::disk('public')->exists($storagePath)) {
                Storage::disk('public')->delete($storagePath);
            }
        }

        $banner->delete();

        return redirect()->route('admin.banners.index')
            ->with('success', 'Banner removido com sucesso!');
    }

    /**
     * Alterna o status de ativação do banner.
     *
     * @param \App\Models\Banner $banner
     * @return \Illuminate\Http\RedirectResponse
     */
    public function toggle(Banner $banner)
    {
        $banner->is_active = !$banner->is_active;
        $banner->save();

        $status = $banner->is_active ? 'ativado' : 'desativado';
        return redirect()->route('admin.banners.index')
            ->with('success', "Banner {$status} com sucesso!");
    }
}
