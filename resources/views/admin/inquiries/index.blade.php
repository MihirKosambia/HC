@extends('layouts.admin')

@section('title', 'Product Inquiries')

@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-bold">Product Inquiries</h1>
</div>

<div class="bg-white rounded-lg shadow">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead>
                <tr>
                    <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Product</th>
                    <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                    <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                    <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Phone</th>
                    <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                    <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($inquiries as $inquiry)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            @if($inquiry->product && $inquiry->product->images->first())
                                <img src="{{ asset('storage/' . $inquiry->product->images->first()->image_path) }}" 
                                     alt="{{ $inquiry->product->name }}" 
                                     class="h-10 w-10 object-cover rounded mr-3">
                            @endif
                            <div class="text-sm font-medium text-gray-900">
                                {{ $inquiry->product ? $inquiry->product->name : 'N/A' }}
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-gray-900">{{ $inquiry->name }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900">{{ $inquiry->email }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900">{{ $inquiry->phone }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        {{ $inquiry->created_at->format('M d, Y H:i') }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <div class="flex space-x-3">
                            <a href="{{ route('admin.inquiries.show', $inquiry) }}" class="text-blue-600 hover:text-blue-900">View</a>
                            <form action="{{ route('admin.inquiries.destroy', $inquiry) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Are you sure you want to delete this inquiry?')">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    
    @if($inquiries->hasPages())
    <div class="px-6 py-4 border-t">
        {{ $inquiries->links() }}
    </div>
    @endif
</div>

<!-- Inquiry Details Modal -->
<div id="inquiryModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full">
    <div class="relative top-20 mx-auto p-5 border w-3/4 shadow-lg rounded-md bg-white">
        <div class="flex justify-between items-center pb-3">
            <h3 class="text-xl font-bold">Inquiry Details</h3>
            <button onclick="closeModal()" class="text-gray-400 hover:text-gray-500">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        <div id="modalContent" class="mt-4">
            <!-- Content will be loaded here -->
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
function showInquiry(id) {
    const modal = document.getElementById('inquiryModal');
    const content = document.getElementById('modalContent');
    
    // Show modal
    modal.classList.remove('hidden');
    
    // Load content
    fetch(`/admin/inquiries/${id}`)
        .then(response => response.text())
        .then(html => {
            content.innerHTML = html;
        });
}

function closeModal() {
    const modal = document.getElementById('inquiryModal');
    modal.classList.add('hidden');
}
</script>
@endpush 