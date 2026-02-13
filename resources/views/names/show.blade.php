<!doctype html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $name->title }} - Dierennames</title>
    <meta name="description" content="Zoek hondennamen op basis van de beginletter.">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@400;500;600;700&family=Onest:wght@400;500;600&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css'])
</head>
<body class="bg-white text-slate-900">
@include('pages.header')

<main class="mx-auto w-full max-w-container px-6 py-8">
    <!-- from figma: 26787:1504 -->
    <p class="mb-6 text-sm text-ink md:text-[22px] md:leading-5">
        Home &gt; Hondennamen &gt; Reu &gt; Reutjesnamen met de letter A &gt; <span class="font-bold">{{ $name->title }}</span>
    </p>

    <!-- from figma: 26811:37 -->
    <section class="relative mb-10 overflow-hidden rounded-[30px] bg-ink md:rounded-[50px]">
        <div class="relative h-[220px] md:h-[267px]">
            <img src="{{ asset('img/figma/26811-27.svg') }}" alt="" aria-hidden="true" class="absolute right-6 top-0 hidden w-[220px] md:block" />
            <img src="{{ asset('img/figma/26811-32.svg') }}" alt="" aria-hidden="true" class="absolute bottom-0 left-5 hidden w-[220px] md:block" />
            <img src="{{ asset('img/figma/26811-25.svg') }}" alt="" aria-hidden="true" class="absolute left-20 top-8 hidden w-12 opacity-25 md:block md:w-[88px]" />
            <img src="{{ asset('img/figma/26811-36.svg') }}" alt="" aria-hidden="true" class="absolute bottom-2 right-24 hidden w-12 opacity-25 md:block md:w-[88px]" />
            <img src="{{ asset('img/figma/26811-23.svg') }}" alt="" aria-hidden="true" class="absolute right-0 top-0 hidden w-[220px] lg:block" />
            <div class="relative z-10 flex h-full items-center justify-center px-4 text-center">
                <!-- from figma: 26811:41 -->
                <h1 class="font-fredoka text-[40px] font-bold leading-tight text-green md:text-[70px] md:leading-[96px]">{{ $name->title }}</h1>
            </div>
            <img src="{{ asset('img/figma/26811-39.svg') }}" alt="" aria-hidden="true" class="absolute right-[36%] top-[18%] hidden w-[44px] md:block" />
        </div>
    </section>

    <!-- from figma: 26837:146 -->
    <section class="rounded-[30px] bg-panel p-6 md:p-12">
        <div class="grid gap-8 lg:grid-cols-2">
            <!-- from figma: 26821:36 -->
            <article class="space-y-4">
                <h2 class="font-fredoka text-2xl font-semibold md:text-[32px]">De populariteit van {{ $name->title }}</h2>
                <p class="text-[18px] leading-[35px]">
                    Hoewel {{ $name->title }} niet een van de meest voorkomende namen ter wereld is, laat de naam de laatste jaren een interessante en groeiende trend zien. Dit maakt het een unieke, moderne en bijzondere keuze voor uw hond.
                </p>
                <p class="text-[19px] leading-[35px]"><span class="font-semibold">Met naar schatting 281 keer gebruik in 2025</span> valt {{ $name->title }} in de categorie van exclusieve namen, ideaal voor huisdieren met een sterke persoonlijkheid.</p>
            </article>

            <!-- from figma: 26822:39 -->
            <article class="space-y-4">
                <h2 class="font-fredoka text-2xl font-semibold md:text-[32px]">Populariteitstrend door de tijd heen</h2>
                <p class="text-[19px] leading-[35px]">
                    In de Amerikaanse namenregisters begon {{ $name->title }} rond 2005 voor te komen en sindsdien is de populariteit ervan gefluctueerd. De laatste jaren is er een stijgende trend te zien, met een piek in het gebruik rond het begin van de jaren 2020.
                </p>
            </article>
        </div>
    </section>

    <!-- from figma: 26836:145 -->
    <section class="mt-9 grid gap-4 md:grid-cols-3">
        <button class="flex h-[117px] items-center justify-center gap-4 rounded-[20px] bg-ink text-white">
            <span class="text-[28px] font-bold">Like</span>
            <img src="{{ asset('img/figma/26836-133.svg') }}" alt="" aria-hidden="true" class="h-8 w-9" />
        </button>
        <button class="flex h-[117px] items-center justify-center gap-4 rounded-[20px] bg-panel text-ink">
            <span class="text-[28px] font-bold">Opslaan</span>
            <img src="{{ asset('img/figma/26835-123.svg') }}" alt="" aria-hidden="true" class="h-[43px] w-[43px]" />
        </button>
        <button class="flex h-[117px] items-center justify-center gap-4 rounded-[20px] bg-panel text-ink">
            <span class="text-[28px] font-bold">Comment</span>
            <img src="{{ asset('img/figma/26835-130.svg') }}" alt="" aria-hidden="true" class="h-[35px] w-[39px]" />
        </button>
    </section>

    <!-- from figma: 26787:1403 -->
    <section class="mt-16 space-y-5">
        <h2 class="font-fredoka text-2xl font-medium md:text-[24px]">Toelichting herkomst en betekenis</h2>
        <p class="text-[18px] leading-[35px]">
            De naam {{ $name->title }} vindt zijn oorsprong voornamelijk in het Oudengels en is afgeleid van het woord aesc, wat 'es' betekent. Deze boom is in verschillende culturen, waaronder de Noorse mythologie, een symbool geweest van kracht, veerkracht en bescherming.
        </p>
        <p class="text-[18px] leading-[35px]">
            Bovendien kan {{ $name->title }} ook worden gezien als een variant van de naam Ash of Asher. In moderne contexten wordt de naam geassocieerd met positieve betekenissen zoals 'gelukkig', 'gezegend' of 'fortuinlijk'.
        </p>
        <p class="text-[18px] leading-[35px]">
            Voor een hond combineert deze naam natuur, kracht, gratie en een nobel karakter; ideaal als je een krachtige naam met een diepe betekenis wilt.
        </p>
    </section>

    <!-- from figma: 26837:199 -->
    <section class="mt-16 space-y-7 rounded-[30px] bg-panel p-8 md:p-12">
        <div class="space-y-3">
            <h3 class="font-fredoka text-2xl font-medium md:text-[24px]">{{ $name->title }} in de bekende personen</h3>
            <p class="text-[18px] leading-[35px]">Hoewel de naam {{ $name->title }} niet extreem bekend is in de popcultuur, is hij wel in verschillende vormen opgedoken:</p>
        </div>
        <ul class="list-disc space-y-3 pl-6 text-[18px] leading-[35px]">
            <li><span class="font-semibold">{{ $name->title }} (Ashlyn Rae Willson)</span>: Amerikaanse singer-songwriter, bekend van "Moral of the Story".</li>
            <li>{{ $name->title }} - kampioen in League of Legends.</li>
            <li>{{ $name->title }} - personage in Final Fantasy XII.</li>
            <li>Ash - protagonist van Pokemon (Ash Ketchum).</li>
        </ul>
        <div class="space-y-3">
            <h3 class="font-fredoka text-2xl font-medium md:text-[24px]">Films en tv-series</h3>
            <p class="text-[18px] leading-[35px]">Hoewel {{ $name->title }} als specifieke naam niet centraal staat in veel films, zijn varianten zoals Ash wel te vinden in populaire fictie.</p>
        </div>
    </section>

    <!-- from figma: 26837:264 -->
    <section class="mt-16 rounded-[30px] bg-ink p-6 md:p-10">
        <h3 class="mb-6 font-fredoka text-xl font-medium text-white md:text-[24px]">Vergelijkbare namen met een vergelijkbare uitstraling</h3>
        <div class="rounded-[30px] bg-white p-6">
            <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
                <ul class="space-y-4 text-[28px] leading-6">
                    <li class="flex items-center gap-3"><span class="inline-flex h-[39px] w-[39px] items-center justify-center rounded-full bg-ink"><img src="{{ asset('img/figma/26837-270.svg') }}" alt="" aria-hidden="true" class="h-[18px] w-[18px]" /></span>Ash</li>
                    <li class="flex items-center gap-3"><span class="inline-flex h-[39px] w-[39px] items-center justify-center rounded-full bg-ink"><img src="{{ asset('img/figma/26837-270.svg') }}" alt="" aria-hidden="true" class="h-[18px] w-[18px]" /></span>Ace</li>
                </ul>
                <ul class="space-y-4 text-[28px] leading-6">
                    <li class="flex items-center gap-3"><span class="inline-flex h-[39px] w-[39px] items-center justify-center rounded-full bg-ink"><img src="{{ asset('img/figma/26837-270.svg') }}" alt="" aria-hidden="true" class="h-[18px] w-[18px]" /></span>Arlo</li>
                    <li class="flex items-center gap-3"><span class="inline-flex h-[39px] w-[39px] items-center justify-center rounded-full bg-ink"><img src="{{ asset('img/figma/26837-270.svg') }}" alt="" aria-hidden="true" class="h-[18px] w-[18px]" /></span>Axe</li>
                </ul>
                <ul class="space-y-4 text-[28px] leading-6">
                    <li class="flex items-center gap-3"><span class="inline-flex h-[39px] w-[39px] items-center justify-center rounded-full bg-ink"><img src="{{ asset('img/figma/26837-270.svg') }}" alt="" aria-hidden="true" class="h-[18px] w-[18px]" /></span>Ashby</li>
                    <li class="flex items-center gap-3"><span class="inline-flex h-[39px] w-[39px] items-center justify-center rounded-full bg-ink"><img src="{{ asset('img/figma/26837-270.svg') }}" alt="" aria-hidden="true" class="h-[18px] w-[18px]" /></span>Ashwin</li>
                </ul>
                <ul class="space-y-4 text-[28px] leading-6">
                    <li class="flex items-center gap-3"><span class="inline-flex h-[39px] w-[39px] items-center justify-center rounded-full bg-ink"><img src="{{ asset('img/figma/26837-270.svg') }}" alt="" aria-hidden="true" class="h-[18px] w-[18px]" /></span>Asher</li>
                    <li class="flex items-center gap-3"><span class="inline-flex h-[39px] w-[39px] items-center justify-center rounded-full bg-ink"><img src="{{ asset('img/figma/26837-270.svg') }}" alt="" aria-hidden="true" class="h-[18px] w-[18px]" /></span>Axel</li>
                </ul>
            </div>
        </div>
    </section>

    <section class="h-[100px] bg-white"></section>
</main>

@include('pages.footer')
</body>
</html>
