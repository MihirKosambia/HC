@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Category Header -->
    <div class="bg-gradient-to-r from-[#3abad4] to-[#12a4b7] rounded-xl shadow-lg mb-8">
        <div class="container mx-auto px-6 py-16">
            <h1 class="text-4xl font-bold text-white mb-4">{{ $category->name }}</h1>
            <p class="text-white text-lg mb-8">{{ $category->description }}</p>
            <div class="flex space-x-4">
                <a href="#products" class="bg-white text-[#3abad4] px-6 py-3 rounded-lg font-semibold hover:bg-[#e6f7fa] transition duration-300">
                    Browse Products
                </a>
                <a href="{{ route('categories.index') }}" class="bg-transparent border-2 border-white text-white px-6 py-3 rounded-lg font-semibold hover:bg-white hover:text-[#3abad4] transition duration-300">
                    All Categories
                </a>
            </div>
        </div>
    </div>

    <!-- Category Meta Information -->
    <div class="bg-white rounded-lg shadow-md p-6 mb-8">
        <div class="flex flex-wrap justify-between items-center">
            <div>
                <h2 class="text-2xl font-bold text-gray-900">{{ $products->total() }} Products Found</h2>
            </div>
            <div class="flex space-x-4">
                <form action="{{ route('categories.show', $category->slug) }}" method="GET" id="sort-form">
                    <select id="sort" name="sort" class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#3abad4] focus:border-[#3abad4]" onchange="this.form.submit()">
                        <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Newest First</option>
                        <option value="price_low" {{ request('sort') == 'price_low' ? 'selected' : '' }}>Price: Low to High</option>
                        <option value="price_high" {{ request('sort') == 'price_high' ? 'selected' : '' }}>Price: High to Low</option>
                    </select>
                </form>
            </div>
        </div>
    </div>

    <!-- Products Grid -->
    <div id="products" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        @foreach($products as $product)
        <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition duration-300">
            <div class="relative">
                @if($product->images->isNotEmpty())
                    <img src="{{ $product->images->first()->full_image_url }}" 
                         alt="{{ $product->name }}" 
                         class="w-full h-64 object-cover">
                @else
                    <div class="w-full h-64 bg-gray-200 flex items-center justify-center">
                        <i class="fas fa-image text-gray-400 text-4xl"></i>
                    </div>
                @endif
                @if($product->is_featured)
                    <span class="absolute top-4 right-4 bg-yellow-400 text-black px-3 py-1 rounded-full text-sm font-semibold">Featured</span>
                @endif
                @if($product->created_at->gt(now()->subDays(7)))
                    <span class="absolute top-4 left-4 bg-[#3abad4] text-white px-3 py-1 rounded-full text-sm font-semibold">New</span>
                @endif
            </div>
            <div class="p-6">
                <h3 class="text-xl font-semibold mb-2">{{ $product->name }}</h3>
                <p class="text-gray-600 mb-4 line-clamp-2">{{ $product->description }}</p>
                <div class="flex items-center justify-between">
                    <span class="text-2xl font-bold text-[#3abad4]">₹{{ number_format($product->price, 2) }}</span>
                    <a href="{{ route('products.show', $product->slug) }}" class="bg-[#3abad4] text-white px-4 py-2 rounded-lg hover:bg-[#12a4b7] transition duration-300">
                        View Details
                    </a>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Empty State -->
    @if($products->isEmpty())
    <div class="text-center py-12">
        <div class="bg-white rounded-lg shadow-md p-8 max-w-2xl mx-auto">
            <div class="text-gray-400 mb-4">
                <svg class="w-16 h-16 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                </svg>
            </div>
            <h3 class="text-xl font-semibold text-gray-900 mb-2">No Products Found</h3>
            <p class="text-gray-600 mb-6">This category doesn't have any products yet. Please check back later.</p>
            <a href="{{ route('categories.index') }}" class="inline-block bg-[#3abad4] text-white px-6 py-3 rounded-lg font-medium hover:bg-[#12a4b7] transition duration-300">
                Browse Other Categories
            </a>
        </div>
    </div>
    @endif

    <!-- Pagination -->
    <div class="mt-8">
        {{ $products->appends(request()->query())->links() }}
    </div>
</div>

@push('styles')
<style>
    .pagination {
        @apply flex justify-center space-x-2;
    }
    .pagination > * {
        @apply px-4 py-2 rounded-lg;
    }
    .pagination .active {
        @apply bg-[#3abad4] text-white;
    }
</style>
@endpush
@endsection 