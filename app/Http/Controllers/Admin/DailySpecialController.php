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
            // Verificar quantos pratos já estão ativos
            $activeCount = DailySpecial::where('is_active', true)->count();

            if ($activeCount >= 2) {
                // Se já temos 2 pratos ativos, desativar o mais antigo
                $oldestActive = DailySpecial::where('is_active', true)
                    ->orderBy('updated_at', 'asc')
                    ->first();

                if ($oldestActive) {
                    $oldestActive->is_active = false;
                    $oldestActive->save();
                }
            }
        }

        DailySpecial::create($data);

        return redirect()->route('admin.daily-specials.index')
            ->with('success', 'Prato do dia criado com sucesso!');
    }

    // Exibir um prato específico
    public function show(): View
    {
        // Buscar até 2 pratos ativos, ordenados pela data de atualização (mais recente primeiro)
        $dailySpecials = DailySpecial::where('is_active', true)
            ->orderBy('updated_at', 'desc')
            ->limit(2)
            ->get();

        return view('pratododia', compact('dailySpecials'));
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
            // Verificar quantos pratos já estão ativos (excluindo este)
            $activeCount = DailySpecial::where('id', '!=', $dailySpecial->id)
                ->where('is_active', true)
                ->count();

            if ($activeCount >= 2) {
                // Se já temos 2 pratos ativos, desativar o mais antigo
                $oldestActive = DailySpecial::where('id', '!=', $dailySpecial->id)
                    ->where('is_active', true)
                    ->orderBy('updated_at', 'asc')
                    ->first();

                if ($oldestActive) {
                    $oldestActive->is_active = false;
                    $oldestActive->save();
                }
            }
        }

        $dailySpecial->update($data);

        return redirect()->route('admin.daily-specials.index')
            ->with('success', 'Prato do dia atualizado com sucesso!');
    }



    // Excluir prato
    public function destroy(DailySpecial $dailySpecial): RedirectResponse
    {
        // Apagar a imagem do disco, se existir
        if ($dailySpecial->image_url) {
            $imagePath = public_path(ltrim($dailySpecial->image_url, '/'));
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

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
            // Se estamos ativando, verificar quantos pratos já estão ativos
            $activeCount = DailySpecial::where('is_active', true)->count();

            if ($activeCount >= 2) {
                // Se já temos 2 pratos ativos, desativar o mais antigo
                $oldestActive = DailySpecial::where('is_active', true)
                    ->orderBy('updated_at', 'asc')
                    ->first();

                if ($oldestActive) {
                    $oldestActive->is_active = false;
                    $oldestActive->save();
                }
            }
        }

        // Alternar o status do prato atual
        $dailySpecial->is_active = !$dailySpecial->is_active;
        $dailySpecial->save();

        $status = $dailySpecial->is_active ? 'ativado' : 'desativado';
        return redirect()->route('admin.daily-specials.index')
            ->with('success', "Prato do dia {$status} com sucesso!");
    }
}
