<?php use Carbon\Carbon; ?>
<div class="py-12">
    @if(Auth::check() || session()->has('token') && Carbon::now() < Token::where('token', session('token')->token)->first()->expires)
        @push('pagetitle', 'Products')

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h1 class="text-3xl mt-4 mb-8">Products</h1>
            
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
