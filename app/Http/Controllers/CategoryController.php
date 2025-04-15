<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CategoryController extends Controller
{
    public function index(): View
    {
        $categories = Category::where('is_active', true)
            ->withCount('products')
            ->with('products')  // Eager load products for featured products preview
            ->paginate(9);     // Show 9 categories per page (3x3 grid)

        return view('categories.index', compact('categories'));
    }

    public function show(string $slug, Request $request): View
    {
        $category = Category::where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        $query = $category->products()
            ->where('is_active', true)
            ->with('images');
            
        // Apply sorting
        if ($request->filled('sort')) {
            switch ($request->sort) {
                case 'price_low':
                    $query->orderBy('price', 'asc');
                    break;
                case 'price_high':
                    $query->orderBy('price', 'desc');
                    break;
                case 'newest':
                default:
                    $query->latest();
                    break;
            }
        } else {
            $query->latest(); // Default sort by newest
        }

        $products = $query->paginate(12);

        return view('categories.show', compact('category', 'products'));
    }
}
