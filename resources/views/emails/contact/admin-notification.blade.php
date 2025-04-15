@component('mail::message')
# New Contact Form Submission

You have received a new message from the contact form.

**Name:** {{ $name }}
**Email:** {{ $email }}
**Phone:** {{ $phone ?? 'Not provided' }}
**Subject:** {{ $subject }}

**Message:**
{{ $message }}

@component('mail::button', ['url' => route('admin.inquiries.index')])
View All Inquiries
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent 