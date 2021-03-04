<div> 
    @push('pagetitle', 'Edit ' . $page->title)
    
    <x-jet-banner />
    
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            {{ __('Edit Page') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form wire:submit.prevent="update" method="POST">
                @csrf

                <div class="flex mb-4">
                    <div class="w-1/3 mr-8">
                        <h1 class="font-normal text-xl mb-3">Page Information</h1>
                        <p class="text-gray-700 text-sm mb-3">The title and content of the page.</p>
                        <p><x-link-button href="{{ route('page.show', $page) }}" class="px-3 py-2">View this page</x-link-button></p>
                    </div>

                    <div class="w-2/3 bg-white rounded p-4">
                        <div class="mb-4">
                            <label for="title" class="block font-semibold text-sm mb-2">Title</label>
                            <x-jet-input type="text" wire:model.debounce.500ms="title" name="title" class="w-full" />
                            @error('title') <div class="mt-3 text-sm text-red-500">{{ $message }}</div> @enderror
                        </div>
                        
                        <div class="mb-4">
                            <label for="content" class="block font-semibold text-sm mb-2">Content (HTML)</label>
                            <x-textarea wire:model.debounce.500ms="content" name="content" class="w-full font-mono" rows="15" />
                            @error('content') <div class="mt-3 text-sm text-red-500">{{ $message }}</div> @enderror
                        </div>
                        
                        <div class="mb-4">
                            <x-jet-checkbox wire:model="is_homepage" id="is_homepage" class="mr-2" />
                            <label for="is_homepage" class="font-semibold text-sm mb-2">Make Homepage</label>
                        </div>
                    </div>
                </div>

                <div class="flex mb-4 justify-end">
                    <div class="w-2/3 pl-5">
                        <x-jet-button class="mb-4 w-full">Update Page</x-jet-button>
                    </div>
                </div>
            </form>

            <hr class="my-4">

            <x-back-link href="{{ route('page.admin-index') }}">Back to Manage Pages</x-back-link>
        </div>
    </div>
</div>
