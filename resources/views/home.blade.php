@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-4">
    <!-- Hero Section -->
    <div class="bg-gradient-to-r from-[#3abad4] to-[#12a4b7] rounded-xl shadow-lg mb-8">
        <div class="container mx-auto px-6 py-12 text-center">
            <h1 class="text-4xl md:text-5xl font-bold text-white mb-4">Welcome to Our Store</h1>
            <p class="text-white text-lg mb-6 max-w-2xl mx-auto">Discover our amazing collection of high-quality products</p>
            <div class="flex justify-center space-x-4">
                <a href="{{ route('products.index') }}" class="bg-white text-[#3abad4] px-8 py-3 rounded-lg font-semibold hover:bg-[#e6f7fa] transition duration-300">
                    Browse Products
                </a>
                <a href="{{ route('contact.create') }}" class="bg-transparent border-2 border-white text-white px-8 py-3 rounded-lg font-semibold hover:bg-white hover:text-[#3abad4] transition duration-300">
                    Contact Us
                </a>
            </div>
        </div>
    </div>

    <!-- Featured Categories -->
    <div class="mb-10">
        <h2 class="text-3xl font-bold text-gray-900 mb-6 text-center">Featured Categories</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($categories as $category)
            <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-all duration-300 border border-gray-100">
                <div class="p-6">
                    <div class="flex items-center justify-center mb-4">
                        @if($category->name == 'Blood Collection Tubes')
                            <div class="w-16 h-16 flex items-center justify-center rounded-full bg-red-100 text-red-600">
                                <i class="fas fa-vial text-2xl"></i>
                            </div>
                        @elseif($category->name == 'Syringes')
                            <div class="w-16 h-16 flex items-center justify-center rounded-full bg-blue-100 text-blue-600">
                                <i class="fas fa-syringe text-2xl"></i>
                            </div>
                        @elseif($category->name == 'Needles')
                            <div class="w-16 h-16 flex items-center justify-center rounded-full bg-green-100 text-green-600">
                                <i class="fas fa-needle text-2xl"></i>
                            </div>
                        @elseif($category->name == 'Safety Products')
                            <div class="w-16 h-16 flex items-center justify-center rounded-full bg-yellow-100 text-yellow-600">
                                <i class="fas fa-shield-alt text-2xl"></i>
                            </div>
                        @elseif($category->name == 'Medical Devices')
                            <div class="w-16 h-16 flex items-center justify-center rounded-full bg-purple-100 text-purple-600">
                                <i class="fas fa-stethoscope text-2xl"></i>
                            </div>
                        @else
                            <div class="w-16 h-16 flex items-center justify-center rounded-full bg-gray-100 text-gray-600">
                                <i class="fas fa-microscope text-2xl"></i>
                            </div>
                        @endif
                    </div>
                    <h3 class="text-xl font-bold text-center text-gray-900 mb-2">{{ $category->name }}</h3>
                    <p class="text-gray-600 text-center mb-4 line-clamp-2">{{ $category->description }}</p>
                    <div class="flex justify-center">
                        <a href="{{ route('categories.show', $category) }}" 
                           class="inline-flex items-center px-4 py-2 bg-[#3abad4] text-white rounded-lg hover:bg-[#12a4b7] transition-colors duration-300">
                            <span>View Products</span>
                            <i class="fas fa-arrow-right ml-2"></i>
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <!-- Featured Products -->
    <div class="mb-10">
        <h2 class="text-3xl font-bold text-gray-900 mb-6 text-center">Featured Products</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
            @foreach($featuredProducts as $product)
            <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition duration-300">
                <div class="relative">
                    @if($product->image_url)
                        <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-full h-56 object-cover">
                    @else
                        <div class="w-full h-56 bg-gray-200 flex items-center justify-center">
                            <i class="fas fa-image text-gray-400 text-4xl"></i>
                        </div>
                    @endif
                    @if($product->is_featured)
                        <span class="absolute top-4 right-4 bg-yellow-400 text-black px-3 py-1 rounded-full text-sm font-semibold">Featured</span>
                    @endif
                </div>
                <div class="p-4">
                    <h3 class="text-xl font-semibold mb-2">{{ $product->name }}</h3>
                    <p class="text-gray-600 mb-3 line-clamp-2">{{ $product->description }}</p>
                    <div class="flex items-center justify-between">
                        <span class="text-2xl font-bold text-[#3abad4]">₹{{ number_format($product->price, 2) }}</span>
                        <a href="{{ route('products.show', $product) }}" class="bg-[#3abad4] text-white px-4 py-2 rounded-lg hover:bg-[#12a4b7] transition duration-300">
                            View Details
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="text-center mt-6">
            <a href="{{ route('products.index') }}" class="inline-block bg-[#3abad4] text-white px-8 py-3 rounded-lg font-semibold hover:bg-[#12a4b7] transition duration-300">
                View All Products
            </a>
        </div>
    </div>

    <!-- Why Choose Us -->
    <div class="mb-10">
        <h2 class="text-3xl font-bold text-gray-900 mb-6 text-center">Why Choose Us</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
            <!-- Quality Products -->
            <div class="bg-white rounded-lg shadow-md p-4 text-center">
                <div class="text-[#3abad4] mb-3">
                    <svg class="w-10 h-10 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Quality Products</h3>
                <p class="text-gray-600">We ensure all our products meet the highest quality standards.</p>
            </div>

            <!-- Fast Shipping -->
            <div class="bg-white rounded-lg shadow-md p-4 text-center">
                <div class="text-[#3abad4] mb-3">
                    <svg class="w-10 h-10 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Fast Shipping</h3>
                <p class="text-gray-600">Quick and reliable delivery to your doorstep.</p>
            </div>

            <!-- Best Prices -->
            <div class="bg-white rounded-lg shadow-md p-4 text-center">
                <div class="text-[#3abad4] mb-3">
                    <svg class="w-10 h-10 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Best Prices</h3>
                <p class="text-gray-600">Competitive prices for all products.</p>
            </div>

            <!-- 24/7 Support -->
            <div class="bg-white rounded-lg shadow-md p-4 text-center">
                <div class="text-[#3abad4] mb-3">
                    <svg class="w-10 h-10 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">24/7 Support</h3>
                <p class="text-gray-600">Always here to help you with any questions.</p>
            </div>
        </div>
    </div>

    <!-- Call to Action -->
    <div class="bg-gradient-to-r from-[#3abad4] to-[#12a4b7] rounded-xl shadow-lg">
        <div class="container mx-auto px-6 py-8 text-center">
            <h2 class="text-3xl font-bold text-white mb-4">Ready to Get Started?</h2>
            <p class="text-white text-lg mb-6">Join thousands of satisfied customers today</p>
            <div class="flex justify-center space-x-4">
                <a href="{{ route('products.index') }}" class="bg-white text-[#3abad4] px-8 py-3 rounded-lg font-semibold hover:bg-[#e6f7fa] transition duration-300">
                    Shop Now
                </a>
                <a href="{{ route('contact.create') }}" class="bg-transparent border-2 border-white text-white px-8 py-3 rounded-lg font-semibold hover:bg-white hover:text-[#3abad4] transition duration-300">
                    Contact Us
                </a>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Add your JavaScript here
</script>
@endpush
@endsection 