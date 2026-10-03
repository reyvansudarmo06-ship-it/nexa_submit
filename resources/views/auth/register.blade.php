<x-guest-layout>

    <div class="mb-6 text-center">
        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">
            NEXA SUBMIT
        </h1>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            Buat akun baru
        </p>
    </div>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        {{-- NAMA --}}
        <div>
            <x-input-label
                for="name"
                :value="__('Nama Lengkap')"
            />

            <x-text-input
                id="name"
                class="block mt-1 w-full"
                type="text"
                name="name"
                :value="old('name')"
                required
                autofocus
                autocomplete="name"
            />

            <x-input-error
                :messages="$errors->get('name')"
                class="mt-2"
            />
        </div>

        {{-- EMAIL --}}
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
                autocomplete="username"
            />

            <x-input-error
                :messages="$errors->get('email')"
                class="mt-2"
            />
        </div>

        {{-- ROLE --}}
        <div class="mt-4">
            <x-input-label
                for="role"
                :value="__('Daftar sebagai')"
            />

            <select
                id="role"
                name="role"
                required
                class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
            >
                <option value="">Pilih role</option>

                <option
                    value="student"
                    {{ old('role') === 'student' ? 'selected' : '' }}
                >
                    Siswa
                </option>

                <option
                    value="teacher"
                    {{ old('role') === 'teacher' ? 'selected' : '' }}
                >
                    Guru
                </option>
            </select>

            <x-input-error
                :messages="$errors->get('role')"
                class="mt-2"
            />
        </div>

        {{-- TANGGAL LAHIR --}}
        <div class="mt-4">
            <x-input-label
                :value="__('Tanggal Lahir')"
            />

            <div class="grid grid-cols-3 gap-2 mt-1">

                {{-- HARI --}}
                <select
                    name="birth_day"
                    required
                    class="rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                >
                    <option value="">Hari</option>

                    @for ($day = 1; $day <= 31; $day++)
                        <option
                            value="{{ $day }}"
                            {{ old('birth_day') == $day ? 'selected' : '' }}
                        >
                            {{ $day }}
                        </option>
                    @endfor
                </select>

                {{-- BULAN --}}
                <select
                    name="birth_month"
                    required
                    class="rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                >
                    <option value="">Bulan</option>

                    @php
                        $months = [
                            1 => 'Januari',
                            2 => 'Februari',
                            3 => 'Maret',
                            4 => 'April',
                            5 => 'Mei',
                            6 => 'Juni',
                            7 => 'Juli',
                            8 => 'Agustus',
                            9 => 'September',
                            10 => 'Oktober',
                            11 => 'November',
                            12 => 'Desember',
                        ];
                    @endphp

                    @foreach ($months as $number => $month)
                        <option
                            value="{{ $number }}"
                            {{ old('birth_month') == $number ? 'selected' : '' }}
                        >
                            {{ $month }}
                        </option>
                    @endforeach
                </select>

                {{-- TAHUN --}}
                <select
                    name="birth_year"
                    required
                    class="rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                >
                    <option value="">Tahun</option>

                    @for ($year = now()->year; $year >= 1950; $year--)
                        <option
                            value="{{ $year }}"
                            {{ old('birth_year') == $year ? 'selected' : '' }}
                        >
                            {{ $year }}
                        </option>
                    @endfor
                </select>

            </div>

            @if (
                $errors->has('birth_date') ||
                $errors->has('birth_day') ||
                $errors->has('birth_month') ||
                $errors->has('birth_year')
            )
                <x-input-error
                    :messages="$errors->get('birth_date')"
                    class="mt-2"
                />

                <x-input-error
                    :messages="$errors->get('birth_day')"
                    class="mt-2"
                />

                <x-input-error
                    :messages="$errors->get('birth_month')"
                    class="mt-2"
                />

                <x-input-error
                    :messages="$errors->get('birth_year')"
                    class="mt-2"
                />
            @endif
        </div>

        {{-- PASSWORD --}}
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
                autocomplete="new-password"
            />

            <x-input-error
                :messages="$errors->get('password')"
                class="mt-2"
            />
        </div>

        {{-- KONFIRMASI PASSWORD --}}
        <div class="mt-4">
            <x-input-label
                for="password_confirmation"
                :value="__('Konfirmasi Password')"
            />

            <x-text-input
                id="password_confirmation"
                class="block mt-1 w-full"
                type="password"
                name="password_confirmation"
                required
                autocomplete="new-password"
            />

            <x-input-error
                :messages="$errors->get('password_confirmation')"
                class="mt-2"
            />
        </div>

        {{-- TOMBOL --}}
        <div class="flex items-center justify-between mt-6">

            <a
                class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100"
                href="{{ route('login') }}"
            >
                Sudah punya akun?
            </a>

            <x-primary-button>
                Daftar
            </x-primary-button>

        </div>

    </form>

</x-guest-layout>
