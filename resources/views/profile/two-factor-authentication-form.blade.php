<x-action-section>
    <x-slot name="title">
        <h2 class="text-2xl font-semibold text-center mb-6 text-white">{{ __('Zwei-Faktor-Authentifizierung') }}</h2>
    </x-slot>

    <x-slot name="description">
        <p class="text-gray-400 max-w-xl mx-auto text-center">
            {{ __('Füge deinem Konto eine zusätzliche Sicherheitsebene hinzu.') }}
        </p>
    </x-slot>

    <x-slot name="content">
        <h3 class="text-lg font-medium text-white text-center mb-4">
            @if ($this->enabled)
                @if ($showingConfirmation)
                    {{ __('Beende die Aktivierung der Zwei-Faktor-Authentifizierung.') }}
                @else
                    {{ __('Zwei-Faktor-Authentifizierung ist aktiviert.') }}
                @endif
            @else
                {{ __('Zwei-Faktor-Authentifizierung ist nicht aktiviert.') }}
            @endif
        </h3>

        <p class="text-gray-400 max-w-xl mx-auto text-center text-sm">
            {{ __('Beim Login wirst du nach einem sicheren Token gefragt, den du mit deiner Authenticator-App generierst.') }}
        </p>

        @if ($this->enabled)
            @if ($showingQrCode)
                <p class="mt-4 text-gray-400 max-w-xl mx-auto text-center text-sm font-semibold">
                    @if ($showingConfirmation)
                        {{ __('Scanne den QR-Code mit deiner Authenticator-App und gib den OTP-Code ein.') }}
                    @else
                        {{ __('Scanne den QR-Code mit deiner Authenticator-App oder gib den Schlüssel ein.') }}
                    @endif
                </p>

                <div class="mt-4 flex justify-center bg-gray-800 p-2 rounded mx-auto max-w-xs">
                    {!! $this->user->twoFactorQrCodeSvg() !!}
                </div>

                <p class="mt-2 text-gray-400 max-w-xl mx-auto text-center text-sm font-mono select-all">
                    {{ __('Schlüssel:') }} {{ decrypt($this->user->two_factor_secret) }}
                </p>

                @if ($showingConfirmation)
                    <div class="mt-4 max-w-xs mx-auto px-2">
                        <label for="code" class="block text-sm font-medium text-gray-300 mb-1">{{ __('Code') }}</label>
                        <input id="code" type="text" name="code" autofocus autocomplete="one-time-code"
                               wire:model.defer="code"
                               wire:keydown.enter="confirmTwoFactorAuthentication"
                               class="block w-full rounded-md bg-gray-800 border border-gray-700 text-white px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-red-600" />
                        <x-input-error for="code" class="mt-2 text-red-500" />
                    </div>
                @endif
            @endif

            @if ($showingRecoveryCodes)
                <p class="mt-4 text-gray-400 max-w-xl mx-auto text-center text-sm font-semibold">
                    {{ __('Bewahre diese Wiederherstellungscodes sicher auf. Sie helfen dir, falls du dein Gerät verlierst.') }}
                </p>

                <div class="mt-4 max-w-xl mx-auto bg-gray-800 rounded-lg p-4 font-mono text-sm grid gap-1 text-white select-all">
                    @foreach (json_decode(decrypt($this->user->two_factor_recovery_codes), true) as $code)
                        <div>{{ $code }}</div>
                    @endforeach
                </div>
            @endif
        @endif

        <div class="mt-6 flex justify-center space-x-4">
            @if (! $this->enabled)
                <x-confirms-password wire:then="enableTwoFactorAuthentication">
                    <button type="button"
                            class="bg-red-600 hover:bg-red-700 text-white font-semibold py-2 px-6 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500"
                            wire:loading.attr="disabled">
                        {{ __('Aktivieren') }}
                    </button>
                </x-confirms-password>
            @else
                @if ($showingRecoveryCodes)
                    <x-confirms-password wire:then="regenerateRecoveryCodes">
                        <button type="button"
                                class="bg-gray-700 hover:bg-gray-600 text-white font-semibold py-2 px-6 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500"
                                wire:loading.attr="disabled">
                            {{ __('Wiederherstellungscodes neu erstellen') }}
                        </button>
                    </x-confirms-password>
                @elseif ($showingConfirmation)
                    <x-confirms-password wire:then="confirmTwoFactorAuthentication">
                        <button type="button"
                                class="bg-red-600 hover:bg-red-700 text-white font-semibold py-2 px-6 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500"
                                wire:loading.attr="disabled">
                            {{ __('Bestätigen') }}
                        </button>
                    </x-confirms-password>
                @else
                    <x-confirms-password wire:then="showRecoveryCodes">
                        <button type="button"
                                class="bg-gray-700 hover:bg-gray-600 text-white font-semibold py-2 px-6 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500"
                                wire:loading.attr="disabled">
                            {{ __('Wiederherstellungscodes anzeigen') }}
                        </button>
                    </x-confirms-password>
                @endif

                @if ($showingConfirmation)
                    <x-confirms-password wire:then="disableTwoFactorAuthentication">
                        <button type="button"
                                class="bg-gray-700 hover:bg-gray-600 text-white font-semibold py-2 px-6 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500"
                                wire:loading.attr="disabled">
                            {{ __('Abbrechen') }}
                        </button>
                    </x-confirms-password>
                @else
                    <x-confirms-password wire:then="disableTwoFactorAuthentication">
                        <button type="button"
                                class="bg-red-700 hover:bg-red-800 text-white font-semibold py-2 px-6 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500"
                                wire:loading.attr="disabled">
                            {{ __('Deaktivieren') }}
                        </button>
                    </x-confirms-password>
                @endif
            @endif
        </div>
    </x-slot>
</x-action-section>
