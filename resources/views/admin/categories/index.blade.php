@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white rounded-xl shadow-sm overflow-hidden">
        <div class="p-6 border-b">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                <h1 class="text-2xl font-bold text-gray-900 mb-4 md:mb-0">
                    <i class="fas fa-th-large mr-2 text-blue-600"></i>
                    Manage Categories
                </h1>
                <div class="flex flex-col sm:flex-row gap-4">
                    <a href="{{ route('admin.categories.create') }}" class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 text-sm font-medium text-white rounded-lg shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors duration-150">
                        <i class="fas fa-plus mr-2"></i>
                        Add New Category
                    </a>
                </div>
            </div>
        </div>

        <div class="p-6">
            <!-- Search and Filter -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                <div class="relative">
                    <input type="text" 
                           id="search" 
                           placeholder="Search categories..." 
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm">
                    <i class="fas fa-search absolute right-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                </div>
                <div>
                    <select id="status_filter" 
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm">
                        <option value="">All Status</option>
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>
                </div>
            </div>

            <!-- Categories Table -->
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Category</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Products</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200" id="categories_table">
                        @forelse($categories as $category)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10 bg-blue-100 rounded-lg flex items-center justify-center">
                                            <i class="fas fa-folder text-blue-600 text-lg"></i>
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">{{ $category->name }}</div>
                                            <div class="text-sm text-gray-500">{{ Str::limit($category->description, 50) }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                        {{ $category->products_count }} Products
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $category->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                        {{ $category->is_active ? 'Active' : 'Inactive' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <div class="flex items-center justify-end space-x-3">
                                        <a href="{{ route('admin.categories.edit', $category->id) }}" 
                                           class="text-blue-600 hover:text-blue-900">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.categories.destroy', $category->id) }}" 
                                              method="POST" 
                                              class="inline-block"
                                              onsubmit="return confirm('Are you sure you want to delete this category?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-4 text-center text-gray-500">
                                    <div class="flex flex-col items-center justify-center py-8">
                                        <i class="fas fa-folder-open text-4xl text-gray-400 mb-4"></i>
                                        <p class="text-lg font-medium">No categories found</p>
                                        <p class="text-sm text-gray-500">Try adjusting your search or filter to find what you're looking for.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="mt-6">
                {{ $categories->links() }}
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('search');
    const statusFilter = document.getElementById('status_filter');
    const categoriesTable = document.getElementById('categories_table');

    function filterCategories() {
        const searchTerm = searchInput.value.toLowerCase();
        const status = statusFilter.value;

        const rows = categoriesTable.getElementsByTagName('tr');
        let hasVisibleRows = false;

        for (let row of rows) {
            if (row.querySelector('td')) { // Skip header row
                const categoryName = row.querySelector('.text-gray-900').textContent.toLowerCase();
                const categoryStatus = row.querySelector('[class*="rounded-full"]').textContent.trim() === 'Active' ? '1' : '0';

                const matchesSearch = categoryName.includes(searchTerm);
                const matchesStatus = !status || categoryStatus === status;

                if (matchesSearch && matchesStatus) {
                    row.style.display = '';
                    hasVisibleRows = true;
                } else {
                    row.style.display = 'none';
                }
            }
        }

        // Show or hide the "No categories found" message
        const noCategoriesRow = document.querySelector('tr[data-empty-message]');
        if (noCategoriesRow) {
            noCategoriesRow.style.display = hasVisibleRows ? 'none' : '';
        }
    }

    searchInput.addEventListener('input', filterCategories);
    statusFilter.addEventListener('change', filterCategories);
});
</script>
@endsection 