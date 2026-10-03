<nav x-data="{ open: false }"
    class="bg-[#FAFAFA] border-b-2 border-[#0A0A0A]">

    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="flex justify-between h-20">

            <!-- Left -->
            <div class="flex items-center">

                <!-- Logo / Brand -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}"
                        class="flex items-center gap-3 no-underline">

                        <div class="w-10 h-10 bg-[#0A0A0A] text-[#FAFAFA]
                                    flex items-center justify-center
                                    font-black text-lg">
                            N
                        </div>

                        <div class="leading-none">
                            <div class="text-xl font-black tracking-tight text-[#0A0A0A]">
                                NEXA
                            </div>

                            <div class="text-[10px] font-bold tracking-[0.2em] text-[#EF4444]">
                                SUBMIT
                            </div>
                        </div>

                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden sm:flex sm:items-center sm:ms-12">

                    <x-nav-link
                        :href="route('dashboard')"
                        :active="request()->routeIs('dashboard')"
                        class="uppercase tracking-wider font-bold text-sm">

                        {{ __('Dashboard') }}

                    </x-nav-link>

                </div>

            </div>


            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">

                <x-dropdown align="right" width="48">

                    <x-slot name="trigger">

                        <button
                            class="inline-flex items-center gap-3
                                   px-4 py-3
                                   border-2 border-[#0A0A0A]
                                   bg-[#FAFAFA]
                                   text-sm font-bold uppercase tracking-wide
                                   text-[#0A0A0A]
                                   hover:bg-[#0A0A0A]
                                   hover:text-[#FAFAFA]
                                   focus:outline-none
                                   transition duration-150">

                            <span>
                                {{ Auth::user()->name }}
                            </span>

                            <svg
                                class="fill-current h-4 w-4"
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 20 20">

                                <path
                                    fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd" />

                            </svg>

                        </button>

                    </x-slot>


                    <x-slot name="content">

                        <x-dropdown-link
                            :href="route('profile.edit')">

                            {{ __('Profile') }}

                        </x-dropdown-link>


                        <!-- Authentication -->

                        <form method="POST" action="{{ route('logout') }}">

                            @csrf

                            <x-dropdown-link
                                :href="route('logout')"
                                onclick="event.preventDefault();
                                    this.closest('form').submit();">

                                {{ __('Log Out') }}

                            </x-dropdown-link>

                        </form>

                    </x-slot>

                </x-dropdown>

            </div>


            <!-- Hamburger -->

            <div class="-me-2 flex items-center sm:hidden">

                <button
                    @click="open = ! open"
                    class="inline-flex items-center justify-center
                           p-2
                           border-2 border-[#0A0A0A]
                           text-[#0A0A0A]
                           hover:bg-[#0A0A0A]
                           hover:text-[#FAFAFA]
                           focus:outline-none
                           transition duration-150">

                    <svg
                        class="h-6 w-6"
                        stroke="currentColor"
                        fill="none"
                        viewBox="0 0 24 24">

                        <path
                            :class="{'hidden': open, 'inline-flex': ! open}"
                            class="inline-flex"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />

                        <path
                            :class="{'hidden': ! open, 'inline-flex': open}"
                            class="hidden"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />

                    </svg>

                </button>

            </div>

        </div>

    </div>


    <!-- Responsive Navigation Menu -->

    <div
        :class="{'block': open, 'hidden': ! open}"
        class="hidden sm:hidden border-t-2 border-[#0A0A0A]">

        <div class="pt-2 pb-3 space-y-1">

            <x-responsive-nav-link
                :href="route('dashboard')"
                :active="request()->routeIs('dashboard')">

                {{ __('Dashboard') }}

            </x-responsive-nav-link>

        </div>


        <!-- Responsive Settings Options -->

        <div class="pt-4 pb-4 border-t-2 border-[#0A0A0A]">

            <div class="px-4">

                <div class="font-black text-base text-[#0A0A0A] uppercase">
                    {{ Auth::user()->name }}
                </div>

                <div class="font-medium text-sm text-[#525252]">
                    {{ Auth::user()->email }}
                </div>

            </div>


            <div class="mt-3 space-y-1">

                <x-responsive-nav-link
                    :href="route('profile.edit')">

                    {{ __('Profile') }}

                </x-responsive-nav-link>


                <!-- Authentication -->

                <form method="POST" action="{{ route('logout') }}">

                    @csrf

                    <x-responsive-nav-link
                        :href="route('logout')"
                        onclick="event.preventDefault();
                            this.closest('form').submit();">

                        {{ __('Log Out') }}

                    </x-responsive-nav-link>

                </form>

            </div>

        </div>

    </div>

</nav>