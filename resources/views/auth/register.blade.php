@extends('layout.main')

@section('content')
<div class="relative min-h-screen flex items-center justify-center bg-black overflow-hidden">

    <!-- Hintergrund-Logo -->
    <img src="{{ asset('images/Movie.svg') }}"
         alt="Movie Logo"
         class="absolute w-96 opacity-10 pointer-events-none select-none" />

    <!-- Register-Box -->
    <div class="relative z-10 w-full max-w-sm px-6 py-8 bg-gray-900 bg-opacity-80 rounded-xl shadow-lg text-white">

        <h2 class="text-2xl font-semibold text-center mb-6">Registrieren</h2>

        <x-validation-errors class="mb-4 text-red-500" />

        <form method="POST" action="{{ route('register') }}" class="space-y-6">
            @csrf

            <!-- Name -->
            <div class="px-2 max-w-xs mx-auto">
                <label for="name" class="block text-sm font-medium text-gray-300">Name</label>
                <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name"
                       class="mt-1 block w-full rounded-md bg-gray-800 border border-gray-700 text-white text-sm px-4 py-2 focus:outline-none focus:ring-2 focus:ring-red-600">
            </div>

            <!-- Email -->
            <div class="px-2 max-w-xs mx-auto">
                <label for="email" class="block text-sm font-medium text-gray-300">E-Mail</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username"
                       class="mt-1 block w-full rounded-md bg-gray-800 border border-gray-700 text-white text-sm px-4 py-2 focus:outline-none focus:ring-2 focus:ring-red-600">
            </div>

            <!-- Passwort -->
            <div class="px-2 max-w-xs mx-auto">
                <label for="password" class="block text-sm font-medium text-gray-300">Passwort</label>
                <input id="password" type="password" name="password" required autocomplete="new-password"
                       class="mt-1 block w-full rounded-md bg-gray-800 border border-gray-700 text-white text-sm px-4 py-2 focus:outline-none focus:ring-2 focus:ring-red-600">
            </div>

            <!-- Passwort bestätigen -->
            <div class="px-2 max-w-xs mx-auto">
                <label for="password_confirmation" class="block text-sm font-medium text-gray-300">Passwort bestätigen</label>
                <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password"
                       class="mt-1 block w-full rounded-md bg-gray-800 border border-gray-700 text-white text-sm px-4 py-2 focus:outline-none focus:ring-2 focus:ring-red-600">
            </div>

            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mt-4 max-w-xs mx-auto px-2">
                    <label for="terms" class="flex items-center text-sm text-gray-400">
                        <input id="terms" type="checkbox" name="terms" required
                               class="mr-3 rounded border-gray-600 bg-gray-700 text-red-600 focus:ring-red-500">
                        <span class="text-gray-400">
                            {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                    'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline hover:text-red-500">'.__('Terms of Service').'</a>',
                                    'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline hover:text-red-500">'.__('Privacy Policy').'</a>',
                            ]) !!}
                        </span>
                    </label>
                </div>
            @endif

            <div class="flex items-center justify-end mt-6 max-w-xs mx-auto px-2 space-x-4">
                <a href="{{ route('login') }}" class="underline text-sm text-gray-400 hover:text-red-600 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                    Bereits registriert?
                </a>

                <button type="submit"
                        class="bg-red-600 hover:bg-red-700 text-white font-semibold py-2 px-6 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                    Registrieren
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
