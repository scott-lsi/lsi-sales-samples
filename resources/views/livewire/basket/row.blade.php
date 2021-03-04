<tr class="border-b border-gray-200">
    <td class="py-2">
        <img src="{{ $row['options']['imageurl'] }}" class="w-48 border rounded border-gray-200 bg-white">
    </td>
    <td class="py-2">
        <p class="mb-4">{{ $row['name'] }}</p>

        @if(isset($row['options']['textinputs']) && !empty($row['options']['textinputs']))
            <p>Personalisation Text</p>
            <ul class="mb-4">
                @foreach($row['options']['textinputs'] as $i=>$textinput)
                    <li>Text {{ $i+1 }}: {{ $textinput }}</li>
                @endforeach
            </ul>
        @endif

        <x-link-button href="{{ route('product.personaliser', [$row['options']['product']['slug'], $row['options']['ref'], $row['rowId']]) }}">Edit Personalisation</x-link-button>
    </td>
    <td class="py-2">
        <form wire:submit.prevent="updateQuantity" method="POST">
            @csrf
            <input type="text" wire:model="quantity" name="quantity" class="border rounded border-gray-400 w-24">
            <x-jet-button>Update</x-jet-button>
        </form>
    </td>
    <td class="py-2">
        <form wire:submit.prevent="delete" method="POST">
            @csrf
            <x-jet-danger-button>Remove</x-jet-button>
        </form>
    </td>
</tr>