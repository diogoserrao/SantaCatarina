<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DailySpecialController;
use App\Http\Controllers\Admin\MenuItemController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ImageUploadController;
use App\Http\Controllers\DailySpecialController as PublicDailySpecialController;
use App\Models\Category;
use App\Models\MenuItem;
use App\Models\DailySpecial;

// Rota principal (página inicial)
Route::get('/', function () {
    $categories = Category::all();
    $featuredItems = MenuItem::where('featured', true)->orderBy('display_order')->get();
    $dailySpecial = DailySpecial::getActive();

    return view('index', compact('categories', 'featuredItems', 'dailySpecial'));
});

// Rota pública para o prato do dia
Route::get('/prato-do-dia', [PublicDailySpecialController::class, 'show'])->name('pratododia');
Route::post('/daily-special/{dailySpecial}/toggle-availability', [PublicDailySpecialController::class, 'toggleAvailability'])
    ->name('daily-special.toggle-availability');

// Autenticação - estas rotas devem estar acessíveis para não autenticados
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
});

// Rota de logout - requer autenticação
Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

// Todas rotas administrativas agrupadas - protegidas por autenticação
Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    // APENAS esta rota para o dashboard
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');

    // Pratos do Dia
    Route::resource('daily-specials', DailySpecialController::class);
    Route::post('daily-specials/{dailySpecial}/activate', [DailySpecialController::class, 'activate'])
        ->name('daily-specials.activate');

    // Itens do Menu
    Route::resource('menu-items', MenuItemController::class);
    Route::post('menu-items/{menuItem}/toggle-featured', [MenuItemController::class, 'toggleFeatured'])
        ->name('menu-items.toggle-featured');

            
    // Categorias
    Route::resource('categories', CategoryController::class);

    // Rota para upload de imagens via câmera
    Route::post('/admin/upload-image', [ImageUploadController::class, 'store'])
        ->name('admin.upload-image')
        ->middleware('auth');
});
