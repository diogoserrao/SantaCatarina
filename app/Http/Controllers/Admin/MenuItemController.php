<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MenuItem;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

class MenuItemController extends Controller
{
    // Listar todos os itens do menu
    public function index(Request $request): View
    {
        // Iniciar a query base
        $query = MenuItem::query();

        // Aplicar filtro de busca por nome (com agrupamento)
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'LIKE', '%' . $request->search . '%')
                    ->orWhere('description', 'LIKE', '%' . $request->search . '%');
            });
        }

        // Aplicar filtro de categoria
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        // Aplicar filtro de destaque
        if ($request->filled('featured')) {
            $query->where('featured', $request->featured);
        }

        // Ordenação padrão
        $query->orderBy('display_order')
            ->orderBy('name');

        // Paginar resultados e manter parâmetros de query na URL
        $menuItems = $query->paginate(15)->withQueryString();

        // Obter categorias para o dropdown
        $categories = Category::orderBy('name')->get();

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
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120', // 5MB limite
            'featured' => 'boolean',
            'display_order' => 'nullable|integer|min:0',
        ]);

        // Valor padrão para display_order se não for fornecido
        if (!isset($validated['display_order'])) {
            $validated['display_order'] = 0;
        }

        // Processar upload de imagem
        if ($request->hasFile('image')) {
            // Obter o arquivo enviado
            $file = $request->file('image');

            // Gerar um nome único para o arquivo
            $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

            // Definir o caminho de destino diretamente na pasta public/storage
            $destinationPath = public_path('storage/uploads/menu');

            // Criar diretório se não existir
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            // Mover o arquivo para o diretório de destino
            $file->move($destinationPath, $fileName);

            // Adicionar o caminho relativo ao array de dados
            $validated['image_url'] = '/storage/uploads/menu/' . $fileName;
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
    public function update(Request $request, MenuItem $menuItem)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120', // 5MB limite
            'featured' => 'sometimes|boolean',
            'display_order' => 'nullable|integer|min:0',
        ]);

        // Se é destacado e não tem imagem atual nem nova imagem, retornar erro
        if (isset($validated['featured']) && $validated['featured'] && !$request->hasFile('image') && !$menuItem->image_url) {
            return back()->withErrors(['image' => 'Uma imagem é obrigatória para itens em destaque.'])->withInput();
        }

        $data = [
            'name' => $validated['name'],
            'description' => $validated['description'] ?? null,
            'price' => $validated['price'],
            'category_id' => $validated['category_id'],
            'featured' => $request->has('featured'),
            'display_order' => $validated['display_order'] ?? 0,
        ];

        // Se houver upload de nova imagem
        if ($request->hasFile('image')) {
            // Obter o arquivo enviado
            $file = $request->file('image');

            // Gerar um nome único para o arquivo
            $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

            // Definir o caminho de destino diretamente na pasta public/storage
            $destinationPath = public_path('storage/uploads/menu');

            // Criar diretório se não existir
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            // Mover o arquivo para o diretório de destino
            $file->move($destinationPath, $fileName);

            // Salvar o caminho relativo na base de dados
            $data['image_url'] = '/storage/uploads/menu/' . $fileName;

            // Se houver uma imagem antiga, excluí-la
            if ($menuItem->image_url) {
                $oldImagePath = public_path(substr($menuItem->image_url, 1)); // Remover a barra inicial
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }
        }

        $menuItem->update($data);

        return redirect()->route('admin.menu-items.index')->with('success', 'Item atualizado com sucesso!');
    }

    // Excluir item
    public function destroy(MenuItem $menuItem): RedirectResponse
    {
        if ($menuItem->image_url) {
            // Remove a barra inicial se existir
            $relativePath = ltrim($menuItem->image_url, '/');
            $imagePath = public_path($relativePath);

            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

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
