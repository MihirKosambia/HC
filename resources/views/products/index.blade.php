@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Hero Section -->
    <div class="bg-gradient-to-r from-[#3abad4] to-[#12a4b7] rounded-xl shadow-lg mb-8">
        <div class="container mx-auto px-6 py-16">
            <h1 class="text-4xl font-bold text-white mb-4">Our Products</h1>
            <p class="text-white text-lg mb-8">Discover our amazing collection of high-quality products</p>
            <div class="flex space-x-4">
                <a href="#products" class="bg-white text-[#3abad4] px-6 py-3 rounded-lg font-semibold hover:bg-[#e6f7fa] transition duration-300">
                    View All Products
                </a>
                <a href="{{ route('contact.create') }}" class="bg-transparent border-2 border-white text-white px-6 py-3 rounded-lg font-semibold hover:bg-white hover:text-[#3abad4] transition duration-300">
                    Contact Us
                </a>
            </div>
        </div>
    </div>

    <!-- Filters Section -->
    <div class="bg-white rounded-lg shadow-md p-6 mb-8">
        <form action="{{ route('products.index') }}" method="GET" id="filter-form">
            <div class="flex flex-wrap gap-4 items-center">
                <div class="flex-1">
                    <input type="text" id="search" name="search" placeholder="Search products..." 
                           value="{{ request('search') }}"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#3abad4] focus:border-[#3abad4]">
                </div>
                <div class="flex space-x-4">
                    <select id="category" name="category" class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#3abad4] focus:border-[#3abad4]">
                        <option value="">All Categories</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->slug }}" {{ request('category') == $category->slug ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    <select id="sort" name="sort" class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#3abad4] focus:border-[#3abad4]">
                        <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Newest First</option>
                        <option value="price_low" {{ request('sort') == 'price_low' ? 'selected' : '' }}>Price: Low to High</option>
                        <option value="price_high" {{ request('sort') == 'price_high' ? 'selected' : '' }}>Price: High to Low</option>
                    </select>
                    <button type="submit" class="bg-[#3abad4] text-white px-6 py-2 rounded-lg hover:bg-[#12a4b7] transition duration-300">
                        Filter
                    </button>
                </div>
            </div>
        </form>
    </div>

    <!-- Products Grid -->
    <div id="products" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        @if($products->count() > 0)
            @foreach($products as $product)
            <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition duration-300 flex flex-col h-[500px]">
                <div class="relative h-64">
                    <img src="{{ $product->image_url ?? 'https://via.placeholder.com/400x400.png?text=No+Image' }}" 
                         alt="{{ $product->name }}" 
                         class="w-full h-full object-cover">
                    @if($product->is_featured)
                        <span class="absolute top-4 right-4 bg-yellow-400 text-black px-3 py-1 rounded-full text-sm font-semibold">Featured</span>
                    @endif
                </div>
                <div class="p-6 flex flex-col flex-grow">
                    <h3 class="text-xl font-semibold mb-2 line-clamp-1">{{ $product->name }}</h3>
                    <div class="mb-4 text-gray-600 text-sm flex-grow overflow-hidden">
                        <div class="line-clamp-4">
                            {!! $product->description !!}
                        </div>
                    </div>
                    <div class="flex items-center justify-between mt-auto">
                        <span class="text-2xl font-bold text-[#3abad4]">₹{{ number_format($product->price, 2) }}</span>
                        <a href="{{ route('products.show', $product) }}" class="bg-[#3abad4] text-white px-4 py-2 rounded-lg hover:bg-[#12a4b7] transition duration-300">
                            View Details
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        @else
            <div class="col-span-full py-12 text-center">
                <div class="bg-white rounded-lg shadow-md p-8 max-w-2xl mx-auto">
                    <div class="text-gray-400 mb-4">
                        <svg class="w-16 h-16 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">No Products Found</h3>
                    <p class="text-gray-600 mb-6">No products match your search criteria. Try different filters or browse all products.</p>
                    <a href="{{ route('products.index') }}" class="inline-block bg-[#3abad4] text-white px-6 py-3 rounded-lg font-medium hover:bg-[#12a4b7] transition duration-300">
                        View All Products
                    </a>
                </div>
            </div>
        @endif
    </div>

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

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Auto-submit form when category or sort changes
        document.getElementById('category').addEventListener('change', function() {
            document.getElementById('filter-form').submit();
        });
        
        document.getElementById('sort').addEventListener('change', function() {
            document.getElementById('filter-form').submit();
        });
        
        // Add delay for search input to avoid too many requests
        let searchTimeout;
        document.getElementById('search').addEventListener('input', function() {
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(function() {
                document.getElementById('filter-form').submit();
            }, 500); // Wait 500ms after user stops typing
        });
    });
</script>
@endpush
@endsection 