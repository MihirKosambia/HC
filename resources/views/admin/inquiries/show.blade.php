@extends('layouts.admin')

@section('title', 'Inquiry Details')

@section('content')
<div class="mb-6">
    <div class="flex justify-between items-center">
        <h1 class="text-2xl font-bold">Inquiry Details</h1>
        <div class="flex space-x-3">
            <form action="{{ route('admin.inquiries.destroy', $inquiry) }}" method="POST" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg" onclick="return confirm('Are you sure you want to delete this inquiry?')">
                    Delete Inquiry
                </button>
            </form>
            <a href="{{ route('admin.inquiries.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg">
                Back to List
            </a>
        </div>
    </div>
</div>

<div class="bg-white rounded-lg shadow overflow-hidden">
    <div class="p-6 border-b">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Product Information -->
            @if($inquiry->product)
            <div>
                <h3 class="text-lg font-semibold mb-4">Product Information</h3>
                <div class="flex items-start">
                    @if($inquiry->product->images->first())
                        <img src="{{ asset('storage/' . $inquiry->product->images->first()->image_path) }}" 
                             alt="{{ $inquiry->product->name }}" 
                             class="h-24 w-24 object-cover rounded mr-4">
                    @endif
                    <div>
                        <h4 class="font-medium">{{ $inquiry->product->name }}</h4>
                        <p class="text-sm text-gray-600 mt-1">Price: ${{ number_format($inquiry->product->price, 2) }}</p>
                        <a href="{{ route('admin.products.edit', $inquiry->product) }}" class="text-blue-600 hover:text-blue-900 text-sm mt-2 inline-block">
                            View Product
                        </a>
                    </div>
                </div>
            </div>
            @endif

            <!-- Customer Information -->
            <div>
                <h3 class="text-lg font-semibold mb-4">Customer Information</h3>
                <div class="space-y-3">
                    <div>
                        <label class="text-sm font-medium text-gray-600">Name</label>
                        <p class="mt-1">{{ $inquiry->name }}</p>
                    </div>
                    <div>
                        <label class="text-sm font-medium text-gray-600">Email</label>
                        <p class="mt-1">{{ $inquiry->email }}</p>
                    </div>
                    <div>
                        <label class="text-sm font-medium text-gray-600">Phone</label>
                        <p class="mt-1">{{ $inquiry->phone }}</p>
                    </div>
                    <div>
                        <label class="text-sm font-medium text-gray-600">Submitted On</label>
                        <p class="mt-1">{{ $inquiry->created_at->format('M d, Y H:i') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Message -->
    <div class="p-6">
        <h3 class="text-lg font-semibold mb-4">Message</h3>
        <div class="bg-gray-50 rounded-lg p-4">
            {{ $inquiry->message }}
        </div>
    </div>
</div>
@endsection 