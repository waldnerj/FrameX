<x-action-section>
    <x-slot name="title">
        <h2 class="text-2xl font-semibold text-center mb-6 text-white">{{ __('Account löschen') }}</h2>
    </x-slot>

    <x-slot name="description">
        <p class="text-gray-400 max-w-xl mx-auto text-center">
            {{ __('Lösche dauerhaft deinen Account und alle zugehörigen Daten.') }}
        </p>
    </x-slot>

    <x-slot name="content">
        <div class="max-w-xs mx-auto text-gray-400 text-center text-sm mb-4">
            {{ __('Sobald dein Account gelöscht wurde, können deine Daten nicht wiederhergestellt werden.') }}
        </div>

        <x-confirms-password wire:then="deleteUser">
            <button type="button"
                    class="w-full bg-red-700 hover:bg-red-800 text-white font-semibold py-2 px-6 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500"
                    wire:loading.attr="disabled">
                {{ __('Account löschen') }}
            </button>
        </x-confirms-password>
    </x-slot>
</x-action-section>
