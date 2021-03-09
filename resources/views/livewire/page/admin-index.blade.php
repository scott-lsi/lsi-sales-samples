<div> 
    @push('pagetitle', 'Manage Pages')

    <x-jet-banner />
    
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            {{ __('Manage Pages') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h1 class="text-3xl mb-4">{{ $tableTitle }}</h1>

            <p class="mb-4">
                <x-link-button wire:click="currentPages" class="mr-4">Show current pages</x-link-button>
                <x-link-button wire:click="deletedPages" class="mr-4">Show deleted pages</x-link-button>
                <x-link-button href="{{ route('page.create') }}">Create Page</x-link-button>
            </p>

            <table class="w-full table-auto mb-4">
                <thead>
                    <tr class="border-b">
                        <th class="py-4 text-left">Title</th>
                        <th class="py-4 text-left">Functions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pages as $page)
                        <tr class="border-b">
                            <td class="py-4">
                                @if($page->is_homepage)
                                    <svg class="inline mr-2 h-4 w-4" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 486.196 486.196" style="enable-background:new 0 0 486.196 486.196;" xml:space="preserve">
                                        <path d="M481.708,220.456l-228.8-204.6c-0.4-0.4-0.8-0.7-1.3-1c-5-4.8-13-5-18.3-0.3l-228.8,204.6c-5.6,5-6,13.5-1.1,19.1
                                            c2.7,3,6.4,4.5,10.1,4.5c3.2,0,6.4-1.1,9-3.4l41.2-36.9v7.2v106.8v124.6c0,18.7,15.2,34,34,34c0.3,0,0.5,0,0.8,0s0.5,0,0.8,0h70.6
                                            c17.6,0,31.9-14.3,31.9-31.9v-121.3c0-2.7,2.2-4.9,4.9-4.9h72.9c2.7,0,4.9,2.2,4.9,4.9v121.3c0,17.6,14.3,31.9,31.9,31.9h72.2
                                            c19,0,34-18.7,34-42.6v-111.2v-34v-83.5l41.2,36.9c2.6,2.3,5.8,3.4,9,3.4c3.7,0,7.4-1.5,10.1-4.5
                                            C487.708,233.956,487.208,225.456,481.708,220.456z M395.508,287.156v34v111.1c0,9.7-4.8,15.6-7,15.6h-72.2c-2.7,0-4.9-2.2-4.9-4.9
                                            v-121.1c0-17.6-14.3-31.9-31.9-31.9h-72.9c-17.6,0-31.9,14.3-31.9,31.9v121.3c0,2.7-2.2,4.9-4.9,4.9h-70.6c-0.3,0-0.5,0-0.8,0
                                            s-0.5,0-0.8,0c-3.8,0-7-3.1-7-7v-124.7v-106.8v-31.3l151.8-135.6l153.1,136.9L395.508,287.156L395.508,287.156z"/>
                                    </svg>
                                @endif
                                <a href="{{ route('page.show', $page) }}">{{ $page->title }}</a>
                            </td>
                            <td class="py-4">
                                @if(!$page->trashed())
                                <x-link-button href="{{ route('page.edit', $page) }}" class="mr-4">Edit Page</x-link-button>
                                <x-link-danger-button wire:click="delete({{ $page->id }})">Delete Page</x-link-danger-button>
                                @else
                                <x-link-success-button wire:click="restore({{ $page->id }})" class="mr-4">Restore Page</x-link-success-button>
                                <x-link-danger-button wire:click="destroy({{ $page->id }})">Permanently Delete Page</x-link-danger-button>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
