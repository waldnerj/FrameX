@extends('layout.main')

@section('content')
<div class="relative min-h-screen flex items-center justify-center bg-black overflow-hidden">

    <!-- Hintergrund-Logo -->
    <img src="{{ asset('images/Movie.svg') }}"
         alt="Movie Logo"
         class="absolute w-96 opacity-10 pointer-events-none select-none" />

    <!-- Login-Box -->
    <div class="relative z-10 w-full max-w-sm px-6 py-8 bg-gray-900 bg-opacity-80 rounded-xl shadow-lg text-white">

        <h2 class="text-2xl font-semibold text-center mb-6">Login</h2>

        @if (session('status'))
            <div class="mb-4 text-sm text-green-400">
                {{ session('status') }}
            </div>
        @endif

        <x-validation-errors class="mb-4 text-red-500" />

        <form method="POST" action="{{ route('login') }}" class="space-y-6">
            @csrf

            <!-- Email -->
            <div class="px-2 max-w-xs mx-auto">
                <label for="email" class="block text-sm font-medium text-gray-300">E-Mail</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                       class="mt-1 block w-full rounded-md bg-gray-800 border border-gray-700 text-white text-sm px-4 py-2 focus:outline-none focus:ring-2 focus:ring-red-600">
            </div>

            <!-- Passwort -->
            <div class="px-2 max-w-xs mx-auto">
                <label for="password" class="block text-sm font-medium text-gray-300">Passwort</label>
                <input id="password" type="password" name="password" required
                       class="mt-1 block w-full rounded-md bg-gray-800 border border-gray-700 text-white text-sm px-4 py-2 focus:outline-none focus:ring-2 focus:ring-red-600">
                <div class="mt-1 text-right text-sm">
                    <a href="{{ route('password.request') }}" class="text-red-500 hover:underline">Passwort vergessen?</a>
                </div>
            </div>

            <!-- Angemeldet bleiben -->
            <div class="mt-6 text-sm text-gray-400 flex items-center justify-center">
                <label for="remember_me" class="flex items-center">
                    <input id="remember_me" type="checkbox" name="remember"
                           class="mr-3 rounded border-gray-600 bg-gray-700 text-red-600 focus:ring-red-500">
                    Angemeldet bleiben
                </label>
            </div>

            <!-- Login-Button -->
            <div class="mt-6 text-center">
                <button type="submit"
                        class="w-32 bg-red-600 hover:bg-red-700 text-white font-semibold py-2 px-4 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                    Einloggen
                </button>
            </div>
        </form>

        <!-- Registrierung -->
        <div class="mt-6 text-center text-sm text-gray-400">
            Noch kein Konto?
            <a href="{{ route('register') }}" class="text-red-500 hover:underline">Registrieren</a>
        </div>
    </div>
</div>
@endsection
