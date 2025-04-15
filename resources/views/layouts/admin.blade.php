<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Admin Panel - {{ config('app.name', 'HealthCare Diagnostics') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    <style>
        [x-cloak] { display: none !important; }
        body { font-family: 'Inter', sans-serif; }
        :root {
            --primary-color: #00A4B8;
            --primary-dark: #008999;
            --primary-light: #E6F7F9;
        }
    </style>
    @stack('styles')
</head>
<body class="min-h-screen bg-gray-50">
    <div class="flex h-screen bg-gray-50">
        <!-- Sidebar -->
        <div class="hidden md:flex md:flex-shrink-0">
            <div class="flex flex-col w-64 border-r bg-white">
                <div class="flex items-center h-16 px-4 border-b bg-white">
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center">
                        <img src="/images/logo.png" alt="HealthCare Diagnostics" class="h-8">
                    </a>
                </div>
                <div class="flex-1 overflow-y-auto">
                    <nav class="px-2 py-4 space-y-1">
                        <a href="{{ route('admin.dashboard') }}" 
                           class="flex items-center px-4 py-2 text-sm font-medium {{ request()->routeIs('admin.dashboard') ? 'text-[#00A4B8] bg-[#E6F7F9] rounded-lg' : 'text-gray-600 hover:text-[#00A4B8] hover:bg-[#E6F7F9] rounded-lg' }}">
                            <i class="fas fa-home w-5 h-5 mr-3"></i>
                            Dashboard
                        </a>
                        <a href="{{ route('admin.products.index') }}" 
                           class="flex items-center px-4 py-2 text-sm font-medium {{ request()->routeIs('admin.products.*') ? 'text-[#00A4B8] bg-[#E6F7F9] rounded-lg' : 'text-gray-600 hover:text-[#00A4B8] hover:bg-[#E6F7F9] rounded-lg' }}">
                            <i class="fas fa-box w-5 h-5 mr-3"></i>
                            Products
                        </a>
                        <a href="{{ route('admin.categories.index') }}" 
                           class="flex items-center px-4 py-2 text-sm font-medium {{ request()->routeIs('admin.categories.*') ? 'text-blue-600 bg-blue-50 rounded-lg' : 'text-gray-600 hover:text-blue-600 hover:bg-blue-50 rounded-lg' }}">
                            <i class="fas fa-th-large w-5 h-5 mr-3"></i>
                            Categories
                        </a>
                        <a href="{{ route('admin.banners.index') }}" 
                           class="flex items-center px-4 py-2 text-sm font-medium {{ request()->routeIs('admin.banners.*') ? 'text-blue-600 bg-blue-50 rounded-lg' : 'text-gray-600 hover:text-blue-600 hover:bg-blue-50 rounded-lg' }}">
                            <i class="fas fa-images w-5 h-5 mr-3"></i>
                            Banners
                        </a>
                        <a href="{{ route('admin.inquiries.index') }}" 
                           class="flex items-center px-4 py-2 text-sm font-medium {{ request()->routeIs('admin.inquiries.*') ? 'text-blue-600 bg-blue-50 rounded-lg' : 'text-gray-600 hover:text-blue-600 hover:bg-blue-50 rounded-lg' }}">
                            <i class="fas fa-envelope w-5 h-5 mr-3"></i>
                            Inquiries
                        </a>
                    </nav>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Top Navigation -->
            <header class="bg-white shadow-sm">
                <div class="flex items-center justify-between h-16 px-4">
                    <!-- Mobile Menu Button -->
                    <button class="md:hidden text-gray-600 hover:text-blue-600 focus:outline-none" 
                            x-data="{ open: false }"
                            @click="open = !open"
                            aria-label="Toggle menu">
                        <i class="fas fa-bars text-xl"></i>
                    </button>

                    <!-- Right Side Navigation -->
                    <div class="flex items-center space-x-4">
                        <a href="{{ route('home') }}" 
                           class="text-gray-600 hover:text-blue-600"
                           title="View Website">
                            <i class="fas fa-external-link-alt"></i>
                        </a>
                        <div class="relative" x-data="{ open: false }">
                            <button @click="open = !open" 
                                    class="flex items-center text-gray-600 hover:text-blue-600 focus:outline-none">
                                <img src="https://ui-avatars.com/api/?name=Admin&background=3B82F6&color=fff" 
                                     alt="Admin" 
                                     class="h-8 w-8 rounded-full">
                            </button>
                            <div x-show="open"
                                 x-transition:enter="transition ease-out duration-100"
                                 x-transition:enter-start="transform opacity-0 scale-95"
                                 x-transition:enter-end="transform opacity-100 scale-100"
                                 x-transition:leave="transition ease-in duration-75"
                                 x-transition:leave-start="transform opacity-100 scale-100"
                                 x-transition:leave-end="transform opacity-0 scale-95"
                                 class="absolute right-0 mt-2 w-48 rounded-lg shadow-lg bg-white ring-1 ring-black ring-opacity-5"
                                 x-cloak>
                                <div class="py-1">
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" 
                                                class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                            Logout
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-50">
                @yield('content')
            </main>
        </div>
    </div>

    <script src="//unpkg.com/alpinejs" defer></script>
    @stack('scripts')
</body>
</html> 