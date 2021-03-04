<div> 
    @push('pagetitle', 'Edit ' . $product->name)

    <x-jet-banner />
    
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            {{ __('Edit Product') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form wire:submit.prevent="update" method="POST">
                @csrf

                <div class="flex mb-4">
                    <div class="w-1/3 mr-8">
                        <h1 class="font-normal text-xl mb-3">Product Information</h1>
                        <p class="text-gray-700 text-sm mb-3">The name and information of the product.</p>
                        <p><x-link-button href="{{ route('product.show', $product) }}" class="px-3 py-2">View this product</x-link-button></p>
                    </div>

                    <div class="w-2/3 bg-white rounded p-4">
                        <div class="mb-4">
                            <label for="name" class="block font-semibold text-sm mb-2">Name</label>
                            <x-jet-input type="text" wire:model.debounce.500ms="name" name="name" class="w-full text-xl" />
                            @error('name') <div class="mt-3 text-sm text-red-500">{{ $message }}</div> @enderror
                        </div>
                        
                        <div class="mb-4">
                            <label for="sku" class="block font-semibold text-sm mb-2">SKU</label>
                            <x-jet-input type="text" wire:model.debounce.500ms="sku" name="sku" class="w-full" />
                            @error('sku') <div class="mt-3 text-sm text-red-500">{{ $message }}</div> @enderror
                        </div>
                        
                        <div class="mb-4">
                            <label for="description" class="block font-semibold text-sm mb-2">Description</label>
                            <x-textarea wire:model.debounce.500ms="description" name="description" class="w-full font-mono" rows="15" />
                            @error('description') <div class="mt-3 text-sm text-red-500">{{ $message }}</div> @enderror
                        </div>
                        
                        <div class="mb-4">
                            <label for="gateway_id" class="block font-semibold text-sm mb-2">Gateway ID</label>
                            <x-jet-input type="text" wire:model.debounce.500ms="gateway_id" name="gateway_id" class="w-full" />
                            @error('gateway_id') <div class="mt-3 text-sm text-red-500">{{ $message }}</div> @enderror
                        </div>
                        
                        <div class="mb-4">
                            <label for="gateway_dropship_id" class="block font-semibold text-sm mb-2">Gateway Dropship ID</label>
                            <x-jet-input type="text" wire:model.debounce.500ms="gateway_dropship_id" name="gateway_dropship_id" class="w-full" />
                            @error('gateway_dropship_id') <div class="mt-3 text-sm text-red-500">{{ $message }}</div> @enderror
                        </div>
                        
                        <div class="mb-4">
                            <label for="gateway_config" class="block font-semibold text-sm mb-2">Gateway Config</label>
                            <x-jet-input type="text" wire:model.debounce.500ms="gateway_config" name="gateway_config" class="w-full" />
                            @error('gateway_config') <div class="mt-3 text-sm text-red-500">{{ $message }}</div> @enderror
                        </div>
                    </div>
                </div>

                <div class="flex mb-4 justify-end">
                    <div class="w-2/3 pl-5">
                        <x-jet-button class="mb-4 w-full">Update Product</x-jet-button>
                    </div>
                </div>
            </form>
                
            <hr class="mb-4">

            <div class="flex mb-4">
                <div class="w-1/3 mr-8">
                    <h1 class="font-normal text-xl mb-3">Images</h1>
                    <p class="text-gray-700 text-sm">Images for this product.</p>
                </div>

                <div class="w-2/3 bg-white rounded p-4">
                    @if(!$product->product_images->isEmpty())
                        <h2 class="text-xl mb-4">Images</h2>

                        <form wire:submit.prevent="updateImageOrder" action="" method="POST">
                            <div id="product-images" class="grid grid-cols-4 gap-4 mb-4">
                                @foreach($product->product_images as $product_image)
                                    @livewire('product-image.edit', ['product' => $product, 'product_image' => $product_image], key('image-' . $product_image->id))
                                @endforeach
                            </div>

                            <input type="hidden" id="image-order" wire:model.defer="image_order" name="image_order">

                            <button type="submit" class="inline-block w-full text-center text-white text-lg bg-blue-600 px-4 py-3 mb-4 font-bold rounded hover:bg-blue-700">Update Image Order</button>
                        </form>

                        <hr class="mb-4">
                    @endif

                    <h2 class="text-xl mb-4">Add Image</h2>

                    @livewire('product-image.create', ['product' => $product])
                </div>
            </div>

            <hr class="my-4">

            <x-back-link href="{{ route('product.admin-index') }}">Back to Manage Products</x-back-link>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.13.0/Sortable.min.js"></script>
<script>
    var sortableElement = document.getElementById('product-images');
    var sortable = Sortable.create(sortableElement, {
        onEnd: function(evt){
            var order = sortable.toArray();
            order = JSON.stringify(order);
            document.getElementById('image-order').value = order;
            document.getElementById('image-order').dispatchEvent(new Event('input'));
        }
    });
</script>
