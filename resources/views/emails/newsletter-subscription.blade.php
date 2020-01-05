@component('mail::message')

    Newsletter subscription<br>
    Name: {{ $name }}<br>
    Phone: {{ $phone }}<br>
    @if (!empty($email))
        Email: {{ $email }}<br>
    @endif

@endcomponent