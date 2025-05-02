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
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'original_price' => 'required|numeric|min:0',
            'promo_price' => 'required|numeric|min:0|lte:original_price',
            'image_url' => 'required|url',
            'badge_text' => 'nullable|string|max:50',
            'portions_available' => 'required|integer|min:1',
            'available_until' => 'required',
            'is_active' => 'boolean',
            'alternative_name' => 'required|string|max:255',
            'alternative_description' => 'required|string',
            'alternative_price' => 'required|numeric|min:0',
            'alternative_image_url' => 'required|url',
            'alternative_available_until' => 'required',
        ]);

        // Desativar pratos anteriores se este for ativo
        if ($request->boolean('is_active')) {
            DailySpecial::where('is_active', true)->update(['is_active' => false]);
        }

        DailySpecial::create($validated);

        return redirect()->route('admin.daily-specials.index')
            ->with('success', 'Prato do dia criado com sucesso!');
    }

    // Exibir um prato específico
    public function show(DailySpecial $dailySpecial): View
    {
        return view('admin.daily-specials.show', compact('dailySpecial'));
    }

    // Formulário de edição
    public function edit(DailySpecial $dailySpecial): View
    {
        return view('admin.daily-specials.edit', compact('dailySpecial'));
    }

    // Atualizar prato
    public function update(Request $request, DailySpecial $dailySpecial): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'original_price' => 'required|numeric|min:0',
            'promo_price' => 'required|numeric|min:0|lte:original_price',
            'image_url' => 'required|url',
            'badge_text' => 'nullable|string|max:50',
            'portions_available' => 'required|integer|min:0',
            'available_until' => 'required',
            'is_active' => 'boolean',
            'alternative_name' => 'required|string|max:255',
            'alternative_description' => 'required|string',
            'alternative_price' => 'required|numeric|min:0',
            'alternative_image_url' => 'required|url',
            'alternative_available_until' => 'required',
        ]);

        // Desativar outros pratos se este for ativo
        if ($request->boolean('is_active') && !$dailySpecial->is_active) {
            DailySpecial::where('is_active', true)->update(['is_active' => false]);
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