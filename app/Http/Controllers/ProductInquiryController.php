<?php

namespace App\Http\Controllers;

use App\Mail\AdminNotificationMail;
use App\Mail\ContactFormMail;
use App\Models\Inquiry;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ProductInquiryController extends Controller
{
    public function store(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'message' => 'required|string',
        ]);

        // Add product information to the data
        $data = array_merge($validated, [
            'subject' => "Inquiry about {$product->name}",
            'product_id' => $product->id,
            'product_name' => $product->name
        ]);

        // Save inquiry to database
        $inquiry = Inquiry::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'subject' => $data['subject'],
            'message' => $validated['message'],
            'product_id' => $product->id,
            'type' => 'product',
            'status' => 'new'
        ]);

        // Send email to user
        Mail::to($validated['email'])->send(new ContactFormMail($data));

        // Send email to admin
        Mail::to(config('mail.admin_address'))->send(new AdminNotificationMail($data));

        return redirect()
            ->back()
            ->with('success', 'Thank you for your inquiry! We will get back to you soon.');
    }
} 