<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Inquiry;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\JsonResponse;

class ProductController extends Controller
{
    public function index(Request $request): View
    {
        $query = Product::query()
            ->where('is_active', true)
            ->with(['category']);

        if ($request->has('search')) {
            $search = $request->get('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            });
        }

        if ($request->has('category')) {
            $query->where('category_id', $request->get('category'));
        }

        if ($request->has('sort')) {
            $sort = $request->get('sort');
            if ($sort === 'name_asc') {
                $query->orderBy('name', 'asc');
            } elseif ($sort === 'name_desc') {
                $query->orderBy('name', 'desc');
            }
        } else {
            $query->latest();
        }

        $products = $query->paginate(12);
        $categories = Category::where('is_active', true)->get();

        return view('products.index', compact('products', 'categories'));
    }

    public function search(Request $request): View
    {
        $query = $request->input('query');
        
        $products = Product::where('is_active', true)
            ->where(function ($q) use ($query) {
                $q->where('name', 'like', "%{$query}%")
                  ->orWhere('description', 'like', "%{$query}%");
            })
            ->with(['category'])
            ->paginate(12);
            
        $categories = Category::where('is_active', true)->get();
        
        return view('products.index', [
            'products' => $products,
            'categories' => $categories,
            'searchQuery' => $query
        ]);
    }

    public function autocomplete(Request $request): JsonResponse
    {
        $query = $request->input('query');
        
        $products = Product::where('is_active', true)
            ->where('name', 'like', "%{$query}%")
            ->with(['category'])
            ->take(5)
            ->get()
            ->map(function ($product) {
                return [
                    'id' => $product->id,
                    'name' => $product->name,
                    'slug' => $product->slug,
                    'category' => $product->category->name ?? '',
                    'image' => $product->image_url ?? 'https://via.placeholder.com/400x400.png?text=No+Image',
                    'url' => route('products.show', $product->slug)
                ];
            });
            
        return response()->json($products);
    }

    public function show(string $slug): View
    {
        $product = Product::where('slug', $slug)
            ->with(['category'])
            ->firstOrFail();

        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->where('is_active', true)
            ->with(['category'])
            ->take(4)
            ->get();

        return view('products.show', compact('product', 'relatedProducts'));
    }

    public function inquiry(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'message' => 'required|string'
        ]);

        $inquiry = new Inquiry($validated);
        $inquiry->product()->associate($product);
        $inquiry->save();

        return redirect()->back()->with('success', 'Your inquiry has been submitted successfully.');
    }
}
