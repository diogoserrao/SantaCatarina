<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DailySpecial;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class DailySpecialController extends Controller
{
    // Listar todos os pratos do dia
    public function index(): View
    {
        $dailySpecials = DailySpecial::latest()->paginate(10);
        return view('admin.daily-specials.index', compact('dailySpecials'));
    }

    // Exibir formulário de criação
    public function create(): View
    {
        return view('admin.daily-specials.create');
    }

    // Salvar novo prato do dia
    public function store(Request $request): RedirectResponse
    {
        // Validação atualizada para aceitar upload de imagem em vez de URL
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:5120', // 5MB limite
            'is_active' => 'boolean',
        ]);
    
        // Remover 'image' da validação para não interferir com a criação dos dados
        $data = [
            'name' => $validated['name'],
            'description' => $validated['description'],
            'price' => $validated['price'],
            'is_active' => $request->has('is_active'),
        ];
    
        // Processar upload de imagem
        if ($request->hasFile('image')) {
            // Obter o arquivo enviado
            $file = $request->file('image');
            
            // Gerar um nome único para o arquivo
            $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            
            // Definir o caminho de destino diretamente na pasta public/storage
            $destinationPath = public_path('storage/uploads/daily-specials');
            
            // Criar diretório se não existir
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }
            
            // Mover o arquivo para o diretório de destino
            $file->move($destinationPath, $fileName);
            
            // Adicionar o caminho relativo ao array de dados
            $data['image_url'] = '/storage/uploads/daily-specials/' . $fileName;
        }
    
        // Desativar outros pratos se este for ativo
        if ($data['is_active']) {
            DailySpecial::where('is_active', true)->update(['is_active' => false]);
        }
    
        DailySpecial::create($data);
    
        return redirect()->route('admin.daily-specials.index')
            ->with('success', 'Prato do dia criado com sucesso!');
    }

    // Exibir um prato específico
    public function show(): View
    {
        $dailySpecial = DailySpecial::getActive();

        // Se não há prato ativo, tentamos pegar um prato qualquer que esteja no sistema
        // e setamos como inativo para que o sistema mostre a alternativa
        if (!$dailySpecial) {
            $dailySpecial = DailySpecial::latest()->first();

            if ($dailySpecial) {
                $dailySpecial->is_active = false;
            }
        }

        // Removida verificação de alternativa
        return view('pratododia', compact('dailySpecial'));
    }

    // Formulário de edição
    public function edit(DailySpecial $dailySpecial): View
    {
        return view('admin.daily-specials.edit', compact('dailySpecial'));
    }


    // Atualizar prato
    public function update(Request $request, DailySpecial $dailySpecial): RedirectResponse
    {
        // Validação atualizada para aceitar upload de imagem em vez de URL
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120', // 5MB limite
        ]);

        // Remover 'image' da validação para não interferir com a criação dos dados
        $data = [
            'name' => $validated['name'],
            'description' => $validated['description'],
            'price' => $validated['price'],
            'is_active' => $request->has('is_active'),
        ];

        // Se houver upload de nova imagem
        if ($request->hasFile('image')) {
            // Obter o arquivo enviado
            $file = $request->file('image');

            // Gerar um nome único para o arquivo
            $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

            // Definir o caminho de destino diretamente na pasta public/storage
            $destinationPath = public_path('storage/uploads/daily-specials');

            // Criar diretório se não existir
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            // Mover o arquivo para o diretório de destino
            $file->move($destinationPath, $fileName);

            // Salvar o caminho relativo na base de dados
            $data['image_url'] = '/storage/uploads/daily-specials/' . $fileName;

            // Se houver uma imagem antiga, excluí-la
            if ($dailySpecial->image_url) {
                $oldImagePath = public_path(substr($dailySpecial->image_url, 1)); // Remover a barra inicial
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }
        }

        // Se este prato estiver sendo ativado, desative todos os outros
        if ($data['is_active'] && !$dailySpecial->is_active) {
            DailySpecial::where('id', '!=', $dailySpecial->id)
                ->where('is_active', true)
                ->update(['is_active' => false]);
        }

        $dailySpecial->update($data);

        return redirect()->route('admin.daily-specials.index')
            ->with('success', 'Prato do dia atualizado com sucesso!');
    }



    // Excluir prato
    public function destroy(DailySpecial $dailySpecial): RedirectResponse
    {
        $dailySpecial->delete();

        return redirect()->route('admin.daily-specials.index')
            ->with('success', 'Prato do dia excluído com sucesso!');
    }

    // Ativar um prato específico (desativando outros)
    public function activate(DailySpecial $dailySpecial): RedirectResponse
    {
        DailySpecial::where('is_active', true)->update(['is_active' => false]);

        $dailySpecial->is_active = true;
        $dailySpecial->save();

        return redirect()->route('admin.daily-specials.index')
            ->with('success', 'Prato do dia ativado com sucesso!');
    }

    public function toggleStatus(DailySpecial $dailySpecial): RedirectResponse
    {
        if (!$dailySpecial->is_active) {
            // Se estamos ativando, desativamos todos os outros primeiro
            DailySpecial::where('is_active', true)->update(['is_active' => false]);
            $dailySpecial->is_active = true;
            $message = 'Prato do dia ativado com sucesso!';
        } else {
            // Se estamos desativando
            $dailySpecial->is_active = false;
            $message = 'Prato do dia desativado com sucesso!';
        }

        $dailySpecial->save();

        return redirect()->route('admin.daily-specials.index')
            ->with('success', $message);
    }
}
