<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Favicon -->
        <link rel="icon" type="image/png" href="https://mihircsf.site/uploads/67fdf2d725572_favicon.png">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

        <!-- Icons -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

        <!-- Swiper CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @stack('styles')
        
        <!-- Styles -->
        <style>
            [x-cloak] { display: none !important; }
            body { font-family: 'Inter', sans-serif; }
            :root {
                --primary-color: #3abad4;
                --primary-dark: #12a4b7;
                --primary-light: #e6f7fa;
            }
            /* WhatsApp Button */
            .whatsapp-button {
                position: fixed;
                bottom: 20px;
                right: 20px;
                background-color: #25D366;
                color: white;
                border-radius: 50%;
                width: 60px;
                height: 60px;
                display: flex;
                justify-content: center;
                align-items: center;
                box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
                z-index: 1000;
                transition: all 0.3s ease;
            }
            .whatsapp-button:hover {
                background-color: #128C7E;
                transform: scale(1.1);
            }
            .whatsapp-button i {
                font-size: 32px;
            }
        </style>
   
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-50" x-data="{ open: false }">
            <nav class="bg-white border-b border-gray-100">
                <div class="max-w-full mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between h-24">
                        <div class="flex">
                            <!-- Logo -->
                            <div class="shrink-0 flex items-center">
                                <a href="{{ route('home') }}" class="flex items-center">
                                    <img src="https://mihircsf.site/uploads/67fc20c8bc05e_done.png" 
                                         alt="{{ config('app.name', 'Laravel') }}" 
                                         class="h-16 w-auto">
                                </a>
                            </div>

                            <!-- Navigation Links -->
                            <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex items-center">
                                <a href="{{ route('home') }}" 
                                   class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('home') ? 'border-[#3abad4] text-[#3abad4]' : 'border-transparent text-gray-500 hover:text-[#3abad4] hover:border-[#12a4b7]' }} text-sm font-medium leading-5 transition duration-150 ease-in-out">
                                    Home
                                </a>
                                <a href="{{ route('about') }}" 
                                   class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('about') ? 'border-[#3abad4] text-[#3abad4]' : 'border-transparent text-gray-500 hover:text-[#3abad4] hover:border-[#12a4b7]' }} text-sm font-medium leading-5 transition duration-150 ease-in-out">
                                    About
                                </a>
                                <a href="{{ route('products.index') }}" 
                                   class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('products.*') ? 'border-[#3abad4] text-[#3abad4]' : 'border-transparent text-gray-500 hover:text-[#3abad4] hover:border-[#12a4b7]' }} text-sm font-medium leading-5 transition duration-150 ease-in-out">
                                    Products
                                </a>
                                <a href="{{ route('categories.index') }}" 
                                   class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('categories.*') ? 'border-[#3abad4] text-[#3abad4]' : 'border-transparent text-gray-500 hover:text-[#3abad4] hover:border-[#12a4b7]' }} text-sm font-medium leading-5 transition duration-150 ease-in-out">
                                    Categories
                                </a>
                                <a href="{{ route('contact.create') }}" 
                                   class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('contact.*') ? 'border-[#3abad4] text-[#3abad4]' : 'border-transparent text-gray-500 hover:text-[#3abad4] hover:border-[#12a4b7]' }} text-sm font-medium leading-5 transition duration-150 ease-in-out">
                                    Contact
                                </a>
                            </div>
                        </div>

                        <!-- Settings Dropdown -->
                        <div class="hidden sm:flex sm:items-center sm:ml-6">
                            <!-- Search Box with Autocomplete -->
                            <div class="relative" x-data="{ 
                                searchQuery: '',
                                results: [],
                                loading: false,
                                open: false,
                                init() {
                                    this.$watch('searchQuery', (value) => {
                                        if (value.length > 2) {
                                            this.loading = true;
                                            this.open = true;
                                            fetch(`/api/products/autocomplete?query=${encodeURIComponent(value)}`)
                                                .then(response => response.json())
                                                .then(data => {
                                                    this.results = data;
                                                    this.loading = false;
                                                })
                                                .catch(error => {
                                                    console.error('Error fetching autocomplete:', error);
                                                    this.loading = false;
                                                });
                                        } else {
                                            this.open = false;
                                            this.results = [];
                                        }
                                    });
                                }
                            }">
                                <div>
                                    <div class="relative">
                                        <input 
                                            type="text" 
                                            x-model="searchQuery" 
                                            placeholder="Search products..." 
                                            class="border-gray-300 focus:border-[#3abad4] focus:ring focus:ring-[#e6f7fa] focus:ring-opacity-50 rounded-md shadow-sm pl-10 py-2 w-64"
                                            @focus="open = searchQuery.length > 2"
                                            @click.away="open = false">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <i class="fas fa-search text-gray-400"></i>
                                        </div>
                                    </div>
                                </div>

                                <!-- Results Dropdown -->
                                <div x-show="open && (results.length > 0 || loading)"
                                     x-transition:enter="transition ease-out duration-200"
                                     x-transition:enter-start="opacity-0 scale-95"
                                     x-transition:enter-end="opacity-100 scale-100"
                                     x-transition:leave="transition ease-in duration-75"
                                     x-transition:leave-start="opacity-100 scale-100"
                                     x-transition:leave-end="opacity-0 scale-95"
                                     class="absolute right-0 z-50 mt-2 w-96 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5"
                                     style="display: none;">
                                    <!-- Loading Indicator -->
                                    <div x-show="loading" class="p-4 text-center text-gray-500">
                                        <i class="fas fa-spinner fa-spin mr-2"></i> Loading...
                                    </div>
                                    
                                    <!-- Results List -->
                                    <div x-show="!loading && results.length > 0">
                                        <ul class="max-h-60 overflow-y-auto py-2">
                                            <template x-for="product in results" :key="product.id">
                                                <li>
                                                    <a :href="product.url" class="block px-4 py-2 hover:bg-gray-100 flex items-center">
                                                        <div class="flex-shrink-0 h-10 w-10 mr-3">
                                                            <img x-bind:src="product.image || 'https://via.placeholder.com/40x40'" 
                                                                 x-bind:alt="product.name"
                                                                 class="h-10 w-10 object-cover rounded-md">
                                                        </div>
                                                        <div>
                                                            <div class="text-sm font-medium text-gray-900" x-text="product.name"></div>
                                                            <div class="text-xs text-gray-500" x-text="product.category"></div>
                                                        </div>
                                                    </a>
                                                </li>
                                            </template>
                                        </ul>
                                        <div class="px-4 py-2 border-t border-gray-100">
                                            <a :href="`/products/search?query=${searchQuery}`" class="block text-center text-sm text-[#3abad4] hover:text-[#12a4b7]">
                                                See all results
                                            </a>
                                        </div>
                                    </div>
                                    
                                    <!-- No Results -->
                                    <div x-show="!loading && results.length === 0 && searchQuery.length > 2" class="p-4 text-center text-gray-500">
                                        No products found matching "<span x-text="searchQuery"></span>"
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Hamburger -->
                        <div class="-mr-2 flex items-center sm:hidden">
                            <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                                <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                    <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                                    <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Responsive Navigation Menu -->
                <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
                    <div class="pt-2 pb-3 space-y-1">
                        <a href="{{ route('home') }}" class="block pl-3 pr-4 py-2 border-l-4 {{ request()->routeIs('home') ? 'border-[#3abad4] text-[#3abad4] bg-[#e6f7fa]' : 'border-transparent text-gray-600 hover:text-[#3abad4] hover:bg-[#e6f7fa] hover:border-[#12a4b7]' }} text-base font-medium focus:outline-none focus:text-[#3abad4] focus:bg-[#e6f7fa] focus:border-[#12a4b7] transition duration-150 ease-in-out">
                            Home
                        </a>
                        <a href="{{ route('about') }}" class="block pl-3 pr-4 py-2 border-l-4 {{ request()->routeIs('about') ? 'border-[#3abad4] text-[#3abad4] bg-[#e6f7fa]' : 'border-transparent text-gray-600 hover:text-[#3abad4] hover:bg-[#e6f7fa] hover:border-[#12a4b7]' }} text-base font-medium focus:outline-none focus:text-[#3abad4] focus:bg-[#e6f7fa] focus:border-[#12a4b7] transition duration-150 ease-in-out">
                            About
                        </a>
                        <a href="{{ route('products.index') }}" class="block pl-3 pr-4 py-2 border-l-4 {{ request()->routeIs('products.*') ? 'border-[#3abad4] text-[#3abad4] bg-[#e6f7fa]' : 'border-transparent text-gray-600 hover:text-[#3abad4] hover:bg-[#e6f7fa] hover:border-[#12a4b7]' }} text-base font-medium focus:outline-none focus:text-[#3abad4] focus:bg-[#e6f7fa] focus:border-[#12a4b7] transition duration-150 ease-in-out">
                            Products
                        </a>
                        <a href="{{ route('categories.index') }}" class="block pl-3 pr-4 py-2 border-l-4 {{ request()->routeIs('categories.*') ? 'border-[#3abad4] text-[#3abad4] bg-[#e6f7fa]' : 'border-transparent text-gray-600 hover:text-[#3abad4] hover:bg-[#e6f7fa] hover:border-[#12a4b7]' }} text-base font-medium focus:outline-none focus:text-[#3abad4] focus:bg-[#e6f7fa] focus:border-[#12a4b7] transition duration-150 ease-in-out">
                            Categories
                        </a>
                        <a href="{{ route('contact.create') }}" class="block pl-3 pr-4 py-2 border-l-4 {{ request()->routeIs('contact.*') ? 'border-[#3abad4] text-[#3abad4] bg-[#e6f7fa]' : 'border-transparent text-gray-600 hover:text-[#3abad4] hover:bg-[#e6f7fa] hover:border-[#12a4b7]' }} text-base font-medium focus:outline-none focus:text-[#3abad4] focus:bg-[#e6f7fa] focus:border-[#12a4b7] transition duration-150 ease-in-out">
                            Contact
                        </a>
                    </div>

                    <!-- Responsive Settings Options -->
                    <!-- Admin options removed -->
                    
                    <!-- Mobile Search Bar -->
                    <div class="pt-4 pb-1 border-t border-gray-200 px-4">
                        <div class="relative" x-data="{ 
                            searchQueryMobile: '',
                            resultsMobile: [],
                            loadingMobile: false,
                            openMobile: false,
                            init() {
                                this.$watch('searchQueryMobile', (value) => {
                                    if (value.length > 2) {
                                        this.loadingMobile = true;
                                        this.openMobile = true;
                                        fetch(`/api/products/autocomplete?query=${encodeURIComponent(value)}`)
                                            .then(response => response.json())
                                            .then(data => {
                                                this.resultsMobile = data;
                                                this.loadingMobile = false;
                                            })
                                            .catch(error => {
                                                console.error('Error fetching autocomplete:', error);
                                                this.loadingMobile = false;
                                            });
                                    } else {
                                        this.openMobile = false;
                                        this.resultsMobile = [];
                                    }
                                });
                            }
                        }">
                            <div class="relative">
                                <input 
                                    type="text" 
                                    x-model="searchQueryMobile" 
                                    placeholder="Search products..." 
                                    class="w-full border-gray-300 focus:border-[#3abad4] focus:ring focus:ring-[#e6f7fa] focus:ring-opacity-50 rounded-md shadow-sm pl-10 py-2"
                                    @focus="openMobile = searchQueryMobile.length > 2"
                                    @click.away="openMobile = false">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-search text-gray-400"></i>
                                </div>
                            </div>

                            <!-- Mobile Results Dropdown -->
                            <div x-show="openMobile && (resultsMobile.length > 0 || loadingMobile)"
                                x-transition:enter="transition ease-out duration-200"
                                x-transition:enter-start="opacity-0"
                                x-transition:enter-end="opacity-100"
                                x-transition:leave="transition ease-in duration-75"
                                x-transition:leave-start="opacity-100"
                                x-transition:leave-end="opacity-0"
                                class="absolute left-0 right-0 z-50 mt-2 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5"
                                style="display: none;">
                                
                                <!-- Loading Indicator -->
                                <div x-show="loadingMobile" class="p-4 text-center text-gray-500">
                                    <i class="fas fa-spinner fa-spin mr-2"></i> Loading...
                                </div>
                                
                                <!-- Results List -->
                                <div x-show="!loadingMobile && resultsMobile.length > 0">
                                    <ul class="max-h-60 overflow-y-auto py-2">
                                        <template x-for="product in resultsMobile" :key="product.id">
                                            <li>
                                                <a :href="product.url" class="block px-4 py-2 hover:bg-gray-100 flex items-center">
                                                    <div class="flex-shrink-0 h-10 w-10 mr-3">
                                                        <img x-bind:src="product.image || 'https://via.placeholder.com/40x40'" 
                                                            x-bind:alt="product.name"
                                                            class="h-10 w-10 object-cover rounded-md">
                                                    </div>
                                                    <div>
                                                        <div class="text-sm font-medium text-gray-900" x-text="product.name"></div>
                                                        <div class="text-xs text-gray-500" x-text="product.category"></div>
                                                    </div>
                                                </a>
                                            </li>
                                        </template>
                                    </ul>
                                    <div class="px-4 py-2 border-t border-gray-100">
                                        <a :href="`/products/search?query=${searchQueryMobile}`" class="block text-center text-sm text-[#3abad4] hover:text-[#12a4b7]">
                                            See all results
                                        </a>
                                    </div>
                                </div>
                                
                                <!-- No Results -->
                                <div x-show="!loadingMobile && resultsMobile.length === 0 && searchQueryMobile.length > 2" class="p-4 text-center text-gray-500">
                                    No products found matching "<span x-text="searchQueryMobile"></span>"
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Flash Messages -->
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mt-1" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            @if(session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mt-1" role="alert">
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
            @endif

            <!-- Page Content -->
            <main class="py-2">
                @yield('content')
            </main>

            <!-- Footer -->
            <footer class="bg-white border-t border-gray-100 mt-4">
                <div class="max-w-full mx-auto py-4 px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between items-center">
                        <div class="flex items-center">
                            <img src="https://mihircsf.site/uploads/67fc1f41cb108_FinalLogoremovebgpreview.png" 
                                 alt="{{ config('app.name', 'Laravel') }}" 
                                 class="h-12 w-auto mr-4">
                            <p class="text-gray-500 text-sm">
                                © {{ date('Y') }} {{ config('app.name', 'Laravel') }}. All rights reserved.
                            </p>
                        </div>
                        <div class="flex items-center space-x-6">
                            <a href="#" class="text-gray-400 hover:text-[#3abad4]">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="#" class="text-gray-400 hover:text-[#3abad4]">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a href="#" class="text-gray-400 hover:text-[#3abad4]">
                                <i class="fab fa-instagram"></i>
                            </a>
                            <a href="#" class="text-gray-400 hover:text-[#3abad4]">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>

        <!-- WhatsApp Button -->
        <a href="https://wa.me/c/918200409960" target="_blank" class="whatsapp-button">
            <i class="fab fa-whatsapp"></i>
        </a>

        @stack('scripts')
    </body>
</html>
