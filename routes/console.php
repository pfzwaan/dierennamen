<?php

use App\Models\Page;
use Awcodes\Curator\Models\Media;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('page:import-home-from-template', function () {
    $templateImageDir = base_path('plain-templates/img');

    if (! File::isDirectory($templateImageDir)) {
        $this->error("No se encontro la carpeta de imagenes: {$templateImageDir}");

        return 1;
    }

    $importImage = function (string $filename, ?string $alt = null) use ($templateImageDir): ?int {
        $sourcePath = $templateImageDir . DIRECTORY_SEPARATOR . $filename;

        if (! File::exists($sourcePath)) {
            $this->warn("Imagen no encontrada, se omite: {$filename}");

            return null;
        }

        $targetDirectory = 'home-import';
        $targetPath = $targetDirectory . '/' . $filename;
        $disk = Storage::disk('public');

        // Keep the imported file synced in the public disk used by Curator.
        $disk->put($targetPath, File::get($sourcePath));

        $imageSize = @getimagesize($sourcePath) ?: [null, null];
        $width = $imageSize[0] ?? null;
        $height = $imageSize[1] ?? null;

        $extension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
        $nameOnly = pathinfo($filename, PATHINFO_FILENAME);
        $prettyName = Str::of($nameOnly)
            ->replace(['-', '_'], ' ')
            ->title()
            ->value();

        $media = Media::query()->firstOrNew([
            'disk' => 'public',
            'path' => $targetPath,
        ]);

        $media->fill([
            'directory' => $targetDirectory,
            'visibility' => 'public',
            'name' => $nameOnly,
            'width' => $width,
            'height' => $height,
            'size' => File::size($sourcePath),
            'type' => File::mimeType($sourcePath) ?: 'application/octet-stream',
            'ext' => $extension,
            'alt' => $alt,
            'title' => $prettyName,
            'pretty_name' => $prettyName,
        ]);

        if (! $media->exists || $media->isDirty()) {
            $media->save();
        }

        return $media->getKey();
    };

    $mediaIds = [
        'hero_background' => $importImage('bg.png', 'Hero background'),
        'hero_shape' => $importImage('shape.png', 'Hero shape'),
        'animal_hond' => $importImage('hond.png', 'Hondennamen'),
        'animal_kat' => $importImage('kat.png', 'Kattennamen'),
        'animal_paard' => $importImage('paard.png', 'Paardennamen'),
        'animal_konijn' => $importImage('konijn.png', 'Konijnennamen'),
        'animal_vis' => $importImage('vis.png', 'Vissennamen'),
        'animal_vogel' => $importImage('vogel.png', 'Vogelnamen'),
        'animal_cavia' => $importImage('cavia.png', 'Cavianamen'),
        'animal_kip' => $importImage('kip.png', 'Kippennamen'),
        'animal_hamster' => $importImage('hamster.png', 'Hamsternamen'),
        'blog_featured' => $importImage('image24.png', 'Featured blog image'),
        'blog_card_1' => $importImage('pic2.png', 'Blog card 1'),
        'blog_card_2' => $importImage('pic3.png', 'Blog card 2'),
        'blog_card_3' => $importImage('pic4.png', 'Blog card 3'),
    ];

    $alphabet = [];

    foreach (range('A', 'Z') as $letter) {
        $alphabet[] = [
            'label' => $letter,
            'url' => '#',
        ];
    }

    $content = [
        [
            'type' => 'hero_section',
            'data' => [
                'background_image' => $mediaIds['hero_background'],
                'shape_image' => $mediaIds['hero_shape'],
                'title_prefix' => 'Vind de perfecte',
                'title_highlight' => 'naam',
                'title_suffix' => 'voor je huisdier',
                'subtitle' => 'Pas je zoekopdracht aan en ontdek duizenden namen voor honden, katten, vogels, vissen en meer.',
            ],
        ],
        [
            'type' => 'animal_blocks',
            'data' => [
                'cards' => [
                    ['title' => 'Hondennamen', 'description' => 'Bekijk snel onze hondennamen voor uw reu of teefje.', 'button_label' => 'Alle hondennamen', 'url' => '#', 'icon' => $mediaIds['animal_hond']],
                    ['title' => 'Kattennamen', 'description' => 'Bekijk snel onze kattennamen voor uw kater of poes.', 'button_label' => 'Alle kattennamen', 'url' => '#', 'icon' => $mediaIds['animal_kat']],
                    ['title' => 'Paardennamen', 'description' => 'Bekijk snel onze paardennamen.', 'button_label' => 'Alle paardennamen', 'url' => '#', 'icon' => $mediaIds['animal_paard']],
                    ['title' => 'Konijnennamen', 'description' => 'Bekijk snel onze konijnennamen.', 'button_label' => 'Alle konijnennamen', 'url' => '#', 'icon' => $mediaIds['animal_konijn']],
                    ['title' => 'Vissennamen', 'description' => 'Bekijk snel onze visnamen.', 'button_label' => 'Alle visnamen', 'url' => '#', 'icon' => $mediaIds['animal_vis']],
                    ['title' => 'Vogelnamen', 'description' => 'Bekijk snel onze vogelnamen.', 'button_label' => 'Alle vogelnamen', 'url' => '#', 'icon' => $mediaIds['animal_vogel']],
                    ['title' => 'Cavianamen', 'description' => 'Bekijk snel onze cavianamen.', 'button_label' => 'Alle cavianamen', 'url' => '#', 'icon' => $mediaIds['animal_cavia']],
                    ['title' => 'Kippennamen', 'description' => 'Bekijk snel onze kippennamen.', 'button_label' => 'Alle kippennamen', 'url' => '#', 'icon' => $mediaIds['animal_kip']],
                    ['title' => 'Hamsternamen', 'description' => 'Bekijk snel onze hamsternamen.', 'button_label' => 'Alle hamsternamen', 'url' => '#', 'icon' => $mediaIds['animal_hamster']],
                ],
            ],
        ],
        [
            'type' => 'blogs_section',
            'data' => [
                'heading_highlight' => 'Meer dan een naam:',
                'heading_text' => 'Blog en tips voor het kiezen van de ideale naam',
                'featured_image' => $mediaIds['blog_featured'],
                'featured_title' => 'Veelgemaakte fouten bij het kiezen van een naam voor een hond of kat.',
                'featured_excerpt' => 'Een van de meest voorkomende fouten bij het kiezen van een huisdiernaam is het kiezen van een naam die te lang of te ingewikkeld is. Dit kan het moeilijk maken voor het huisdier om de naam te leren en er correct op te reageren. Een andere veelgemaakte fout is het constant veranderen van de naam.',
                'featured_button_label' => 'Lees meer',
                'featured_url' => '#',
                'featured_tags' => '#fouten bij het kiezen van huisdiernamen #hondennamen #kattennamen',
                'cards' => [
                    ['image' => $mediaIds['blog_card_1'], 'title' => 'Hoe kies je de perfecte naam voor je huisdier?', 'excerpt' => 'Het kiezen van de perfecte naam voor je huisdier is een van de eerste beslissingen...', 'button_label' => 'Lees meer', 'url' => '#'],
                    ['image' => $mediaIds['blog_card_2'], 'title' => 'Is een korte of lange naam beter voor een huisdier?', 'excerpt' => 'Korte namen zijn meestal de beste optie voor de meeste huisdieren.', 'button_label' => 'Lees meer', 'url' => '#'],
                    ['image' => $mediaIds['blog_card_3'], 'title' => 'Ideeen en tips ter inspiratie bij het kiezen van een naam', 'excerpt' => 'Weet je niet welke naam je moet kiezen? Er zijn talloze inspiratiebronnen.', 'button_label' => 'Lees meer', 'url' => '#'],
                ],
                'cta_label' => 'Bekijk alle blogposts',
                'cta_url' => '#',
            ],
        ],
        [
            'type' => 'top_10_section',
            'data' => [
                'left_title' => "Top 10 namen voor mannelijke\nen vrouwelijke honden",
                'left_items' => [
                    ['name' => 'Max'],
                    ['name' => 'Buddy'],
                    ['name' => 'Joep'],
                    ['name' => 'Ollie'],
                    ['name' => 'Guus'],
                    ['name' => 'Luna'],
                    ['name' => 'Bella'],
                    ['name' => 'Pip'],
                    ['name' => 'Nala'],
                    ['name' => 'Lola'],
                ],
                'right_title' => "Top 10 originele namen\nvoor katten",
                'right_items' => [
                    ['name' => 'Simba'],
                    ['name' => 'Max'],
                    ['name' => 'Tommy'],
                    ['name' => 'Charlie'],
                    ['name' => 'Mickey'],
                    ['name' => 'Guus'],
                    ['name' => 'Gizmo'],
                    ['name' => 'Tijger'],
                    ['name' => 'Binky'],
                    ['name' => 'Toby'],
                ],
            ],
        ],
        [
            'type' => 'new_names_section',
            'data' => [
                'title' => 'Nieuwe namen toegevoegd in 2026',
                'items' => [
                    ['name' => 'Uraia', 'category' => 'Hondennamen'],
                    ['name' => 'Vlekje', 'category' => 'Hondennamen'],
                    ['name' => 'Femke', 'category' => 'Cavionamen'],
                    ['name' => 'Katra', 'category' => 'Vissennamen'],
                    ['name' => 'Ash', 'category' => 'Paardennamen'],
                    ['name' => 'Cindy', 'category' => 'Kattennamen'],
                    ['name' => 'Katra', 'category' => 'Kattennamen'],
                    ['name' => 'Femke', 'category' => 'Cavionamen'],
                ],
            ],
        ],
        [
            'type' => 'content_block_section',
            'data' => [
                'intro_title' => 'Vind de perfecte naam voor je huisdier',
                'intro_text' => 'Het kiezen van de ideale naam voor een huisdier is een belangrijke beslissing. Een naam identificeert niet alleen je huisdier, maar weerspiegelt ook zijn of haar persoonlijkheid, stijl en de speciale band die jullie delen. Op deze site vind je een breed scala aan huisdiernamen, ontworpen om je te helpen de beste keuze te maken.',
                'section_heading' => 'Namen voor honden en andere huisdieren',
                'section_text' => 'Hondennamen zijn vaak populair, omdat honden het meest gekozen huisdier zijn. Toch verdienen ook andere huisdieren, zoals katten, konijnen, vogels en hamsters, aandacht bij het kiezen van een geschikte naam. Op deze site vind je top-10-lijsten, populaire lijsten en suggesties voor zowel mannelijke als vrouwelijke huisdieren.',
                'subheading_1' => 'Hoe kies je de beste naam voor je huisdier?',
                'subtext_1' => 'Het kiezen van een naam voor je huisdier hoeft niet ingewikkeld te zijn. Een goede naam moet makkelijk te onthouden zijn, prettig klinken en geschikt zijn voor het dier en de levensfase. Vermijd namen die te lang zijn of lijken op commando\'s.',
                'subheading_2' => 'Ideeen voor huisdiernamen, toplijsten en zoekmachine',
                'subtext_2' => 'Naast inspiratie en voorbeelden biedt onze site ook een zoekmachine voor huisdiernamen. Hiermee kun je filteren op diersoort, geslacht of persoonlijkheid. Zo vind je snel een naam die perfect past bij jouw huisdier.',
                'subheading_3' => 'Jouw vertrouwde plek voor huisdiernamen',
                'subtext_3' => 'Deze site is ontworpen om de bron te worden voor iedereen die op zoek is naar mooie, originele en populaire huisdiernamen. Of je nu een puppy, kitten, vogel of ander dier hebt geadopteerd, hier vind je ideeen die passen bij jouw huisdier.',
            ],
        ],
        [
            'type' => 'alphabet_section',
            'data' => [
                'title' => 'Namen op alfabet',
                'letters' => $alphabet,
            ],
        ],
    ];

    $page = Page::query()->updateOrCreate(
        ['slug' => 'home'],
        [
            'title' => 'Home',
            'status' => 'published',
            'content' => $content,
        ]
    );

    $this->info("Pagina '{$page->slug}' importada/actualizada correctamente.");
    $this->line('Bloques cargados: ' . count($content));
    $this->line('Imagenes procesadas: ' . count($mediaIds));

    return 0;
})->purpose('Importa la Home desde plain-templates/index.php usando bloques del builder y Curator');
