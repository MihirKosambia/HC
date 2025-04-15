@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Hero Section -->
    <div class="bg-gradient-to-r from-[#3abad4] to-[#12a4b7] rounded-xl shadow-lg mb-12">
        <div class="container mx-auto px-6 py-16 text-center">
            <h1 class="text-4xl md:text-5xl font-bold text-white mb-4">About Us</h1>
            <p class="text-white text-lg mb-8 max-w-2xl mx-auto">Learn about our journey, mission, and the team behind our success</p>
        </div>
    </div>

    <!-- Mission & Vision -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-16">
        <div class="bg-white rounded-lg shadow-md p-8">
            <div class="text-[#3abad4] mb-4">
                <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                </svg>
            </div>
            <h2 class="text-2xl font-bold text-gray-900 mb-4">Our Mission</h2>
            <p class="text-gray-600 leading-relaxed">
                To provide high-quality products and exceptional service to our customers while maintaining sustainable business practices and contributing positively to our community.
            </p>
        </div>
        <div class="bg-white rounded-lg shadow-md p-8">
            <div class="text-[#12a4b7] mb-4">
                <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                </svg>
            </div>
            <h2 class="text-2xl font-bold text-gray-900 mb-4">Our Vision</h2>
            <p class="text-gray-600 leading-relaxed">
                To become the leading provider of innovative solutions in our industry, recognized for excellence, integrity, and customer satisfaction worldwide.
            </p>
        </div>
    </div>

    <!-- Company Story -->
    <div class="bg-white rounded-lg shadow-md p-8 mb-16">
        <h2 class="text-3xl font-bold text-gray-900 mb-6">Our Story</h2>
        <div class="prose max-w-none">
            <p class="text-gray-600 mb-4">
                Founded in 2020, our company began with a simple idea: to provide exceptional products that make a difference in people's lives. What started as a small operation has grown into a thriving business, thanks to our dedicated team and loyal customers.
            </p>
            <p class="text-gray-600 mb-4">
                Over the years, we've expanded our product line, improved our services, and built strong relationships with our customers and partners. Our commitment to quality and innovation remains at the heart of everything we do.
            </p>
            <p class="text-gray-600">
                Today, we continue to grow and evolve, always staying true to our core values of excellence, integrity, and customer satisfaction. We're excited about the future and grateful for the opportunity to serve our community.
            </p>
        </div>
    </div>

    <!-- Team Section -->
    <div class="mb-16">
        <h2 class="text-3xl font-bold text-gray-900 mb-8 text-center">Our Team</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Team Member 1 -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <img src="https://via.placeholder.com/400x400?text=CEO" alt="CEO" class="w-full h-64 object-cover">
                <div class="p-6">
                    <h3 class="text-xl font-bold text-gray-900 mb-2">John Doe</h3>
                    <p class="text-[#3abad4] font-medium mb-4">CEO & Founder</p>
                    <p class="text-gray-600">Leading our company with vision and innovation.</p>
                </div>
            </div>
            <!-- Team Member 2 -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <img src="https://via.placeholder.com/400x400?text=CTO" alt="CTO" class="w-full h-64 object-cover">
                <div class="p-6">
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Jane Smith</h3>
                    <p class="text-[#3abad4] font-medium mb-4">CTO</p>
                    <p class="text-gray-600">Driving technological excellence and innovation.</p>
                </div>
            </div>
            <!-- Team Member 3 -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <img src="https://via.placeholder.com/400x400?text=COO" alt="COO" class="w-full h-64 object-cover">
                <div class="p-6">
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Mike Johnson</h3>
                    <p class="text-[#3abad4] font-medium mb-4">COO</p>
                    <p class="text-gray-600">Ensuring smooth operations and customer satisfaction.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Call to Action -->
    <div class="bg-gradient-to-r from-[#3abad4] to-[#12a4b7] rounded-xl shadow-lg">
        <div class="container mx-auto px-6 py-12 text-center">
            <h2 class="text-3xl font-bold text-white mb-4">Ready to Get Started?</h2>
            <p class="text-white text-lg mb-8">Join us on our journey to excellence</p>
            <div class="flex justify-center space-x-4">
                <a href="{{ route('contact.create') }}" class="bg-white text-[#3abad4] px-8 py-3 rounded-lg font-semibold hover:bg-[#e6f7fa] transition duration-300">
                    Contact Us
                </a>
                <a href="{{ route('products.index') }}" class="bg-transparent border-2 border-white text-white px-8 py-3 rounded-lg font-semibold hover:bg-white hover:text-[#3abad4] transition duration-300">
                    View Products
                </a>
            </div>
        </div>
    </div>
</div>
@endsection 