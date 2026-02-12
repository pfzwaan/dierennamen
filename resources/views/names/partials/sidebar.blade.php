<aside class="space-y-10 lg:col-span-4 xl:col-span-3">
    @php
        $blogItems = $blogItems ?? [
            [
                'title' => 'Veelgemaakte fouten bij het kiezen van een naam voor een hond of kat.',
                'url' => '#',
                'image' => 'img/figma/26909-241.png',
            ],
            [
                'title' => 'Hoe kies je de perfecte naam voor je huisdier?',
                'url' => '#',
                'image' => 'img/figma/26909-244.png',
            ],
            [
                'title' => 'Is een korte of lange naam beter voor een huisdier?',
                'url' => '#',
                'image' => 'img/figma/26909-247.png',
            ],
        ];
    @endphp

    <!-- from figma: 26909:249 -->
    <div>
        <h2 class="text-center font-fredoka text-[30px] font-medium leading-[30px]">{{ $title }}</h2>

        @if(!empty($ctaUrl))
            <a href="{{ $ctaUrl }}" class="mt-6 flex h-[60px] w-full items-center justify-center gap-3 rounded-[100px] bg-coral px-5 text-center text-[17px] font-semibold text-white">
                {{ $ctaText }}
                <img src="{{ asset('img/figma/26909-233.svg') }}" alt="" aria-hidden="true" class="h-3.5 w-4" />
            </a>
        @else
            <button type="button" class="mt-6 flex h-[60px] w-full items-center justify-center gap-3 rounded-[100px] bg-coral px-5 text-center text-[17px] font-semibold text-white">
                {{ $ctaText }}
                <img src="{{ asset('img/figma/26909-233.svg') }}" alt="" aria-hidden="true" class="h-3.5 w-4" />
            </button>
        @endif

        <div class="mt-6 rounded-[30px] bg-lime p-[15px]">
            <div class="rounded-[30px] bg-white px-7 py-8">
                <ul class="space-y-3 text-[24px] md:text-[28px] md:leading-[60px]">
                    @forelse($items as $item)
                        <li class="flex items-center gap-3">
                            <span class="inline-flex h-[39px] w-[39px] items-center justify-center rounded-full bg-ink">
                                <img src="{{ asset('img/figma/26909-199.svg') }}" alt="" aria-hidden="true" class="h-[18px] w-[18px]" />
                            </span>
                            <a href="{{ url('/names/' . $item->slug) }}">{{ $item->title }}</a>
                        </li>
                    @empty
                        <li class="text-[18px] leading-[30px]">{{ $emptyText ?? 'Nog geen namen beschikbaar.' }}</li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>

    <!-- from figma: 26909:235 -->
    <section class="rounded-[30px] bg-panel p-[23px]">
        <h3 class="font-fredoka text-[32px] font-medium leading-[40px]">Recente blogberichten</h3>
        <div class="mt-10 space-y-6">
            @foreach($blogItems as $index => $post)
                @php
                    $path = public_path($post['image']);
                    $imageAsset = file_exists($path) ? asset($post['image']) : asset('img/figma/26909-247.png');
                @endphp
                <article>
                    <a href="{{ $post['url'] }}" class="flex gap-3">
                        <img src="{{ $imageAsset }}" alt="" class="h-[75px] w-[104px] rounded-[10px] object-cover" />
                        <p class="font-fredoka text-[18px] font-medium leading-[25px] text-black">{{ $post['title'] }}</p>
                    </a>
                </article>
                @if($index < count($blogItems) - 1)
                    <div class="h-px w-full bg-[#e2e2e2]"></div>
                @endif
            @endforeach
        </div>
    </section>
</aside>
