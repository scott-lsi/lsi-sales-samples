@component('mail::message')
Dear {{ $recipient_name }},

Please click the button below to order your personalised samples.

{{ $optional_message }}

@component('mail::button', ['url' => route('token.store_to_session', $token)])
Visit the site
@endcomponent

Kind regards,

{{ env('SALESPERSON_FIRSTNAME') }} {{ env('SALESPERSON_SURNAME') }}<br>
{{ env('SALESPERSON_JOBTITLE') }}<br>
DDi: {{ env('SALESPERSON_PHONE') }}<br>
Main: 01274 852598<br>
E-Mail: [{{ env('SALESPERSON_EMAIL') }}](mailto:{{ env('SALESPERSON_EMAIL') }})

@endcomponent
