<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\MenuItem;
use Illuminate\View\View;

class MenuController extends Controller
{
    public function index(): View
    {
        $categories = Category::all();
        $featuredItems = MenuItem::where('featured', true)
                            ->orderBy('display_order')
                            ->get();
        
        return view('menu', compact('categories', 'featuredItems'));
    }
}