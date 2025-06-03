<x-action-section>
    <x-slot name="title">
        <h2 class="text-2xl font-semibold text-center mb-6 text-white">{{ __('Profil bearbeiten') }}</h2>
    </x-slot>

    <x-slot name="description">
        <p class="text-gray-400 max-w-xl mx-auto text-center">
            {{ __('Aktualisiere die Informationen in deinem Profil.') }}
        </p>
    </x-slot>

    <x-slot name="content">
        <form wire:submit.prevent="updateProfileInformation" class="space-y-6 max-w-xs mx-auto">

            <div>
                <label for="name" class="block text-sm font-medium text-gray-300 mb-1">{{ __('Name') }}</label>
                <input id="name" type="text" wire:model.defer="state.name" autocomplete="name"
                       class="block w-full rounded-md bg-gray-800 border border-gray-700 text-white px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-red-600" />
                <x-input-error for="name" class="mt-1 text-red-500" />
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-gray-300 mb-1">{{ __('E-Mail') }}</label>
                <input id="email" type="email" wire:model.defer="state.email" autocomplete="email"
                       class="block w-full rounded-md bg-gray-800 border border-gray-700 text-white px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-red-600" />
                <x-input-error for="email" class="mt-1 text-red-500" />
            </div>

            <div class="flex justify-end">
                <button type="submit"
                        class="bg-red-600 hover:bg-red-700 text-white font-semibold py-2 px-6 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500"
                        wire:loading.attr="disabled">
                    {{ __('Speichern') }}
                </button>
            </div>

        </form>
    </x-slot>
</x-action-section>
