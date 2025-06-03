<x-action-section>
    <x-slot name="title">
        <h2 class="text-2xl font-semibold text-center mb-6 text-white">{{ __('Passwort ändern') }}</h2>
    </x-slot>

    <x-slot name="description">
        <p class="text-gray-400 max-w-xl mx-auto text-center">
            {{ __('Stelle sicher, dass dein Konto ein langes, sicheres Passwort verwendet.') }}
        </p>
    </x-slot>

    <x-slot name="content">
        <form wire:submit.prevent="updatePassword" class="space-y-6 max-w-xs mx-auto">

            <div>
                <label for="current_password" class="block text-sm font-medium text-gray-300 mb-1">{{ __('Aktuelles Passwort') }}</label>
                <input id="current_password" type="password" wire:model.defer="state.current_password" autocomplete="current-password"
                       class="block w-full rounded-md bg-gray-800 border border-gray-700 text-white px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-red-600" />
                <x-input-error for="current_password" class="mt-1 text-red-500" />
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-gray-300 mb-1">{{ __('Neues Passwort') }}</label>
                <input id="password" type="password" wire:model.defer="state.password" autocomplete="new-password"
                       class="block w-full rounded-md bg-gray-800 border border-gray-700 text-white px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-red-600" />
                <x-input-error for="password" class="mt-1 text-red-500" />
            </div>

            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-gray-300 mb-1">{{ __('Passwort bestätigen') }}</label>
                <input id="password_confirmation" type="password" wire:model.defer="state.password_confirmation" autocomplete="new-password"
                       class="block w-full rounded-md bg-gray-800 border border-gray-700 text-white px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-red-600" />
                <x-input-error for="password_confirmation" class="mt-1 text-red-500" />
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
