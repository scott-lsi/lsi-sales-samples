<div>
    @push('pagetitle', $page->title)

    <x-jet-banner />

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h1 class="text-3xl mb-4">{{ $page->title }}</h1>

            {!! $page->content !!}
        </div>
    </div>
</div>
