<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Category;
use App\Models\Product;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        return view('home', [
            'banners' => Banner::where('is_active', true)->orderBy('sort_order')->take(3)->get(),
            'categories' => Category::where('is_active', true)->take(6)->get(),
            'featuredProducts' => Product::where('is_active', true)
                ->where('is_featured', true)
                ->with('category')
                ->latest()
                ->take(8)
                ->get(),
        ]);
    }

    public function about(): View
    {
        return view('about');
    }
}
