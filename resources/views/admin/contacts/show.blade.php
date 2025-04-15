@extends('layouts.admin')

@section('title', 'View Contact Message')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="mb-6">
        <a href="{{ route('admin.contacts.index') }}" class="text-indigo-600 hover:text-indigo-900">
            ← Back to Contact Messages
        </a>
    </div>

    <div class="bg-white rounded-lg shadow-sm overflow-hidden">
        <div class="p-6">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Contact Message Details</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Name</label>
                        <p class="mt-1 text-lg">{{ $contact->name }}</p>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Email</label>
                        <p class="mt-1 text-lg">{{ $contact->email }}</p>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Subject</label>
                        <p class="mt-1 text-lg">{{ $contact->subject }}</p>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Date Received</label>
                        <p class="mt-1 text-lg">{{ $contact->created_at->format('M d, Y h:i A') }}</p>
                    </div>
                </div>

                <div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Message</label>
                        <p class="mt-1 text-lg whitespace-pre-wrap">{{ $contact->message }}</p>
                    </div>
                </div>
            </div>

            <div class="mt-6 border-t pt-6">
                <form action="{{ route('admin.contacts.destroy', $contact) }}" method="POST" class="inline-block">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-md hover:bg-red-700" onclick="return confirm('Are you sure you want to delete this message?')">
                        Delete Message
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection 