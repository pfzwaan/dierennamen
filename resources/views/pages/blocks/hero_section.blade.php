@php($titlePrefix = $data['title_prefix'] ?? 'Vind de perfecte')
@php($titleHighlight = $data['title_highlight'] ?? 'naam')
@php($titleSuffix = $data['title_suffix'] ?? 'voor je huisdier')
@php($subtitle = $data['subtitle'] ?? 'Pas je zoekopdracht aan en ontdek duizenden namen voor honden, katten, vogels, vissen en meer.')
@php($backgroundImage = $data['background_image'] ?? null)
@php($shapeImage = $data['shape_image'] ?? null)
@php($backgroundImageUrl = $backgroundImage ? optional(\Awcodes\Curator\Models\Media::find($backgroundImage))->url : null)
@php($shapeImageUrl = $shapeImage ? optional(\Awcodes\Curator\Models\Media::find($shapeImage))->url : null)

<!-- hero section -->
<section class="w-full bg-white pt-[50px] md:pt-[100px] pb-[24px] md:pb-[48px]">
    <div class="max-w-container mx-auto px-[16px] md:px-[40px] lg:px-[60px]">

        <!-- Hero card -->
        <div class="relative rounded-[20px] md:rounded-[32px] overflow-hidden min-h-[500px] md:min-h-[560px]">

            <!-- Background image -->
            <img
                src="{{ $backgroundImageUrl ?: asset('img/bg.png') }}"
                alt="Huisdier"
                class="absolute inset-0 w-full h-full object-cover"
            />

            <!-- Dark overlay -->
            <div class="absolute inset-0 bg-black/45"></div>

            <!-- Content -->
            <div class="relative z-10 h-full flex flex-col items-center justify-center text-center px-[16px] md:px-[40px] py-[40px] md:py-[60px]">

                <!-- Title -->
                <h1 class="font-bold text-white leading-[1.1] mb-[16px] md:mb-[20px]
                           text-[28px] sm:text-[36px] md:text-[48px] lg:text-[64px] xl:text-[72px]">
                    {{ $titlePrefix }} <span class="text-[#8BC34A] relative inline-block">{{ $titleHighlight }}<img src="{{ $shapeImageUrl ?: asset('img/shape.png') }}" alt="" class="absolute bottom-[40px] right-0 translate-x-1/2 w-[20px] sm:w-[28px] md:w-[36px] lg:w-[44px]" /></span><br class="hidden sm:block">
                    {{ $titleSuffix }}
                </h1>

                <!-- Subtitle -->
                <p class="text-white/90 text-[14px] md:text-[16px] leading-[22px] md:leading-[24px] max-w-[640px] mb-[24px] md:mb-[36px]">
                    {{ $subtitle }}
                </p>

                <!-- Search bar -->
                <div class="relative w-full max-w-[1440px] bg-white rounded-[16px] md:rounded-[24px] px-[16px] md:px-[24px] py-[16px] md:py-[20px] shadow-lg font-sans">
                    <!-- Decorative image -->
                    <img src="{{ asset('img/home_3_sub_img.png') }}" alt="" class="absolute -top-[65px] -left-[10px] md:-top-[95px] md:-left-[15px] w-[40px] md:w-[60px] lg:w-[80px] pointer-events-none" />

                    <!-- Filters grid -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-[12px] md:gap-[16px]">

                        <!-- Huisdiersoort -->
                        <div class="text-left">
                            <label class="block text-[14px] md:text-[18px] font-semibold leading-[15px] text-[#111827] mb-[8px]">
                                Huisdiersoort:
                            </label>
                            <div class="relative">
                                <select
                                    class="w-full h-[44px] rounded-[8px] border border-[#E5E7EB]
                                        px-[12px] pr-[36px] appearance-none
                                        text-[14px] font-normal text-[#111827] bg-white">
                                    <option>Hond</option>
                                </select>
                                <svg
                                    class="pointer-events-none absolute right-[12px] top-1/2 -translate-y-1/2 w-4 h-4 text-[#F2643D]"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </div>
                        </div>

                        <!-- Geslacht -->
                        <div class="text-left">
                            <label class="block text-[14px] md:text-[18px] font-semibold leading-[15px] text-[#111827] mb-[8px]">
                                Geslacht:
                            </label>
                            <div class="relative">
                                <select
                                    class="w-full h-[44px] rounded-[8px] border border-[#E5E7EB]
                                        px-[12px] pr-[36px] appearance-none
                                        text-[14px] font-normal text-[#111827] bg-white">
                                    <option>Reutjes</option>
                                </select>
                                <svg
                                    class="pointer-events-none absolute right-[12px] top-1/2 -translate-y-1/2 w-4 h-4 text-[#F2643D]"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </div>
                        </div>

                        <!-- Ras -->
                        <div class="text-left">
                            <label class="block text-[14px] md:text-[18px] font-semibold leading-[15px] text-[#111827] mb-[8px]">
                                Ras:
                            </label>
                            <div class="relative">
                                <select
                                    class="w-full h-[44px] rounded-[8px] border border-[#E5E7EB]
                                        px-[12px] pr-[36px] appearance-none
                                        text-[14px] font-normal text-[#111827] bg-white">
                                    <option>Ander ras</option>
                                </select>
                                <svg
                                    class="pointer-events-none absolute right-[12px] top-1/2 -translate-y-1/2 w-4 h-4 text-[#F2643D]"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </div>
                        </div>

                        <!-- Keywords -->
                        <div class="text-left sm:col-span-2 lg:col-span-1">
                            <label class="block text-[14px] md:text-[18px] font-semibold leading-[15px] text-[#111827] mb-[8px]">
                                Trefwoorden:
                            </label>
                            <input
                                type="text"
                                placeholder="Trefwoorden invoeren"
                                class="w-full h-[44px] rounded-[8px] border border-[#E5E7EB]
                                    px-[12px]
                                    text-[14px] font-normal text-[#111827]
                                    placeholder:text-[#9CA3AF]"
                            />
                        </div>

                        <!-- Search button -->
                        <div class="flex items-end sm:col-span-2 lg:col-span-1">
                            <button
                                class="w-full lg:w-auto h-[44px] px-[28px] rounded-full
                                    bg-[#F2643D] text-white
                                    text-[14px] font-semibold
                                    hover:bg-[#E55630] transition
                                    flex items-center justify-center gap-[8px] whitespace-nowrap">
                                <svg
                                    class="w-4 h-4 text-white"
                                    xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M21 21l-4.35-4.35m1.6-5.15a6.75 6.75 0 11-13.5 0 6.75 6.75 0 0113.5 0z"/>
                                </svg>
                                Namen zoeken
                            </button>
                        </div>

                    </div>

                    <!-- Recent searches -->
                    <div class="flex flex-wrap items-center gap-[8px] mt-[16px] text-[13px]">
                        <span class="font-semibold text-[#111827]">
                            Uw recente zoekopdrachten:
                        </span>

                        <span class="inline-flex items-center gap-[6px]
                                    px-[10px] h-[24px]
                                    rounded-[4px] bg-[#1E293B]
                                    text-[13px] font-normal text-white cursor-pointer hover:bg-[#334155] transition">
                            Stoere
                            <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </span>

                        <span class="inline-flex items-center gap-[6px]
                                    px-[10px] h-[24px]
                                    rounded-[4px] bg-[#1E293B]
                                    text-[13px] font-normal text-white cursor-pointer hover:bg-[#334155] transition">
                            Krachtige
                            <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </span>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
