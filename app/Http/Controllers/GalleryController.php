<?php

namespace App\Http\Controllers;

use App\Models\GalleryImage;
use Illuminate\View\View;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    /**
     * Display a listing of gallery images.
     */
    public function index(): View
    {
        // Fetch gallery images from your database
        $galleryImages = GalleryImage::where('is_active', true)
        ->orderBy('display_order')
        ->get();

        // Pass the variable to the view
        return view('galeria', compact('galleryImages'));
    }
}
