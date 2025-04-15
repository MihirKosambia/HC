<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\Contact;
use App\Models\Inquiry;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $stats = [
            'products' => Product::count(),
            'categories' => Category::count(),
            'contacts' => Contact::count(),
            'inquiries' => Inquiry::count(),
        ];

        return view('admin.dashboard', compact('stats'));
    }
}
