<div>
    @push('pagetitle', 'Manage Order ' . $order->name . ' at ' . $order->company)

    <x-jet-banner />

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="lg:grid lg:grid-cols-4 lg:gap-8">
                <div class="col-span-3">
                    <h1 class="text-3xl mt-4 mb-8">Items</h1>

                    <div class="grid grid-cols-3 gap-4">
                        @foreach($order->basket_content as $row)
                            <div class="col-span-1 border rounded bg-white">
                                <img src="{{ $row->options->imageurl }}" class="w-full">
                                <div class="text-center font-bold my-4">{{ $row->qty }} x {{ $row->name }}</div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div>
                    <h1 class="text-3xl mt-4 mb-8">Details</h1>

                    <dl class="mb-8">
                        <dt class="font-bold">Name</dt>
                        <dd class="mb-4">{{ $order->name }}</dd>
                        
                        <dt class="font-bold">Company</dt>
                        <dd class="mb-4">{{ $order->company }}</dd>
                        
                        @if($order->phone)
                            <dt class="font-bold">Phone</dt>
                            <dd class="mb-4">{{ $order->phone }}</dd>
                        @endif
                        
                        <dt class="font-bold">Delivery Address</dt>
                        <dd class="mb-4">
                            {{ $order->address_line_1 }}<br>
                            @if($order->address_line_2){{ $order->address_line_2 }}<br>@endif
                            {{ $order->address_town }}<br>
                            @if($order->address_county){{ $order->address_county }}<br>@endif
                            {{ $order->address_postcode }}
                        </dd>
                    </dl>

                    @if(!$order->submitted_to_gateway)
                        <x-link-button wire:click="submit">Submit Order to Gateway</x-link-button>
                    @else
                        <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 405.272 405.272" class="w-4 mr-2 inline-block" xml:space="preserve">
                            <path d="M393.401,124.425L179.603,338.208c-15.832,15.835-41.514,15.835-57.361,0L11.878,227.836
                                c-15.838-15.835-15.838-41.52,0-57.358c15.841-15.841,41.521-15.841,57.355-0.006l81.698,81.699L336.037,67.064
                                c15.841-15.841,41.523-15.829,57.358,0C409.23,82.902,409.23,108.578,393.401,124.425z"/>
                        </svg>
                        Order has been submitted!
                    @endif
                </div>
            </div>

            <hr class="my-4">

            <x-back-link href="{{ route('order.admin-index') }}">Back to Manage Orders</x-back-link>
        </div>
    </div>
</div>
