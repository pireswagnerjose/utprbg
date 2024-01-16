<x-guest-layout>
    <x-authentication-card>
        @include('dark-buttons')
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <x-validation-errors class="mb-4" />

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600 dark:text-green-400">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="relative z-0 mt-4">
                <x-input-email-pass id="email" type="email" name="email" required />
                <x-label for="email" value="{{ __('Email') }}" />
            </div>

            <div class="mt-8 relative z-0">
                <x-input-email-pass id="password" type="password" name="password" required />
                <x-label for="password" value="{{ __('Password') }}" />
            </div>

            <div class="block mt-4">
                <label for="remember_me" class="flex items-center">
                    <x-checkbox id="remember_me" name="remember" />
                    <span class="ms-2 text-sm text-zinc-600 dark:text-zinc-400">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-button class="ms-4">
                    {{ __('Log in') }}
                </x-button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>
