<div>
    @push('pagetitle', $product->name)

    <x-jet-banner />
    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h1 class="text-3xl mt-4 mb-8">{{ $product->name }}</h1>

            <div class="grid grid-cols-3 gap-8">
                <div>
                    @if(!$this->product->product_images->isEmpty())
                        <img src="{{ asset('storage/products/' . $main_product_image) }}" alt="{{ $product->name }}" class="w-full rounded mb-4">

                        @if($this->product->product_images->count() > 1)
                        <div class="grid grid-cols-3 gap-4">
                            @foreach($this->product->product_images as $product_image)
                                <img
                                    src="{{ asset('storage/products/' . $product_image->filename) }}"
                                    alt="{{ $product->name }} - {{ $product_image->sort_order }}"
                                    class="w-full rounded cursor-pointer"
                                    wire:click="$set('main_product_image', '{{ $product_image->filename }}')"
                                >
                            @endforeach
                        </div>
                        @endif
                    @endif
                </div>

                <div>
                    <div class="mb-4">
                        {!! $product->description !!}
                    </div>

                    <x-link-button href="{{ route('product.personaliser', $product) }}">Personalise Your {{ $product->name }}</x-link-button>
                </div>
            </div>

            <hr class="my-4">

            <x-back-link href="{{ route('home') }}">Return to the homepage</x-back-link>
        </div>
    </div>
</div>
