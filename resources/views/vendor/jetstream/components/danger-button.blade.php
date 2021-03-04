<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-block text-center text-white bg-red-600 px-4 py-2 font-bold rounded border-transparent hover:bg-red-700']) }}>
    {{ $slot }}
</button>
