@component('mail::message')
Dear {{ $recipient_name }},

Please click the button below to order your personalised samples.

{{ $optional_message }}

@component('mail::button', ['url' => route('token.store_to_session', $token)])
Visit the site
@endcomponent

Kind regards,

{{ env('SALESPERSON_FIRSTNAME') }} {{ env('SALESPERSON_SURNAME') }}

Email: [{{ env('SALESPERSON_EMAIL') }}](mailto:{{ env('SALESPERSON_EMAIL') }})<br>
Phone: {{ env('SALESPERSON_PHONE') }}

@endcomponent
