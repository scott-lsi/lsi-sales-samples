@component('mail::message')
Hi {{ $recipient_name }},

Hope you are well! I know you will get hundreds of emails trying to sell you merchandise and branded items but we are different... No really, we are!

{{ $optional_message }}

@component('mail::button', ['url' => route('token.store_to_session', $token)])
Click here, claim now...
@endcomponent

Kind regards,

{{ env('SALESPERSON_FIRSTNAME') }} {{ env('SALESPERSON_SURNAME') }}<br>
{{ env('SALESPERSON_JOBTITLE') }}<br>
DDi: {{ env('SALESPERSON_PHONE') }}<br>
Main: 01274 852598<br>
E-Mail: [{{ env('SALESPERSON_EMAIL') }}](mailto:{{ env('SALESPERSON_EMAIL') }})

@endcomponent
