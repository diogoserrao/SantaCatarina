<?php

namespace App\Http\Controllers;

use App\Models\DailySpecial;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\JsonResponse;

class DailySpecialController extends Controller
{
    // Exibir o prato do dia na página
    public function show(): View
    {
        $dailySpecial = DailySpecial::getActive();
        
        if (!$dailySpecial) {
            // Fallback se não houver prato do dia configurado
            return view('pratododia')->with('noDailySpecial', true);
        }
        
        return view('pratododia', compact('dailySpecial'));
    }
    
    // API: Atualizar porções quando um pedido é feito
    public function updatePortions(Request $request, DailySpecial $dailySpecial): JsonResponse
    {
        $request->validate([
            'portions' => 'required|integer|min:1',
        ]);
        
        $dailySpecial->reducePortions($request->portions);
        
        return response()->json([
            'success' => true,
            'remaining' => $dailySpecial->portions_available,
            'hasPortionsLeft' => $dailySpecial->hasAvailablePortions()
        ]);
    }
}