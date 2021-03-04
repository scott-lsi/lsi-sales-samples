<a {{ $attributes->merge(['type' => 'submit', 'class' => 'cursor-pointer inline-block text-center text-white px-3 py-2 bg-blue-600 font-bold rounded border-transparent hover:bg-blue-700']) }}>
    {{ $slot }}
</a>