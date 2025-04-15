@component('mail::message')
# Thank you for contacting us, {{ $name }}!

We have received your message regarding "{{ $subject }}". Our team will review it and get back to you as soon as possible.

Here's a copy of your message:
{{ $message }}

Thank you for your interest in our products and services.

Best regards,<br>
{{ config('app.name') }}
@endcomponent 