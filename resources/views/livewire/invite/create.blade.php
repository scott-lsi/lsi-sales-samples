<div> 
    @push('pagetitle', 'Create Invite')

    <x-jet-banner />
    
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            {{ __('Create Invite') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form wire:submit.prevent="create" method="POST">
                @csrf

                <div class="flex mb-4">
                    <div class="w-1/3 mr-8">
                        <h1 class="font-normal text-xl mb-3">Email</h1>
                        <p class="text-gray-700 text-sm mb-3">Add the name and email address of the recipient along with an optional message.</p>
                    </div>

                    <div class="w-2/3 bg-white rounded p-4">
                        <div class="mb-4">
                            <label for="recipient_name" class="block font-semibold text-sm mb-2">Recipient Name</label>
                            <x-jet-input type="text" wire:model.debounce.500ms="recipient_name" name="recipient_name" class="w-full" />
                            @error('recipient_name') <div class="mt-3 text-sm text-red-500">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-4">
                            <label for="recipient_email_address" class="block font-semibold text-sm mb-2">Recipient Email Address</label>
                            <x-jet-input type="text" wire:model.debounce.500ms="recipient_email_address" name="recipient_email_address" class="w-full" />
                            @error('recipient_email_address') <div class="mt-3 text-sm text-red-500">{{ $message }}</div> @enderror
                        </div>

                        <div class="block font-semibold text-sm mb-2">Email</div>
                        <div class="border rounded p-4 bg-white text-sm">
                            <div class="flex justify-center mb-4">
                                <img src="http://util.lsipower.co.uk/email/header/{{ strtolower(substr(env('SALESPERSON_FIRSTNAME'), 0, 1) . env('SALESPERSON_SURNAME')) }}header.png">
                            </div>

                            <p class="mb-4">Hi @if($recipient_name){{ $recipient_name }},@endif</p>

                            <p class="mb-4">Hope you are well! I know you will get hundreds of emails trying to sell you merchandise and branded items but we are different... No really, we are! I want to stand out more than anyone else who might get in touch so I've had this web shop made especially for you to grab a free personalised notebook... from me. It's dead easy just click away and I'll get you one sent out in no time. Who doesn't love a freebie?</p>

                            <div class="mb-4">
                                <label for="optional_message" class="sr-only">Optional Message</label>
                                <x-textarea wire:model.debounce.500ms="optional_message" name="optional_message" class="w-full font-mono" rows="5" />
                                @error('optional_message') <div class="mt-3 text-sm text-red-500">{{ $message }}</div> @enderror
                            </div>

                            <div class="flex justify-center mb-8">
                                <span class="rounded px-6 py-4 bg-pink-600 text-white font-bold text-lg cursor-pointer">Click here, claim now...</span>
                            </div>

                            <p class="mb-4">Kind regards,</p>

                            <p class="mb-4">
                                {{ env('SALESPERSON_FIRSTNAME') }} {{ env('SALESPERSON_SURNAME') }}<br>
                                {{ env('SALESPERSON_JOBTITLE') }}<br>
                                DDi: {{ env('SALESPERSON_PHONE') }}<br>
                                Main: 01274 852598<br>
                                E-Mail: <a href="mailto:{{ env('SALESPERSON_EMAIL') }}">{{ env('SALESPERSON_EMAIL') }}</a>
                            </p>
                        </div>
                    </div>
                </div>

                <div class="flex mb-4 justify-end">
                    <div class="w-2/3 pl-5">
                        <x-jet-button class="mb-4 w-full">Send Invite</x-jet-button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
