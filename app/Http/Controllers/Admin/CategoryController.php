<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    // Listar todas as categorias
    public function index(): View
    {
        $categories = Category::withCount('menuItems')->get();
        return view('admin.categories.index', compact('categories'));
    }

    // Exibir formulário de criação
    public function create(): View
    {
        return view('admin.categories.create');
    }

    // Salvar nova categoria
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories',
            'slug' => 'nullable|string|max:255|unique:categories',
        ]);

        // Gerar slug se não fornecido
        if (!isset($validated['slug']) || empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['name']);
        }

        Category::create($validated);

        return redirect()->route('admin.categories.index')
            ->with('success', 'Categoria criada com sucesso!');
    }

    // Formulário de edição
    public function edit(Category $category): View
    {
        return view('admin.categories.edit', compact('category'));
    }

    // Atualizar categoria
    public function update(Request $request, Category $category): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $category->id,
            'slug' => 'nullable|string|max:255|unique:categories,slug,' . $category->id,
        ]);

        // Gerar slug se não fornecido
        if (!isset($validated['slug']) || empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['name']);
        }

        $category->update($validated);

        return redirect()->route('admin.categories.index')
            ->with('success', 'Categoria atualizada com sucesso!');
    }

    // Excluir categoria
    public function destroy(Category $category): RedirectResponse
    {
        // Verificar se tem itens associados
        if ($category->menuItems()->count() > 0) {
            return redirect()->route('admin.categories.index')
                ->with('error', 'Não é possível excluir esta categoria pois existem itens associados a ela.');
        }

        $category->delete();

        return redirect()->route('admin.categories.index')
            ->with('success', 'Categoria excluída com sucesso!');
    }
}