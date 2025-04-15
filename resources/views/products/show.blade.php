@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Product Details -->
    <div class="flex flex-col lg:flex-row gap-8">
        <!-- Left Column: Image and Description -->
        <div class="lg:w-2/3">
            <!-- Image Gallery -->
            <div class="bg-white rounded-xl shadow-sm p-4 mb-8">
                <!-- Main Image -->
                <div class="mb-4">
                    @if($product->image_url)
                        <img src="{{ $product->image_url }}" 
                             alt="{{ $product->name }}" 
                             class="w-full h-96 object-cover rounded-lg" 
                             id="mainImage">
                    @else
                        <div class="w-full h-96 bg-gray-200 rounded-lg flex items-center justify-center">
                            <i class="fas fa-image text-gray-400 text-4xl"></i>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Desktop Description -->
            <div class="hidden lg:block bg-white rounded-xl shadow-sm p-6 mb-8">
                <h2 class="text-xl font-semibold text-gray-900 mb-4">Product Description</h2>
                <div id="description-content-desktop" class="prose max-w-none">
                    {!! $product->description !!}
                </div>
            </div>

            <!-- Mobile Description Button and Modal -->
            <div class="lg:hidden">
                <button onclick="openDescriptionModal()" 
                        class="w-full bg-gray-50 text-gray-900 px-6 py-3 rounded-lg font-medium hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-[#3abad4] focus:ring-offset-2 transition-colors duration-150 flex items-center justify-center mb-8">
                    <i class="fas fa-list-alt mr-2"></i>
                    View Product Description
                </button>

                <!-- Description Modal for Mobile -->
                <div id="descriptionModal" 
                     class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center p-4">
                    <div class="bg-white rounded-xl shadow-xl max-w-2xl w-full max-h-[90vh] overflow-hidden">
                        <div class="p-6 border-b border-gray-200 flex justify-between items-center">
                            <h2 class="text-xl font-semibold text-gray-900">Product Description</h2>
                            <button onclick="closeDescriptionModal()" class="text-gray-400 hover:text-gray-500">
                                <i class="fas fa-times text-xl"></i>
                            </button>
                        </div>
                        <div class="p-6 overflow-y-auto" style="max-height: calc(90vh - 120px);">
                            <div id="description-content-mobile" class="prose max-w-none">
                                {!! $product->description !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Column: Product Info and Inquiry Form -->
        <div class="lg:w-1/3">
            <div class="bg-white rounded-xl shadow-sm p-6 mb-8">
                <!-- Category -->
                <div class="mb-4">
                    <a href="{{ route('products.index', ['category' => $product->category->slug]) }}" 
                       class="text-[#3abad4] text-sm hover:underline">
                        {{ $product->category->name }}
                    </a>
                </div>

                <!-- Product Name -->
                <h1 class="text-3xl font-bold text-gray-900 mb-4">{{ $product->name }}</h1>

                <!-- Price -->
                <div class="mb-6">
                    <span class="text-3xl font-bold text-[#3abad4]">₹{{ number_format($product->price, 2) }}</span>
                    @if($product->created_at->gt(now()->subDays(7)))
                        <span class="ml-3 bg-[#3abad4] text-white text-sm font-medium px-2 py-1 rounded-full">New</span>
                    @endif
                </div>

                <!-- Stock Status -->
                <div class="mb-8">
                    <span class="text-sm font-medium text-gray-700">Stock Status:</span>
                    @if($product->stock > 0)
                        <span class="ml-2 text-green-600 font-medium">In Stock ({{ $product->stock }} available)</span>
                    @else
                        <span class="ml-2 text-red-600 font-medium">Out of Stock</span>
                    @endif
                </div>
            </div>

            <!-- Inquiry Form -->
            <div class="bg-white rounded-xl shadow-sm p-6">
                <h2 class="text-xl font-semibold text-gray-900 mb-4 flex items-center">
                    <i class="fas fa-envelope mr-2 text-[#3abad4]"></i>
                    Inquire About This Product
                </h2>
                <form action="{{ route('products.inquiry', $product) }}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Name</label>
                        <input type="text" 
                               id="name" 
                               name="name" 
                               required 
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#3abad4] focus:border-[#3abad4]">
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                        <input type="email" 
                               id="email" 
                               name="email" 
                               required 
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#3abad4] focus:border-[#3abad4]">
                    </div>

                    <div>
                        <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Phone (optional)</label>
                        <input type="tel" 
                               id="phone" 
                               name="phone" 
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#3abad4] focus:border-[#3abad4]">
                    </div>

                    <div>
                        <label for="message" class="block text-sm font-medium text-gray-700 mb-1">Message</label>
                        <textarea id="message" 
                                  name="message" 
                                  rows="4" 
                                  required 
                                  placeholder="Please let us know your requirements..."
                                  class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#3abad4] focus:border-[#3abad4]"></textarea>
                    </div>

                    <button type="submit" 
                            class="w-full bg-[#3abad4] text-white px-6 py-3 rounded-lg font-medium hover:bg-[#12a4b7] focus:outline-none focus:ring-2 focus:ring-[#3abad4] focus:ring-offset-2 transition-colors duration-150 flex items-center justify-center">
                        <i class="fas fa-paper-plane mr-2"></i>
                        Send Inquiry
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Related Products -->
    @if($relatedProducts->isNotEmpty())
        <div class="mt-12">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Related Products</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($relatedProducts as $relatedProduct)
                    <div class="bg-white rounded-xl shadow-sm overflow-hidden group">
                        <div class="relative">
                            @if($relatedProduct->image_url)
                                <img src="{{ $relatedProduct->image_url }}" 
                                     alt="{{ $relatedProduct->name }}" 
                                     class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300">
                            @else
                                <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                                    <i class="fas fa-image text-gray-400 text-4xl"></i>
                                </div>
                            @endif
                            @if($relatedProduct->created_at->gt(now()->subDays(7)))
                                <div class="absolute top-3 right-3">
                                    <span class="bg-[#3abad4] text-white text-sm font-medium px-2 py-1 rounded-full">
                                        New
                                    </span>
                                </div>
                            @endif
                        </div>
                        <div class="p-4">
                            <h3 class="text-lg font-semibold text-gray-900 mb-2 group-hover:text-[#3abad4]">
                                {{ $relatedProduct->name }}
                            </h3>
                            <p class="text-gray-600 text-sm mb-3">{{ Str::limit($relatedProduct->description, 80) }}</p>
                            <div class="flex items-center justify-between">
                                <span class="text-xl font-bold text-[#3abad4]">${{ number_format($relatedProduct->price, 2) }}</span>
                                <a href="{{ route('products.show', $relatedProduct->slug) }}" 
                                   class="inline-flex items-center px-3 py-2 border border-[#3abad4] text-sm font-medium rounded-lg text-[#3abad4] hover:bg-[#3abad4] hover:text-white transition-colors duration-150">
                                    View Details
                                    <i class="fas fa-arrow-right ml-2"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
</div>

@if(session('success'))
    <div class="fixed bottom-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg" 
         x-data="{ show: true }" 
         x-show="show" 
         x-init="setTimeout(() => show = false, 5000)">
        {{ session('success') }}
    </div>
@endif

<script>
function changeMainImage(src) {
    document.getElementById('mainImage').src = src;
}

function openDescriptionModal() {
    document.getElementById('descriptionModal').classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}

function closeDescriptionModal() {
    document.getElementById('descriptionModal').classList.add('hidden');
    document.body.style.overflow = 'auto';
}

// Close modal when clicking outside
document.getElementById('descriptionModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeDescriptionModal();
    }
});

// Close modal on escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape' && !document.getElementById('descriptionModal').classList.contains('hidden')) {
        closeDescriptionModal();
    }
});
</script>

@push('styles')
<style>
    .prose {
        max-width: none;
    }
    .prose p {
        margin-bottom: 1rem;
    }
    .prose ul, .prose ol {
        margin-left: 1.5rem;
        margin-bottom: 1rem;
        padding-left: 1rem;
    }
    .prose ul {
        list-style-type: disc;
    }
    .prose ol {
        list-style-type: decimal;
    }
    .prose h1, .prose h2, .prose h3, .prose h4 {
        font-weight: 600;
        margin-top: 1.5rem;
        margin-bottom: 1rem;
        color: #111827;
    }
    .prose h1 { font-size: 1.5rem; }
    .prose h2 { font-size: 1.25rem; }
    .prose h3 { font-size: 1.125rem; }
    .prose h4 { font-size: 1rem; }
    .prose table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 1rem;
    }
    .prose th, .prose td {
        border: 1px solid #e5e7eb;
        padding: 0.75rem;
    }
    .prose th {
        background-color: #f8fafc;
        font-weight: 600;
    }
</style>
@endpush
@endsection 