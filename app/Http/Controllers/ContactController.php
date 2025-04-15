<?php

namespace App\Http\Controllers;

use App\Mail\AdminNotificationMail;
use App\Mail\ContactFormMail;
use App\Models\Inquiry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class ContactController extends Controller
{
    public function create(): View
    {
        return view('contact.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'subject' => 'required|string|max:255',
            'message' => 'required|string'
        ]);

        // Save inquiry to database
        $inquiry = Inquiry::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'] ?? null,
            'message' => $validated['message'],
            'subject' => $validated['subject'] ?? null,
            'product_id' => null
        ]);

        // Send email to user
        Mail::to($validated['email'])->send(new ContactFormMail($validated));

        // Send email to admin
        Mail::to(config('mail.admin_address'))->send(new AdminNotificationMail($validated));

        return redirect()
            ->route('contact.create')
            ->with('success', 'Thank you for contacting us! We will get back to you soon.');
    }
}
