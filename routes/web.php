<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;
use App\Models\Category;
use App\Models\MenuItem;
use App\Models\DailySpecial;
use App\Http\Controllers\DailySpecialController;
use App\Http\Controllers\Admin\DailySpecialController as AdminDailySpecialController;



Route::get('/', function () {
    $categories = Category::all();
    $featuredItems = MenuItem::where('featured', true)
        ->orderBy('display_order')
        ->get();
    $dailySpecial = DailySpecial::getActive();

    return view('index', compact('categories', 'featuredItems', 'dailySpecial'));
});

Route::prefix('admin')->name('admin.')->group(function () {
    // Dashboard
    Route::get('/', [App\Http\Controllers\Admin\AdminController::class, 'dashboard'])->name('dashboard');
    
    // Daily Specials
    Route::resource('daily-specials', App\Http\Controllers\Admin\DailySpecialController::class);
    Route::post('daily-specials/{dailySpecial}/activate', [App\Http\Controllers\Admin\DailySpecialController::class, 'activate'])
        ->name('daily-specials.activate');

    // Menu Items
    Route::resource('menu-items', App\Http\Controllers\Admin\MenuItemController::class);
    Route::post('menu-items/{menuItem}/toggle-featured', [App\Http\Controllers\Admin\MenuItemController::class, 'toggleFeatured'])
        ->name('menu-items.toggle-featured');

    // Categories
    Route::resource('categories', App\Http\Controllers\Admin\CategoryController::class);
    
    // Rota de logout temporária
    Route::post('/logout', function() {
        return redirect('/admin');
    })->name('logout');
});

// Rota para página do prato do dia
Route::get('/prato-do-dia', [App\Http\Controllers\DailySpecialController::class, 'show'])->name('pratododia');

// Rota para alternar disponibilidade do prato do dia
Route::post('/daily-special/{dailySpecial}/toggle-availability', [App\Http\Controllers\DailySpecialController::class, 'toggleAvailability'])
    ->name('daily-special.toggle-availability');
