<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MenuItem;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class MenuItemController extends Controller
{
    // Listar todos os itens do menu
    public function index(Request $request): View
    {
        $query = MenuItem::with('category');
        
        // Filtragem
        if ($request->has('category')) {
            $query->where('category_id', $request->category);
        }
        
        if ($request->has('featured')) {
            $query->where('featured', $request->featured == 1);
        }
        
        if ($request->has('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }
        
        $menuItems = $query->orderBy('category_id')->orderBy('display_order')->paginate(15);
        $categories = Category::all();
        
        return view('admin.menu-items.index', compact('menuItems', 'categories'));
    }

    // Exibir formulário de criação
    public function create(): View
    {
        $categories = Category::all();
        return view('admin.menu-items.create', compact('categories'));
    }

    // Salvar novo item de menu
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'image_url' => 'nullable|url',
            'featured' => 'boolean',
            'display_order' => 'nullable|integer|min:0',
        ]);

        // Valor padrão para display_order se não for fornecido
        if (!isset($validated['display_order'])) {
            $validated['display_order'] = 0;
        }

        MenuItem::create($validated);

        return redirect()->route('admin.menu-items.index')
            ->with('success', 'Item do menu criado com sucesso!');
    }

    // Exibir um item específico
    public function show(MenuItem $menuItem): View
    {
        return view('admin.menu-items.show', compact('menuItem'));
    }

    // Formulário de edição
    public function edit(MenuItem $menuItem): View
    {
        $categories = Category::all();
        return view('admin.menu-items.edit', compact('menuItem', 'categories'));
    }

    // Atualizar item
    public function update(Request $request, MenuItem $menuItem): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'image_url' => 'nullable|url',
            'featured' => 'boolean',
            'display_order' => 'nullable|integer|min:0',
        ]);

        // Valor padrão para display_order se não for fornecido
        if (!isset($validated['display_order'])) {
            $validated['display_order'] = 0;
        }

        $menuItem->update($validated);

        return redirect()->route('admin.menu-items.index')
            ->with('success', 'Item do menu atualizado com sucesso!');
    }

    // Excluir item
    public function destroy(MenuItem $menuItem): RedirectResponse
    {
        $menuItem->delete();

        return redirect()->route('admin.menu-items.index')
            ->with('success', 'Item do menu excluído com sucesso!');
    }

    // Alternar destaque
    public function toggleFeatured(MenuItem $menuItem): RedirectResponse
    {
        $menuItem->featured = !$menuItem->featured;
        $menuItem->save();

        return redirect()->route('admin.menu-items.index')
            ->with('success', $menuItem->featured ? 'Item marcado como destaque!' : 'Item removido dos destaques.');
    }
}