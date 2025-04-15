@extends('layouts.admin')

@section('title', isset($product) ? 'Edit Product' : 'Create Product')

@section('content')
<div class="bg-white rounded-lg shadow-sm">
    <div class="p-6 border-b border-gray-200">
        <h2 class="text-2xl font-bold text-gray-900">
            {{ isset($product) ? 'Edit Product' : 'Create Product' }}
        </h2>
    </div>

    <div class="p-6">
        <form action="{{ isset($product) ? route('admin.products.update', $product->id) : route('admin.products.store') }}" 
              method="POST" 
              id="productForm"
              class="space-y-6">
            @csrf
            @if(isset($product))
                @method('PUT')
            @endif

            <!-- Basic Information -->
            <div class="bg-white p-6 rounded-lg shadow-sm">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Basic Information</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700">Product Name</label>
                        <input type="text" 
                               name="name" 
                               id="name" 
                               value="{{ old('name', $product->name ?? '') }}" 
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#00A4B8] focus:ring-[#00A4B8]"
                               required>
                        @error('name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="category_id" class="block text-sm font-medium text-gray-700">Category</label>
                        <select name="category_id" 
                                id="category_id" 
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#00A4B8] focus:ring-[#00A4B8]"
                                required>
                            <option value="">Select Category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" 
                                        {{ old('category_id', $product->category_id ?? '') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="price" class="block text-sm font-medium text-gray-700">Price</label>
                        <div class="mt-1 relative rounded-md shadow-sm">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <span class="text-gray-500 sm:text-sm">$</span>
                            </div>
                            <input type="number" 
                                   name="price" 
                                   id="price" 
                                   value="{{ old('price', $product->price ?? '') }}" 
                                   class="pl-7 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#00A4B8] focus:ring-[#00A4B8]"
                                   step="0.01"
                                   min="0"
                                   required>
                        </div>
                        @error('price')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="stock" class="block text-sm font-medium text-gray-700">Stock</label>
                        <input type="number" 
                               name="stock" 
                               id="stock" 
                               value="{{ old('stock', $product->stock ?? 0) }}" 
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#00A4B8] focus:ring-[#00A4B8]"
                               min="0"
                               required>
                        @error('stock')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Description -->
            <div class="bg-white p-6 rounded-lg shadow-sm">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Description</h3>
                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700">Product Description</label>
                    <textarea name="description" 
                              id="description" 
                              class="tinymce-editor mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#00A4B8] focus:ring-[#00A4B8]"
                              required>{{ old('description', $product->description ?? '') }}</textarea>
                    @error('description')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Image URL -->
            <div class="bg-white p-6 rounded-lg shadow-sm">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Product Image</h3>
                <div>
                    <label for="image_url" class="block text-sm font-medium text-gray-700">Image URL</label>
                    <div class="mt-1">
                        <input type="url" 
                               name="image_url" 
                               id="image_url" 
                               value="{{ old('image_url', $product->image_url ?? '') }}" 
                               class="block w-full rounded-md border-gray-300 shadow-sm focus:border-[#00A4B8] focus:ring-[#00A4B8]"
                               placeholder="https://example.com/image.jpg"
                               onchange="previewImage(this)">
                        <p class="mt-1 text-sm text-gray-500">Enter a direct URL to your product image (e.g., https://example.com/image.jpg)</p>
                    </div>
                    @error('image_url')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror

                    <!-- Image Preview -->
                    <div class="mt-4">
                        <p class="text-sm font-medium text-gray-700 mb-2">Image Preview:</p>
                        <div class="relative w-32 h-32 bg-gray-100 rounded-lg overflow-hidden">
                            <img id="image_preview" 
                                 src="{{ old('image_url', $product->image_url ?? 'https://via.placeholder.com/400x400.png?text=No+Image') }}" 
                                 alt="Product preview"
                                 class="w-full h-full object-cover">
                            <div id="image_loading" class="absolute inset-0 bg-gray-100 items-center justify-center hidden">
                                <svg class="animate-spin h-8 w-8 text-[#00A4B8]" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Status -->
            <div class="bg-white p-6 rounded-lg shadow-sm">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Status</h3>
                <div class="space-y-4">
                    <div class="flex items-center">
                        <input type="checkbox" 
                               name="is_active" 
                               id="is_active" 
                               value="1" 
                               {{ old('is_active', $product->is_active ?? true) ? 'checked' : '' }}
                               class="h-4 w-4 text-[#00A4B8] focus:ring-[#00A4B8] border-gray-300 rounded">
                        <label for="is_active" class="ml-2 block text-sm text-gray-700">Active</label>
                    </div>

                    <div class="flex items-center">
                        <input type="checkbox" 
                               name="is_featured" 
                               id="is_featured" 
                               value="1" 
                               {{ old('is_featured', $product->is_featured ?? false) ? 'checked' : '' }}
                               class="h-4 w-4 text-[#00A4B8] focus:ring-[#00A4B8] border-gray-300 rounded">
                        <label for="is_featured" class="ml-2 block text-sm text-gray-700">Featured Product</label>
                    </div>
                </div>
            </div>

            <!-- SEO -->
            <div class="bg-white p-6 rounded-lg shadow-sm">
                <h3 class="text-lg font-medium text-gray-900 mb-4">SEO Information</h3>
                <div class="space-y-4">
                    <div>
                        <label for="meta_title" class="block text-sm font-medium text-gray-700">Meta Title</label>
                        <input type="text" 
                               name="meta_title" 
                               id="meta_title" 
                               value="{{ old('meta_title', $product->meta_title ?? '') }}" 
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#00A4B8] focus:ring-[#00A4B8]">
                    </div>

                    <div>
                        <label for="meta_description" class="block text-sm font-medium text-gray-700">Meta Description</label>
                        <textarea name="meta_description" 
                                  id="meta_description" 
                                  rows="2" 
                                  class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#00A4B8] focus:ring-[#00A4B8]">{{ old('meta_description', $product->meta_description ?? '') }}</textarea>
                    </div>

                    <div>
                        <label for="meta_keywords" class="block text-sm font-medium text-gray-700">Meta Keywords</label>
                        <input type="text" 
                               name="meta_keywords" 
                               id="meta_keywords" 
                               value="{{ old('meta_keywords', $product->meta_keywords ?? '') }}" 
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#00A4B8] focus:ring-[#00A4B8]"
                               placeholder="keyword1, keyword2, keyword3">
                    </div>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="flex justify-end">
                <button type="submit" 
                        class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-[#00A4B8] hover:bg-[#008999] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#00A4B8]">
                    {{ isset($product) ? 'Update Product' : 'Create Product' }}
                </button>
            </div>
        </form>
    </div>
</div>

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/tinymce@6/skins/ui/oxide/skin.min.css" rel="stylesheet">
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/tinymce@6/tinymce.min.js"></script>
<script>
    // Form submission
    document.getElementById('productForm').addEventListener('submit', function(e) {
        e.preventDefault();
        this.querySelector('button[type="submit"]').disabled = true;
        this.submit();
    });

    // Image preview functionality
    function previewImage(input) {
        const preview = document.getElementById('image_preview');
        const loading = document.getElementById('image_loading');
        
        if (input.value) {
            loading.classList.remove('hidden');
            loading.classList.add('flex');
            
            // Create a new image object to test the URL
            const img = new Image();
            img.onload = function() {
                preview.src = input.value;
                loading.classList.remove('flex');
                loading.classList.add('hidden');
            };
            img.onerror = function() {
                preview.src = 'https://via.placeholder.com/400x400.png?text=Invalid+Image+URL';
                loading.classList.remove('flex');
                loading.classList.add('hidden');
                alert('Invalid image URL. Please check the URL and try again.');
            };
            img.src = input.value;
        } else {
            preview.src = 'https://via.placeholder.com/400x400.png?text=No+Image';
        }
    }

    tinymce.init({
        selector: '.tinymce-editor',
        height: 400,
        menubar: true,
        plugins: [
            'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview',
            'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen',
            'insertdatetime', 'media', 'table', 'help', 'wordcount'
        ],
        toolbar: 'undo redo | blocks | ' +
            'bold italic forecolor | alignleft aligncenter ' +
            'alignright alignjustify | bullist numlist outdent indent | ' +
            'removeformat | help',
        content_style: 'body { font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif; font-size: 14px; }',
        branding: false,
        promotion: false,
        setup: function (editor) {
            editor.on('change', function () {
                editor.save();
            });
        }
    });
</script>
@endpush
@endsection 