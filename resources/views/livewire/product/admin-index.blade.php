<div>
    @push('pagetitle', 'Manage Products')
    
    <x-jet-banner />
    
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            {{ __('Manage Products') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h1 class="text-3xl mb-4">{{ $tableTitle }}</h1>

            <table class="w-full table-auto mb-4">
                <thead>
                    <tr class="border-b">
                        <th class="py-4 text-left">Image</th>
                        <th class="py-4 text-left">Name</th>
                        <th class="py-4 text-left">SKU</th>
                        <th class="py-4 text-left">Functions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                        <tr class="border-b">
                            <td class="py-4"><img src="{{ asset('storage/products/' . $product->main_product_image) }}" class="w-24"></td>
                            <td class="py-4">
                                <a href="{{ route('product.show', $product) }}">{{ $product->name }}</a>
                            </td>
                            <td class="py-4">{{ $product->sku }}</td>
                            <td class="py-4">
                                @if(!$product->trashed())
                                <x-link-button href="{{ route('product.edit', $product) }}" class="mr-4">Edit Product</x-link-button>
                                <x-link-danger-button wire:click="delete({{ $product->id }})">Delete Product</x-link-danger-button>
                                @else
                                <x-link-success-button wire:click="restore({{ $product->id }})" class="mr-4">Restore Product</x-link-success-button>
                                <x-link-danger-button wire:click="destroy({{ $product->id }})">Permanently Delete Product</x-link-danger-button>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <p class="mb-4">
                <x-link-button wire:click="currentProducts" class="mr-4">Show current products</x-link-button>
                <x-link-button wire:click="deletedProducts">Show deleted products</x-link-button>
            </p>

            <hr class="mb-4">
            
            <p>
                <x-link-button href="{{ route('product.create') }}">Create Product</x-link-button>
            </p>
        </div>
    </div>
</div>
