<div> 
    @push('pagetitle', 'Create Product')

    <x-jet-banner />
    
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            {{ __('Create Product') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form wire:submit.prevent="create" method="POST">
                @csrf

                <div class="flex mb-4">
                    <div class="w-1/3 mr-8">
                        <h1 class="font-normal text-xl mb-3">Product Information</h1>
                        <p class="text-gray-700 text-sm mb-3">The name and information of the new product.</p>
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
                        <x-jet-button class="mb-4 w-full">Create Product</x-jet-button>
                    </div>
                </div>
            </form>

            <hr class="my-4">

            <x-back-link href="{{ route('product.admin-index') }}">Back to Manage Products</x-back-link>
        </div>
    </div>
</div>
