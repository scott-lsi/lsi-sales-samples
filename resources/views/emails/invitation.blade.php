@component('mail::message')
Hi {{ $recipient_name }},

Hope you are well! I know you will get loads of emails trying to sell you merchandise and branded items and yes the majority of merchandise suppliers are the same. However, we are different... No really, we are!

{{ $optional_message }}

@component('mail::button', ['url' => route('token.store_to_session', $token)])
Let me prove it!
@endcomponent

Kind regards,

{{ env('SALESPERSON_FIRSTNAME') }} {{ env('SALESPERSON_SURNAME') }}<br>
{{ env('SALESPERSON_JOBTITLE') }}<br>
DDi: {{ env('SALESPERSON_PHONE') }}<br>
Main: 01274 852598<br>
E-Mail: [{{ env('SALESPERSON_EMAIL') }}](mailto:{{ env('SALESPERSON_EMAIL') }})

@endcomponent
