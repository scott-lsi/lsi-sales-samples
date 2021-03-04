<div>
    <form enctype="multipart/form-data" wire:submit.prevent="create({{ $product->id }})">
        <x-jet-input type="file" name="image" wire:model="image" class="mb-4" />
        <x-jet-button type="submit">Upload Image</x-jet-button>
    </form>
</div>
