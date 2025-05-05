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
        // Validação simplificada
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'image_url' => 'required|url',
            'is_active' => 'boolean',
        ]);

        // Desativar outros pratos se este for ativo
        if ($request->boolean('is_active')) {
            DailySpecial::where('is_active', true)->update(['is_active' => false]);
        }

        DailySpecial::create($validated);

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
        // Validação simplificada
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'image_url' => 'required|url',
        ]);

        // Definir explicitamente o status ativo/inativo
        $validated['is_active'] = $request->has('is_active');

        // Se este prato estiver sendo ativado, desative todos os outros
        if ($validated['is_active'] && !$dailySpecial->is_active) {
            DailySpecial::where('id', '!=', $dailySpecial->id)
                ->where('is_active', true)
                ->update(['is_active' => false]);
        }

        $dailySpecial->update($validated);

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
}