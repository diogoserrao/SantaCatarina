<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;
use App\Models\Category;
use App\Models\MenuItem;

Route::get('/', function () {
    $categories = Category::all();
    $featuredItems = MenuItem::where('featured', true)
                        ->orderBy('display_order')
                        ->get();
    
    return view('index', compact('categories', 'featuredItems'));
});


// Certifique-se de que esta rota está definida corretamente
//Route::get('/menu', [MenuController::class, 'index'])->name('menu');