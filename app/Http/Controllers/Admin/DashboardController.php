<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\MenuItem;
use App\Models\DailySpecial;
use App\Models\GalleryImage;
use Illuminate\View\View;
use App\Models\Banner;

class DashboardController extends Controller
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
        $galleryImages = GalleryImage::where('is_active', true)
            ->orderBy('display_order')
            ->get();
        $banners = Banner::where('is_active', true)
            ->orderBy('display_order')
            ->get();

        return view('admin.dashboard', compact(
            'menuItemsCount',
            'categoriesCount',
            'activeDailySpecial',
            'featuredItems',
            'galleryImages',
            'banners'
        ));
    }
}
