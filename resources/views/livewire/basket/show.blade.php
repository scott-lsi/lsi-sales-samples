<div>
    @push('pagetitle', 'Basket')

    <x-jet-banner />

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(!$thanks)
                @if(!empty($basket))
                    <div class="lg:grid lg:grid-cols-4 lg:gap-8">
                        <div class="col-span-3">
                            <h1 class="text-3xl mt-4 mb-8">Basket</h1>

                            <table class="w-full mb-4">
                                <thead>
                                    <tr class="border-b border-gray-200">
                                        <th class="text-left py-2">Image</th>
                                        <th class="text-left py-2">Product</th>
                                        <th class="text-left py-2">Quantity</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($basket as $row)
                                        @livewire('basket.row', ['row' => $row], key('row-' . $row['rowId']))
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div>
                            <h1 class="text-3xl mt-4 mb-8">Your details</h1>

                            <x-info-box class="mb-4">* denotes a required field</x-info-box>

                            <form wire:submit.prevent="submit" method="POST">
                                <div class="mb-4">
                                    <x-jet-label for="name" class="font-semibold mb-2">Name *</x-jet-label>
                                    <x-jet-input id="name" type="text" wire:model.debounce.500ms="name" name="name" class="w-full" />
                                    <x-jet-input-error for="name" class="mt-2" />
                                </div>

                                <div class="mb-4">
                                    <x-jet-label for="company" class="font-semibold mb-2">Company *</x-jet-label>
                                    <x-jet-input id="company" type="text" wire:model.debounce.500ms="company" name="company" class="w-full" />
                                    <x-jet-input-error for="company" class="mt-2" />
                                </div>

                                <div class="mb-4">
                                    <x-jet-label for="phone" class="font-semibold mb-2">Phone</x-jet-label>
                                    <x-jet-input id="phone" type="text" wire:model.debounce.500ms="phone" name="phone" class="w-full" />
                                    <x-jet-input-error for="phone" class="mt-2" />
                                </div>

                                <div class="mb-4">
                                    <x-jet-label for="address_line_1" class="font-semibold mb-2">Delivery Address Line 1 *</x-jet-label>
                                    <x-jet-input id="address_line_1" type="text" wire:model.debounce.500ms="address_line_1" name="address_line_1" class="w-full" />
                                    <x-jet-input-error for="address_line_1" class="mt-2" />
                                </div>

                                <div class="mb-4">
                                    <x-jet-label for="address_line_2" class="font-semibold mb-2">Delivery Address Line 2</x-jet-label>
                                    <x-jet-input id="address_line_2" type="text" wire:model.debounce.500ms="address_line_2" name="address_line_2" class="w-full" />
                                </div>

                                <div class="mb-4">
                                    <x-jet-label for="address_town" class="font-semibold mb-2">Delivery Town/City *</x-jet-label>
                                    <x-jet-input id="address_town" type="text" wire:model.debounce.500ms="address_town" name="address_town" class="w-full" />
                                    <x-jet-input-error for="address_town" class="mt-2" />
                                </div>

                                <div class="mb-4">
                                    <x-jet-label for="address_county" class="font-semibold mb-2">Delivery County</x-jet-label>
                                    <x-jet-input id="address_county" type="text" wire:model.debounce.500ms="address_county" name="address_county" class="w-full" />
                                    <x-jet-input-error for="address_county" class="mt-2" />
                                </div>

                                <div class="mb-4">
                                    <x-jet-label for="address_postcode" class="font-semibold mb-2">Delivery Postcode *</x-jet-label>
                                    <x-jet-input id="address_postcode" type="text" wire:model.debounce.500ms="address_postcode" name="address_postcode" class="w-full" />
                                    <x-jet-input-error for="address_postcode" class="mt-2" />
                                </div>

                                <x-jet-button class="w-full">Submit</x-jet-button>
                            </form>
                        </div>
                    </div>
                @else
                    <h1 class="text-3xl mt-4 mb-8">Basket</h1>

                    <x-info-box>Your basket is empty</x-info-box>
                @endif
            @else
                <h1 class="text-3xl mt-4 mb-8">Thank You!</h1>

                <p class="my-8">How easy was that? I'll get this sent out for you in the next few days and be in touch to make sure you got it.</p>

                <hr class="mb-8">

                <h2 class="text-2xl mb-8">What we do</h2>

                <p class="text-xl mb-4">The reason I want to physically send something out for you is to try and show how we are different from the rest!</p>
                <p class="text-xl mb-4">We are not just a catalogue or an online site... we are real people who you can have a real conversation with and love a real cuppa!</p>
                <p class="text-xl mb-4">We offer so much more than just branded items, here's a few links to what we are all about</p>

                <a href="https://www.lsi.co.uk"><img src="{{ asset('images/heroes.jpg') }}" alt="LSi Promotional Heroes"></a>

                <div class="my-8 md:grid grid-cols-5">
                    <div class="mb-4">
                        <a href="https://www.lsi.co.uk/category/promotional-merchandise" class="block">
                            <img src="{{ asset('images/logos/pm.png') }}" alt="Promotional Merchandise" class="w-auto h-24 mx-auto">
                        </a>
                    </div>

                    
                    <div class="mb-4">
                        <a href="https://www.lsi.co.uk/category/corporate-clothing" class="block">
                            <img src="{{ asset('images/logos/cc.png') }}" alt="Corporate Clothing" class="w-auto h-24 mx-auto">
                        </a>
                    </div>

                    
                    <div class="mb-4">
                        <a href="https://www.lsi.co.uk/category/eco-friendly-products" class="block">
                            <img src="{{ asset('images/logos/eco.png') }}" alt="Eco Friendly Products" class="w-auto h-24 mx-auto">
                        </a>
                    </div>

                    
                    <div class="mb-4">
                        <a href="https://www.lsi.co.uk/far-east-sourcing" class="block">
                            <img src="{{ asset('images/logos/fes.png') }}" alt="Fer east Sourcing" class="w-auto h-24 mx-auto">
                        </a>
                    </div>

                    
                    <div class="mb-4">
                        <a href="https://www.lsi.co.uk/corporate-schemes" class="block">
                            <img src="{{ asset('images/logos/cs.png') }}" alt="Corporate Schemes" class="w-auto h-24 mx-auto">
                        </a>
                    </div>
                </div>

                <p class="mb-4 text-center"><a href="https://www.lsi.co.uk/news/storage-fulfilment-distribution-feb21" class="block text-white rounded px-8 py-4 text-xl bg-pink-600 hover:bg-pink-700">Read our article on Storage, Fulfilment &amp; Distribution</a></p>
            @endif
        </div>
    </div>
</div>
