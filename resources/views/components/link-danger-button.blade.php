<a {{ $attributes->merge(['type' => 'submit', 'class' => 'cursor-pointer inline-block text-center text-white px-3 py-2 bg-red-600 font-bold rounded border-transparent hover:bg-red-700']) }}>
    {{ $slot }}
</a>