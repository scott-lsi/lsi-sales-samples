<div> 
    @push('pagetitle', 'Manage Orders')

    <x-jet-banner />
    
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            {{ __('Manage Orders') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h1 class="text-3xl mb-4">{{ $tableTitle }}</h1>

            <table class="w-full table-auto mb-4">
                <thead>
                    <tr class="border-b">
                        <th class="py-4 text-left">Customer</th>
                        <th class="py-4 text-left">Sent to Gateway</th>
                        <th class="py-4 text-left">Order Placed</th>
                        <th class="py-4 text-left">Order Last Updated</th>
                        <th class="py-4 text-left">Functions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                        <tr class="border-b">
                            <td class="py-4">
                                <a href="{{ route('order.show', $order) }}">{{ $order->name }} ({{ $order->company }})</a>
                            </td>
                            <td class="py-4">
                                @if($order->submitted_to_gateway)
                                    <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 405.272 405.272" class="w-4 mr-2 inline-block" xml:space="preserve">
                                        <path d="M393.401,124.425L179.603,338.208c-15.832,15.835-41.514,15.835-57.361,0L11.878,227.836
                                            c-15.838-15.835-15.838-41.52,0-57.358c15.841-15.841,41.521-15.841,57.355-0.006l81.698,81.699L336.037,67.064
                                            c15.841-15.841,41.523-15.829,57.358,0C409.23,82.902,409.23,108.578,393.401,124.425z"/>
                                    </svg>
                                @else
                                    <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 348.333 348.334"  class="w-4 mr-2 inline-block" xml:space="preserve">
                                        <path d="M336.559,68.611L231.016,174.165l105.543,105.549c15.699,15.705,15.699,41.145,0,56.85
                                            c-7.844,7.844-18.128,11.769-28.407,11.769c-10.296,0-20.581-3.919-28.419-11.769L174.167,231.003L68.609,336.563
                                            c-7.843,7.844-18.128,11.769-28.416,11.769c-10.285,0-20.563-3.919-28.413-11.769c-15.699-15.698-15.699-41.139,0-56.85
                                            l105.54-105.549L11.774,68.611c-15.699-15.699-15.699-41.145,0-56.844c15.696-15.687,41.127-15.687,56.829,0l105.563,105.554
                                            L279.721,11.767c15.705-15.687,41.139-15.687,56.832,0C352.258,27.466,352.258,52.912,336.559,68.611z"/>
                                    </svg>
                                @endif
                            </td>
                            <td class="py-4">{{ $order->created_at->format('jS F Y, H:i:s') }}</td>
                            <td class="py-4">
                                @if($order->created_at != $order->updated_at)
                                    {{ $order->updated_at->format('jS F Y, H:i:s') }}
                                @else
                                    Never Updated
                                @endif
                            </td>
                            <td class="py-4">
                                @if(!$order->trashed())
                                    <x-link-button href="{{ route('order.show', $order) }}" class="mr-4">View Order</x-link-button>
                                    @if(!$order->submitted_to_gateway)
                                        <x-link-danger-button wire:click="delete({{ $order->id }})">Delete Order</x-link-danger-button>
                                    @endif
                                @else
                                    <x-link-success-button wire:click="restore({{ $order->id }})" class="mr-4">Restore Order</x-link-success-button>
                                    <x-link-danger-button wire:click="destroy({{ $order->id }})">Permanently Delete Order</x-link-danger-button>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <p class="mb-4">
                <x-link-button wire:click="allOrders" class="mr-4">Show all orders</x-link-button>
                <x-link-button wire:click="unsubmittedOrders" class="mr-4">Show unsubmitted orders</x-link-button>
                <x-link-button wire:click="submittedOrders" class="mr-4">Show submitted orders</x-link-button>
                <x-link-button wire:click="deletedOrders">Show deleted orders</x-link-button>
            </p>
        </div>
    </div>
</div>
