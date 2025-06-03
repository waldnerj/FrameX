<x-action-section>
    <x-slot name="title">
        <h2 class="text-2xl font-semibold text-center mb-6 text-white">{{ __('Browser-Sitzungen') }}</h2>
    </x-slot>

    <x-slot name="description">
        <p class="text-gray-400 max-w-xl mx-auto text-center">
            {{ __('Verwalte und melde dich bei allen anderen Browser-Sitzungen ab.') }}
        </p>
    </x-slot>

    <x-slot name="content">
        <div class="max-w-xs mx-auto text-gray-400 text-center text-sm mb-4">
            {{ __('Wenn du glaubst, dass dein Konto kompromittiert wurde, melde dich von allen anderen Browsern und Geräten ab.') }}
        </div>

        <!-- Liste der Sessions -->
        <div class="mb-4 max-w-xs mx-auto bg-gray-800 rounded-md p-4 text-white text-sm space-y-2">
            @foreach ($this->sessions as $session)
                <div class="flex items-center justify-between">
                    <div>
                        <div>
                            @if ($session->agent->isDesktop())
                                <svg class="inline-block w-5 h-5 mr-1 text-red-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M9.75 17L15 12m0 0l-5.25-5M15 12h6"/></svg>
                            @else
                                <svg class="inline-block w-5 h-5 mr-1 text-red-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 10h16M4 14h16M4 18h16"/></svg>
                            @endif
                            {{ $session->agent->platform() ?: __('Unbekannt') }} - {{ $session->agent->browser() ?: __('Unbekannt') }}
                        </div>
                        <div class="text-xs text-gray-400">
                            {{ $session->ip_address }},

                            @if ($session->is_current_device)
                                <span class="font-semibold text-red-600">{{ __('Dieses Gerät') }}</span>
                            @else
                                {{ __('Letzte Aktivität') }}: {{ $session->last_active }}
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="max-w-xs mx-auto">
            <x-confirms-password wire:then="logoutOtherBrowserSessions">
                <button type="button"
                        class="w-full bg-red-600 hover:bg-red-700 text-white font-semibold py-2 px-6 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500"
                        wire:loading.attr="disabled">
                    {{ __('Andere Browser-Sitzungen abmelden') }}
                </button>
            </x-confirms-password>
        </div>
    </x-slot>
</x-action-section>
