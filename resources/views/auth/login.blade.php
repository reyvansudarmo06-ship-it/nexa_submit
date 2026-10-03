<x-guest-layout>

    <div class="mb-6 text-center">
        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">
            NEXA SUBMIT
        </h1>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            Masuk ke akun kamu
        </p>
    </div>

    @if (session('error'))
        <div class="mb-4 rounded-md bg-red-100 px-4 py-3 text-sm text-red-700">
            {{ session('error') }}
        </div>
    @endif

    @if (session('status'))
        <div class="mb-4 rounded-md bg-green-100 px-4 py-3 text-sm text-green-700">
            {{ session('status') }}
        </div>
    @endif

    <x-auth-session-status
        class="mb-4"
        :status="session('status')"
    />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Role -->
        <div>
            <x-input-label
                for="role"
                :value="__('Masuk sebagai')"
            />

            <select
                id="role"
                name="role"
                class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                required
            >
                <option value="">Pilih role</option>
                <option value="student" {{ old('role') === 'student' ? 'selected' : '' }}>
                    Siswa
                </option>
                <option value="teacher" {{ old('role') === 'teacher' ? 'selected' : '' }}>
                    Guru
                </option>
                <option value="admin" {{ old('role') === 'admin' ? 'selected' : '' }}>
    Admin
</option>
            </select>

            <x-input-error
                :messages="$errors->get('role')"
                class="mt-2"
            />
        </div>

        <!-- Email -->
        <div class="mt-4">
            <x-input-label
                for="email"
                :value="__('Email')"
            />

            <x-text-input
                id="email"
                class="block mt-1 w-full"
                type="email"
                name="email"
                :value="old('email')"
                required
                autofocus
                autocomplete="username"
            />

            <x-input-error
                :messages="$errors->get('email')"
                class="mt-2"
            />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label
                for="password"
                :value="__('Password')"
            />

            <x-text-input
                id="password"
                class="block mt-1 w-full"
                type="password"
                name="password"
                required
                autocomplete="current-password"
            />

            <x-input-error
                :messages="$errors->get('password')"
                class="mt-2"
            />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input
                    id="remember_me"
                    type="checkbox"
                    class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
                    name="remember"
                >

                <span class="ms-2 text-sm text-gray-600">
                    {{ __('Remember me') }}
                </span>
            </label>
        </div>

        <!-- Actions -->
        <div class="flex items-center justify-between mt-6">

            @if (Route::has('password.request'))
                <a
                    class="underline text-sm text-gray-600 hover:text-gray-900"
                    href="{{ route('password.request') }}"
                >
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button>
                {{ __('Log in') }}
            </x-primary-button>

        </div>

    </form>

    <div class="mt-6 text-center">
        <span class="text-sm text-gray-600">
            Belum punya akun?
        </span>

        <a
            href="{{ route('register') }}"
            class="text-sm font-semibold text-indigo-600 hover:text-indigo-500"
        >
            Daftar sekarang
        </a>
    </div>

</x-guest-layout>