<?php
    use Carbon\Carbon;
    use App\Models\Token;
?>
<div class="py-12">
    @if(Auth::check() || session()->has('token') && Carbon::now() < Token::where('token', session('token')->token)->first()->expires)
        @push('pagetitle', 'Products')

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-6 gap-8 mb-8 items-center p-2 md:p-0">
                <div class="col-span-3 order-2 md:col-span-1 md:order-none">
                    <img src="https://www.lsi.co.uk/imglib/about/team/photo/{{ strtolower(env('SALESPERSON_FIRSTNAME') . '_' . env('SALESPERSON_SURNAME')) }}.jpg" class="w-full rounded" alt="{{ strtolower(env('SALESPERSON_FIRSTNAME') . '_' . env('SALESPERSON_SURNAME')) }}">
                </div>

                <div class="col-span-6 md:col-span-4 order-1 md:order-none">
                    <h1 class="text-3xl mt-4 mb-8 text-center">Welcome to my Intro website!</h1>
                    <p class="text-2xl text-center mt-4 mb-8">Instead of just a brochure through the post, I would like to send you a free personalised notebook and in just a few more clicks it will be on its way to you&hellip; Who doesn't love a freebie?</p>
                    <p class="text-2xl text-center mt-4 mb-8">Select a design you like below</p>
                </div>
                
                <div class="col-span-3 order-3 md:col-span-1 md:order-none">
                    <img src="https://www.lsi.co.uk/imglib/about/team/character/{{ strtolower(env('SALESPERSON_FIRSTNAME') . '_' . env('SALESPERSON_SURNAME')) }}.png" class="w-full" alt="{{ strtolower(env('SALESPERSON_FIRSTNAME') . '_' . env('SALESPERSON_SURNAME')) }} character">
                </div>
            </div>
            
            <div class="sm:grid sm:gap-8 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
                @foreach($products as $product)
                    <a href="{{ route('product.personaliser', $product) }}" class="block border rounded bg-white hover:shadow">
                        <img src="{{ asset('storage/products/' . $product->main_product_image) }}" class="w-full">
                        <div class="text-center font-bold my-4">{{ $product->name }}</div>
                    </a>
                @endforeach
            </div>
        </div>
    @else
        @push('pagetitle', 'Home Page')

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h1 class="text-3xl mt-4 mb-8">You do not have authorisation to view this page</h1>

            <p>To access the content of this site, you must access this site via the link in your email.</p>
        </div>
    @endif
</div>
