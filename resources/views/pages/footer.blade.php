<!-- Main footer -->
<footer class="relative w-full bg-[#1E293B] text-white -mt-[40px] md:-mt-[80px]">
    <div class="absolute top-0 left-0 w-full">
        <svg viewBox="0 0 1440 120" preserveAspectRatio="none" class="w-full h-[60px] md:h-[120px]">
            <path id="footer-wave-fill" fill="#FFFFFF" d="
                    M0,70
                    C120,110 240,20 360,40
                    C480,60 600,120 720,90
                    C840,60 960,20 1080,40
                    C1200,60 1320,100 1440,70
                    L1440,0
                    L0,0
                    Z
                "></path>
        </svg>
    </div>
    <div class="max-w-container mx-auto px-[16px] md:px-[40px] lg:px-[60px] pt-[80px] md:pt-[160px] pb-[48px] md:pb-[64px]">

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-[32px] md:gap-[48px]">

            <!-- About -->
            <div>
                <div class="flex items-center gap-[10px] mb-[16px]">
                    <img src="{{ asset('img/logo.png') }}" class="h-[36px]" alt="">
                </div>

                <h4 class="font-semibold mb-[12px]">
                    Over Dierennamengids.nl
                </h4>

                <p class="text-[15px] leading-[26px] text-[#CBD5E1]">
                    Welkom op de website vol met dierennamen! Dierennamengids.nl
                    is de meest complete website in Nederland voor wat betreft
                    dierennamen. Of je nu zoekt naar namen voor een hond of konijn.
                    Dierennamengids.nl heeft voor ieder wat wils!
                </p>

                <div class="flex items-center gap-[12px] mt-[16px]">
                    <span class="text-[#CBD5E1]">Volg ons via:</span>
                    <a class="text-[#84CC16] text-lg" href="#">f</a>
                    <a class="text-[#84CC16] text-lg" href="#">o</a>
                </div>
            </div>

            <!-- Menu -->
            <div>
                <h4 class="font-[Fredoka] font-semibold text-[#84CC16] mb-[16px]">
                    Menu
                </h4>
                <ul class="space-y-[10px] text-[15px]">
                    <li>&rsaquo; Home</li>
                    <li>&rsaquo; Hondennamen</li>
                    <li>&rsaquo; Hondennamen reu</li>
                    <li>&rsaquo; Hondennamen teefje</li>
                    <li>&rsaquo; Kattennamen</li>
                    <li>&rsaquo; Paardennamen</li>
                    <li>&rsaquo; Kippennamen</li>
                    <li>&rsaquo; Konijnennamen</li>
                    <li>&rsaquo; Cavia namen</li>
                    <li>&rsaquo; Hamsternamen</li>
                    <li>&rsaquo; Vissennamen</li>
                    <li>&rsaquo; Vogelnamen</li>
                </ul>
            </div>

            <!-- Links -->
            <div>
                <h4 class="font-[Fredoka] font-semibold text-[#84CC16] mb-[16px]">
                    Handige links
                </h4>
                <ul class="space-y-[10px] text-[15px]">
                    <li>&rsaquo; Privacy Policy</li>
                    <li>&rsaquo; Disclaimer</li>
                    <li>&rsaquo; Over ons</li>
                    <li>&rsaquo; Adverteren</li>
                    <li>&rsaquo; Interessant</li>
                </ul>
            </div>

            <!-- Contact -->
            <div>
                <h4 class="font-[Fredoka] font-semibold text-[#84CC16] mb-[16px]">
                    Vragen?
                </h4>

                <p class="text-[15px] leading-[26px] text-[#CBD5E1]">
                    Bel ons gerust als u vragen heeft
                </p>

                <p class="mt-[12px] text-[15px]">
                    <span class="text-[#84CC16]">Ma - Vr :</span> 09.00 - 16.00
                </p>

                <p class="text-[15px]">
                    <span class="text-[#84CC16]">Weekend :</span> Gesloten
                </p>
            </div>

        </div>
    </div>

    <!-- Bottom bar -->
    <div class="border-t border-white/10">
        <div class="max-w-container mx-auto px-[16px] md:px-[40px] lg:px-[60px] py-[16px] text-[14px] text-[#CBD5E1]">
            Copyright 2008 - {{ now()->year }}
            <span class="text-[#84CC16] font-semibold">
                Dierennamengids.nl
            </span>
        </div>
    </div>
</footer>

<script>
document.addEventListener('DOMContentLoaded', function () {
    var wave = document.getElementById('footer-wave-fill');
    if (!wave) return;

    var fallback = '#FFFFFF';
    var sections = document.querySelectorAll('main section');
    var background = '';

    for (var i = sections.length - 1; i >= 0; i--) {
        var color = window.getComputedStyle(sections[i]).backgroundColor;
        if (color && color !== 'transparent' && color !== 'rgba(0, 0, 0, 0)') {
            background = color;
            break;
        }
    }

    wave.setAttribute('fill', background || fallback);
});
</script>
