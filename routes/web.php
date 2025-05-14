<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DailySpecialController;
use App\Http\Controllers\Admin\MenuItemController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\GalleryImageController;
use App\Http\Controllers\Admin\ImageUploadController;
use App\Http\Controllers\GalleryController;
use Illuminate\Support\Facades\Auth;


// Rota principal (página inicial)
Route::get('/', [HomeController::class, 'index']);

// Rota de logout padrão
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Rota adicional para logout com redirecionamento para login
Route::post('/logout-to-login', function() {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/login');
})->name('logout.to.login');
// Rota pública para o prato do dia



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
    Route::post('daily-specials/{dailySpecial}/toggle-status', [DailySpecialController::class, 'toggleStatus'])
        ->name('daily-specials.toggle-status');

    // Itens do Menu
    Route::resource('menu-items', MenuItemController::class);
    Route::post('menu-items/{menuItem}/toggle-featured', [MenuItemController::class, 'toggleFeatured'])
        ->name('menu-items.toggle-featured');


    // Categorias
    Route::resource('categories', CategoryController::class);

    // Rotas para banners
    Route::resource('banners', BannerController::class);
    Route::post('banners/{banner}/toggle-active', [BannerController::class, 'toggleActive'])
        ->name('banners.toggle-active');
        Route::patch('/admin/banners/{banner}/toggle', [BannerController::class, 'toggle'])
        ->name('banners.toggle');

    // Rotas para galeria
    Route::resource('gallery-images', GalleryImageController::class);
    Route::post('gallery-images/{galleryImage}/toggle-active',[GalleryImageController::class, 'toggleActive'])
        ->name('gallery-images.toggle-active');


    // Dentro do grupo de rotas admin
    Route::post('upload-image', [ImageUploadController::class, 'store'])->name('upload-image');
});
