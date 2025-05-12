<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Category;
use App\Models\MenuItem;
use App\Models\DailySpecial;
use App\Models\GalleryImage;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {

        $banners = Banner::where('is_active', true)->orderBy('display_order')->get();

        $categories = Category::all();
        $featuredItems = MenuItem::where('featured', true)->orderBy('display_order')->get();

        $dailySpecials = DailySpecial::where('is_active', true)
            ->orderBy('updated_at', 'desc')
            ->limit(2)
            ->get();

        $galleryImages = GalleryImage::where('is_active', true)->orderBy('display_order')->get();
       
        return view('index', compact('categories', 'featuredItems', 'dailySpecials', 'galleryImages', 'banners'));
    }
}
