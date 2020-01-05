@component('mail::message')

    Consultation requested<br>
    Name: {{ $name }}<br>
    Phone: {{ $phone }}<br>
    Message: {{ $message_body }}<br>

@endcomponent