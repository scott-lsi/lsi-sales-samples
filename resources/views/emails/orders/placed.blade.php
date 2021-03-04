@component('mail::message')
# New Samples Order Placed

A new order has been placed on your samples site by {{ $order->name }} at {{ $order->company }}.

@component('mail::button', ['url' => route('order.show', $order)])
Go to the order
@endcomponent

@endcomponent
