@php
    $title = $data['title'] ?? 'Namen op alfabet';
    $lettersInput = $data['letters'] ?? [];
    $defaultLabels = range('A', 'Z');
    $letters = [];
    for ($i = 0; $i < 26; $i++) {
        $letters[$i] = [
            'label' => $lettersInput[$i]['label'] ?? $defaultLabels[$i],
            'url' => $lettersInput[$i]['url'] ?? '#',
        ];
    }
@endphp

<!-- blocks -->
<section class="relative w-full bg-[#9CCB4A] pt-[48px] md:pt-[80px] pb-[120px] md:pb-[160px]">
    <div class="max-w-container mx-auto px-6 text-center">

        <!-- Title -->
        <h2 class="font-[Fredoka] font-semibold
                   text-[40px] leading-[53px]
                   text-black mb-[40px]">
            {{ $title }}
        </h2>

        <!-- Alphabet grid -->
        <div class="flex flex-wrap justify-center gap-[16px] max-w-[1100px] mx-auto">
            @for($i = 0; $i < 26; $i++)
                <a href="{{ $letters[$i]['url'] ?: '#' }}" class="alphabet-btn">{{ $letters[$i]['label'] }}</a>
            @endfor
        </div>
    </div>
</section>
