@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-3xl mx-auto">
        <div class="bg-white rounded-xl shadow-sm p-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-8">Contact Us</h1>
            
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <form action="{{ route('contact.store') }}" method="POST" class="space-y-6">
                @csrf
                
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Name</label>
                    <input type="text" 
                           id="name" 
                           name="name" 
                           value="{{ old('name') }}"
                           required 
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#3abad4] focus:border-[#3abad4]">
                    @error('name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <input type="email" 
                           id="email" 
                           name="email" 
                           value="{{ old('email') }}"
                           required 
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#3abad4] focus:border-[#3abad4]">
                    @error('email')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Phone (optional)</label>
                    <input type="tel" 
                           id="phone" 
                           name="phone" 
                           value="{{ old('phone') }}"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#3abad4] focus:border-[#3abad4]">
                    @error('phone')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="subject" class="block text-sm font-medium text-gray-700 mb-1">Subject</label>
                    <input type="text" 
                           id="subject" 
                           name="subject" 
                           value="{{ old('subject') }}"
                           required 
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#3abad4] focus:border-[#3abad4]">
                    @error('subject')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="message" class="block text-sm font-medium text-gray-700 mb-1">Message</label>
                    <textarea id="message" 
                              name="message" 
                              rows="6" 
                              required 
                              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#3abad4] focus:border-[#3abad4]">{{ old('message') }}</textarea>
                    @error('message')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit" 
                        class="w-full bg-[#3abad4] text-white px-6 py-3 rounded-lg font-medium hover:bg-[#12a4b7] focus:outline-none focus:ring-2 focus:ring-[#3abad4] focus:ring-offset-2 transition-colors duration-150">
                    Send Message
                </button>
            </form>

            <!-- Contact Information -->
            <div class="mt-12 pt-8 border-t border-gray-200">
                <h2 class="text-xl font-semibold text-gray-900 mb-6">Other Ways to Contact Us</h2>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="flex items-start space-x-4">
                        <div class="flex-shrink-0">
                            <i class="fas fa-map-marker-alt text-[#3abad4] text-xl"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-medium text-gray-900">Address</h3>
                            <p class="mt-1 text-gray-600">
                                123 Business Street<br>
                                City, State 12345
                            </p>
                        </div>
                    </div>

                    <div class="flex items-start space-x-4">
                        <div class="flex-shrink-0">
                            <i class="fas fa-phone text-[#3abad4] text-xl"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-medium text-gray-900">Phone</h3>
                            <p class="mt-1 text-gray-600">
                                +1 (555) 123-4567<br>
                                Mon - Fri, 9am - 6pm
                            </p>
                        </div>
                    </div>

                    <div class="flex items-start space-x-4">
                        <div class="flex-shrink-0">
                            <i class="fas fa-envelope text-[#3abad4] text-xl"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-medium text-gray-900">Email</h3>
                            <p class="mt-1 text-gray-600">
                                info@example.com<br>
                                support@example.com
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 