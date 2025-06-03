@extends('layout.main')

@section('content')
<div class="relative min-h-screen flex items-center justify-center bg-black overflow-hidden">

    <!-- Hintergrund-Logo -->
    <img src="{{ asset('images/Movie.svg') }}"
         alt="Movie Logo"
         class="absolute w-96 opacity-10 pointer-events-none select-none" />

    <!-- Passwort vergessen Box -->
    <div class="relative z-10 w-full max-w-sm px-6 py-8 bg-gray-900 bg-opacity-80 rounded-xl shadow-lg text-white">

        <h2 class="text-2xl font-semibold text-center mb-6">Passwort vergessen?</h2>

        <p class="mb-4 text-sm text-gray-300">
            Gib deine E-Mail-Adresse ein, und wir senden dir einen Link, mit dem du dein Passwort zurücksetzen kannst.
        </p>

        @if (session('status'))
            <div class="mb-4 text-sm text-green-400">
                {{ session('status') }}
            </div>
        @endif

        <x-validation-errors class="mb-4 text-red-500" />

        <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
            @csrf

            <div class="px-2 max-w-xs mx-auto">
                <label for="email" class="block text-sm font-medium text-gray-300">E-Mail</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                       class="mt-1 block w-full rounded-md bg-gray-800 border border-gray-700 text-white text-sm px-4 py-2 focus:outline-none focus:ring-2 focus:ring-red-600" />
            </div>

            <div class="mt-6 text-center">
                <button type="submit"
                        class="w-48 bg-red-600 hover:bg-red-700 text-white font-semibold py-2 px-4 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                    Link zum Zurücksetzen senden
                </button>
            </div>
        </form>

        <div class="mt-6 text-center text-sm text-gray-400">
            Zurück zum
            <a href="{{ route('login') }}" class="text-red-500 hover:underline">Login</a>
        </div>

    </div>
</div>
@endsection
