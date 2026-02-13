@php
    $headerNavigation = \App\Models\Navigation::publishedForLocation('header-menu');
    $headerItems = $headerNavigation?->resolvedItems() ?? [];
@endphp

<header class="bg-white shadow-[0_4px_20px_rgba(0,0,0,0.1)] relative z-50">
    <nav
        class="max-w-container mx-auto px-6 font-sans"
    >
        <div class="flex items-center justify-between h-20">

            <!-- Logo -->
            <div class="flex items-center gap-3">
                <a href="/" aria-label="Go to home">
                    <img src="/img/logo.png" alt="Dierennamengids" class="h-12 w-auto">
                </a>
            </div>

            <!-- Desktop menu -->
            <div
                class="hidden md:flex items-center gap-12
                       font-bold text-[18px] leading-[25px] tracking-[0px]"
            >
                @foreach($headerItems as $item)
                    @if(($item['children'] ?? []) !== [])
                        <!-- Dropdown -->
                        <div
                            class="relative group"
                        >
                            <button
                                class="flex items-center gap-1 text-gray-900 hover:text-[#F2613F] transition-colors"
                            >
                                {{ $item['label'] }}
                                <svg
                                    class="w-4 h-4 mt-[1px] transition-transform duration-200 group-hover:rotate-180 group-focus-within:rotate-180"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M19 9l-7 7-7-7"/>
                                </svg>
                            </button>

                            <div
                                class="absolute left-1/2 top-full -translate-x-1/2 w-[480px] bg-white shadow-xl rounded-2xl overflow-hidden
                                       text-[15px] font-normal border border-gray-100 z-50
                                       opacity-0 invisible pointer-events-none translate-y-1
                                       group-hover:opacity-100 group-hover:visible group-hover:pointer-events-auto group-hover:translate-y-0
                                       group-focus-within:opacity-100 group-focus-within:visible group-focus-within:pointer-events-auto group-focus-within:translate-y-0
                                       transition-all duration-200"
                            >
                                @foreach($item['children'] as $child)
                                    <a
                                        href="{{ $child['url'] }}"
                                        @if($child['open_in_new_tab']) target="_blank" rel="noopener noreferrer" @endif
                                        class="block px-6 py-4 hover:bg-gray-50 transition-colors @if(!$loop->first) border-t border-gray-100 @endif"
                                    >
                                        {{ $child['label'] }}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @else
                        <a
                            href="{{ $item['url'] }}"
                            @if($item['open_in_new_tab']) target="_blank" rel="noopener noreferrer" @endif
                            class="text-gray-900 hover:text-[#F2613F] transition-colors"
                        >
                            {{ $item['label'] }}
                        </a>
                    @endif
                @endforeach

                <!-- Login button -->
                <a
                    href="#"
                    class="group ml-2 bg-[#F2613F] text-white
                           font-bold text-[16px] leading-[22px]
                           px-6 py-3 rounded-full
                           hover:bg-[#d94e2e] hover:shadow-lg hover:shadow-[#F2613F]/30
                           transition-all duration-300
                           flex items-center gap-2"
                >
                    Log in
                    <span class="arrow-hover">→</span>
                </a>
            </div>

            <!-- Mobile hamburger -->
            <button
                class="md:hidden relative w-10 h-10 flex items-center justify-center"
                aria-label="Menu"
            >
                <span class="sr-only">Menu</span>
                <span
                    class="absolute block h-0.5 w-6 bg-gray-900 transition-all duration-300 ease-in-out"
                    :class="open ? 'rotate-45' : '-translate-y-2'"
                ></span>
                <span
                    class="absolute block h-0.5 w-6 bg-gray-900 transition-all duration-300 ease-in-out"
                    :class="open ? 'opacity-0 scale-0' : ''"
                ></span>
                <span
                    class="absolute block h-0.5 w-6 bg-gray-900 transition-all duration-300 ease-in-out"
                    :class="open ? '-rotate-45' : 'translate-y-2'"
                ></span>
            </button>
        </div>

        <!-- Mobile menu -->
        <div
            class="md:hidden border-t bg-white"
        >
            <div class="flex flex-col px-6 py-6 gap-5
                        font-bold text-[16px] leading-[22px]">
                <a href="#" class="text-gray-900">Home</a>

                <!-- Mobile Dropdown -->
                <div>
                    <button
                        class="flex justify-between w-full text-gray-900"
                    >
                        Namen voor je huisdieren
                        <svg
                            class="w-4 h-4 transition-transform duration-200"
                            :class="mobileDropdown ? 'rotate-180' : ''"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <div
                        class="pl-4 mt-3 flex flex-col gap-3 font-normal text-[15px]"
                    >
                        <a href="#">Hondennamen</a>
                        <a href="#">Kattennamen</a>
                        <a href="#">Vogelnamen</a>
                    </div>
                </div>

                <a href="#" class="text-gray-900">Blog</a>
                <a href="#" class="text-gray-900">Contact</a>

                <a
                    href="#"
                    class="group mt-2 bg-[#F2613F] text-white text-center
                           font-bold text-[16px]
                           py-3 rounded-full
                           hover:bg-[#d94e2e] transition-all duration-300
                           flex items-center justify-center gap-2"
                >
                    Log in
                    <span class="arrow-hover">→</span>
                </a>
            </div>
        </div>
    </nav>
</header>

