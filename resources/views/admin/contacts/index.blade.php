@extends('layouts.admin')

@section('title', 'Contact Messages')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-900">Contact Messages</h1>
    </div>

    @if($contacts->count() > 0)
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead>
                <tr class="bg-gray-50">
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Subject</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($contacts as $contact)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $contact->name }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $contact->email }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $contact->subject }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $contact->created_at->format('M d, Y') }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                        <div class="flex space-x-3">
                            <a href="{{ route('admin.contacts.show', $contact) }}" class="text-indigo-600 hover:text-indigo-900">View</a>
                            <form action="{{ route('admin.contacts.destroy', $contact) }}" method="POST" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Are you sure you want to delete this message?')">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $contacts->links() }}
    </div>
    @else
    <div class="bg-white rounded-lg shadow-sm p-6 text-center">
        <p class="text-gray-500">No contact messages found.</p>
    </div>
    @endif
</div>

<!-- Message Modal -->
<div id="messageModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full">
    <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-2/3 lg:w-1/2 shadow-lg rounded-md bg-white">
        <div class="flex flex-col space-y-4">
            <div class="flex justify-between items-center pb-3">
                <p class="text-2xl font-bold">Message Details</p>
                <button onclick="closeModal()" class="text-gray-400 hover:text-gray-500">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            <div id="messageContent" class="space-y-4">
                <!-- Content will be loaded here -->
            </div>
            <div class="flex justify-end pt-2">
                <button onclick="closeModal()" class="px-4 py-2 bg-gray-500 text-white text-base font-medium rounded-md shadow-sm hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-300">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    function showMessage(id) {
        fetch(`/admin/contacts/${id}`)
            .then(response => response.json())
            .then(data => {
                document.getElementById('messageContent').innerHTML = `
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Name</p>
                            <p class="mt-1 text-sm text-gray-900">${data.name}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Email</p>
                            <p class="mt-1 text-sm text-gray-900">${data.email}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Phone</p>
                            <p class="mt-1 text-sm text-gray-900">${data.phone}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Date</p>
                            <p class="mt-1 text-sm text-gray-900">${new Date(data.created_at).toLocaleString()}</p>
                        </div>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Subject</p>
                        <p class="mt-1 text-sm text-gray-900">${data.subject}</p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Message</p>
                        <p class="mt-1 text-sm text-gray-900">${data.message}</p>
                    </div>
                `;
                document.getElementById('messageModal').classList.remove('hidden');
            });
    }

    function closeModal() {
        document.getElementById('messageModal').classList.add('hidden');
    }

    // Close modal when clicking outside
    document.getElementById('messageModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeModal();
        }
    });
</script>
@endpush
@endsection 