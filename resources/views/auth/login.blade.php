<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="text-center mb-8">
        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Laporan Keuanganku</h1>
        <p class="text-gray-600 dark:text-gray-400 mt-2">Kelola keuangan pribadi Anda dengan mudah</p>
    </div>

    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf

        <x-form-group label="Email" for="email" required :error="$errors->first('email')">
            <x-text-input
                id="email"
                name="email"
                type="email"
                class="w-full"
                placeholder="nama@email.com"
                :value="old('email')"
                required
                autofocus
                autocomplete="username"
            />
        </x-form-group>

        <x-form-group label="Password" for="password" required :error="$errors->first('password')">
            <x-text-input
                id="password"
                name="password"
                type="password"
                class="w-full"
                placeholder="••••••••"
                required
                autocomplete="current-password"
            />
        </x-form-group>

        <div class="flex items-center justify-between">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-blue-600 shadow-sm focus:ring-blue-500 dark:focus:ring-blue-600 dark:focus:ring-offset-gray-800" name="remember">
                <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Ingat saya') }}</span>
            </label>

            @if (Route::has('password.request'))
                <a class="text-sm text-blue-600 hover:text-blue-800 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 dark:focus:ring-offset-gray-800" href="{{ route('password.request') }}">
                    {{ __('Lupa password?') }}
                </a>
            @endif
        </div>

        <x-primary-button class="w-full justify-center py-3">
            {{ __('Masuk') }}
        </x-primary-button>

        <div class="mt-6 text-center">
            <p class="text-sm text-gray-600 dark:text-gray-400">
                {{ __('Belum punya akun?') }}
                <a href="{{ route('register') }}" class="text-blue-600 hover:text-blue-800 font-medium">
                    {{ __('Daftar sekarang') }}
                </a>
            </p>
        </div>
    </form>
</x-guest-layout>
