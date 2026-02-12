@php
    $title = $data['title'] ?? 'Nieuwe namen toegevoegd in 2026';
    $itemsInput = $data['items'] ?? [];
    $defaults = [
        ['name' => 'Uraia', 'category' => 'Hondennamen'],
        ['name' => 'Vlekje', 'category' => 'Hondennamen'],
        ['name' => 'Femke', 'category' => 'Cavionamen'],
        ['name' => 'Katra', 'category' => 'Vissennamen'],
        ['name' => 'Ash', 'category' => 'Paardennamen'],
        ['name' => 'Cindy', 'category' => 'Kattennamen'],
        ['name' => 'Katra', 'category' => 'Kattennamen'],
        ['name' => 'Femke', 'category' => 'Cavionamen'],
    ];
    $items = [];
    for ($i = 0; $i < 8; $i++) {
        $items[$i] = array_merge($defaults[$i], $itemsInput[$i] ?? []);
    }
@endphp

<!-- nieuwe namen -->
<section class="w-full bg-[#F3F6FB] py-[48px] md:py-[80px] relative overflow-hidden">

    <div class="relative max-w-container mx-auto px-[16px] md:px-[40px] lg:px-[60px]">

        <!-- Title -->
        <h2 class="text-center font-[Fredoka] font-semibold
                   text-[24px] leading-[32px]
                   md:text-[32px] md:leading-[40px]
                   text-[#111827] mb-[32px]">
            {{ $title }}
        </h2>

        <!-- Buttons grid: 4 per row -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-[16px]">
            @for($i = 0; $i < 8; $i++)
                <div class="bg-white rounded-[12px] px-[16px] py-[14px] shadow-sm text-center">
                    <div class="font-sans font-semibold text-[16px] text-[#111827]">
                        {{ $items[$i]['name'] }}
                    </div>
                    <div class="text-[12px] leading-[16px] text-[#6B7280]">
                        {{ $items[$i]['category'] }}
                    </div>
                </div>
            @endfor
        </div>

        <!-- Optional decorative animals -->
        <img src="{{ asset('img/hond.png') }}"
             class="hidden md:block absolute left-[-40px] bottom-[-20px] w-[120px]"
             alt="">

        <img src="{{ asset('img/kat.png') }}"
             class="hidden md:block absolute right-[-40px] bottom-[-20px] w-[140px]"
             alt="">

    </div>

</section>
