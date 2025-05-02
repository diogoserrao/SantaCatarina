<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\MenuItem;
use App\Models\DailySpecial;
use Illuminate\View\View;

class AdminController extends Controller
{
    public function dashboard(): View
    {
        $menuItemsCount = MenuItem::count();
        $categoriesCount = Category::count();
        $activeDailySpecial = DailySpecial::getActive();
        $featuredItems = MenuItem::where('featured', true)
                            ->with('category')
                            ->orderBy('display_order')
                            ->take(5)
                            ->get();

        return view('admin.dashboard', compact(
            'menuItemsCount',
            'categoriesCount',
            'activeDailySpecial',
            'featuredItems'
        ));
    }
}