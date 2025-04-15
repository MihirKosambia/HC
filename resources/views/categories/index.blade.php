@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Hero Section -->
    <div class="bg-gradient-to-r from-[#3abad4] to-[#12a4b7] rounded-xl shadow-lg mb-8">
        <div class="container mx-auto px-6 py-16">
            <h1 class="text-4xl font-bold text-white mb-4">Product Categories</h1>
            <p class="text-white text-lg mb-8">Browse our wide range of product categories</p>
            <div class="flex space-x-4">
                <a href="#categories" class="bg-white text-[#3abad4] px-6 py-3 rounded-lg font-semibold hover:bg-[#e6f7fa] transition duration-300">
                    View All Categories
                </a>
                <a href="{{ route('products.index') }}" class="bg-transparent border-2 border-white text-white px-6 py-3 rounded-lg font-semibold hover:bg-white hover:text-[#3abad4] transition duration-300">
                    View All Products
                </a>
            </div>
        </div>
    </div>

    <!-- Search and Filter Section -->
    <div class="bg-white rounded-lg shadow-md p-6 mb-8">
        <form action="{{ route('categories.index') }}" method="GET">
            <div class="flex flex-col sm:flex-row gap-4">
                <div class="flex-1">
                    <input type="text" 
                           name="search" 
                           placeholder="Search categories..." 
                           value="{{ request('search') }}"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#3abad4] focus:border-[#3abad4]">
                </div>
                <div class="w-full sm:w-auto">
                    <select name="sort" 
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#3abad4] focus:border-[#3abad4]"
                            onchange="this.form.submit()">
                        <option value="name_asc" {{ request('sort') == 'name_asc' ? 'selected' : '' }}>Name (A-Z)</option>
                        <option value="name_desc" {{ request('sort') == 'name_desc' ? 'selected' : '' }}>Name (Z-A)</option>
                        <option value="products_desc" {{ request('sort') == 'products_desc' ? 'selected' : '' }}>Most Products</option>
                        <option value="products_asc" {{ request('sort') == 'products_asc' ? 'selected' : '' }}>Least Products</option>
                    </select>
                </div>
                <div class="w-full sm:w-auto">
                    <button type="submit" class="w-full sm:w-auto bg-[#3abad4] hover:bg-[#12a4b7] text-white px-6 py-2 rounded-lg transition duration-300">
                        <i class="fas fa-filter mr-2"></i>Filter
                    </button>
                </div>
            </div>
        </form>
    </div>

    <!-- Categories Grid -->
    <div id="categories" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        @foreach($categories as $category)
        <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl transition-all duration-300 border border-gray-100 group">
            <div class="p-6">
                <div class="flex items-center justify-center mb-4">
                    @if($category->name == 'Blood Collection Tubes')
                        <div class="w-16 h-16 flex items-center justify-center rounded-full bg-red-100 text-red-600 group-hover:scale-110 transition-transform duration-300">
                            <i class="fas fa-vial text-2xl"></i>
                        </div>
                    @elseif($category->name == 'Syringes')
                        <div class="w-16 h-16 flex items-center justify-center rounded-full bg-blue-100 text-blue-600 group-hover:scale-110 transition-transform duration-300">
                            <i class="fas fa-syringe text-2xl"></i>
                        </div>
                    @elseif($category->name == 'Needles')
                        <div class="w-16 h-16 flex items-center justify-center rounded-full bg-green-100 text-green-600 group-hover:scale-110 transition-transform duration-300">
                            <i class="fas fa-needle text-2xl"></i>
                        </div>
                    @elseif($category->name == 'Safety Products')
                        <div class="w-16 h-16 flex items-center justify-center rounded-full bg-yellow-100 text-yellow-600 group-hover:scale-110 transition-transform duration-300">
                            <i class="fas fa-shield-alt text-2xl"></i>
                        </div>
                    @elseif($category->name == 'Medical Devices')
                        <div class="w-16 h-16 flex items-center justify-center rounded-full bg-purple-100 text-purple-600 group-hover:scale-110 transition-transform duration-300">
                            <i class="fas fa-stethoscope text-2xl"></i>
                        </div>
                    @else
                        <div class="w-16 h-16 flex items-center justify-center rounded-full bg-gray-100 text-gray-600 group-hover:scale-110 transition-transform duration-300">
                            <i class="fas fa-microscope text-2xl"></i>
                        </div>
                    @endif
                </div>
                <h3 class="text-xl font-bold text-center text-gray-900 mb-2 group-hover:text-[#3abad4] transition-colors duration-300">{{ $category->name }}</h3>
                <p class="text-gray-600 text-center mb-4 line-clamp-2">{{ $category->description }}</p>
                <div class="flex items-center justify-between">
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-[#e6f7fa] text-[#3abad4]">
                        <i class="fas fa-box-open mr-2"></i>
                        {{ $category->products_count ?? 0 }} Products
                    </span>
                    <a href="{{ route('categories.show', $category) }}" class="text-[#3abad4] hover:text-[#12a4b7] font-medium group-hover:translate-x-2 transition-transform duration-300">
                        Browse Category →
                    </a>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Empty State -->
    @if($categories->isEmpty())
    <div class="text-center py-12">
        <div class="bg-white rounded-lg shadow-md p-8 max-w-2xl mx-auto">
            <div class="text-gray-400 mb-4">
                <i class="fas fa-folder-open text-6xl"></i>
            </div>
            <h3 class="text-xl font-semibold text-gray-900 mb-2">No Categories Found</h3>
            <p class="text-gray-600 mb-6">We haven't added any categories yet. Please check back later.</p>
        </div>
    </div>
    @endif

    <!-- Pagination -->
    <div class="mt-8">
        {{ $categories->links() }}
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