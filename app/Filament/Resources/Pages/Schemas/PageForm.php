<?php

namespace App\Filament\Resources\Pages\Schemas;

use Awcodes\Curator\Components\Forms\CuratorPicker;
use Filament\Actions\Action;
use Filament\Forms\Components\Builder;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Flex;
use Filament\Schemas\Components\Fieldset;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;

class PageForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Flex::make([
                    Section::make('Page Content')
                        ->grow(true)
                        ->schema([
                            TextInput::make('title')
                                ->required()
                                ->maxLength(255),

                            Select::make('site_id')
                                ->label('Site')
                                ->relationship('site', 'name')
                                ->searchable()
                                ->preload()
                                ->required(),

                            TextInput::make('slug')
                                ->maxLength(255)
                                ->unique(ignoreRecord: true)
                                ->helperText('Optional. If left blank, it is generated from title.'),

                            Builder::make('content')
                                ->blocks([
                                    Builder\Block::make('heading')
                                        ->schema([
                                            TextInput::make('text')
                                                ->label('Heading')
                                                ->required()
                                                ->maxLength(255),
                                        ]),
                                    Builder\Block::make('paragraph')
                                        ->schema([
                                            Textarea::make('text')
                                                ->label('Paragraph')
                                                ->required()
                                                ->rows(5),
                                        ]),
                                    Builder\Block::make('image')
                                        ->schema([
                                            CuratorPicker::make('image')
                                                ->label('Image')
                                                ->required(),
                                            TextInput::make('alt')
                                                ->label('Alt text')
                                                ->maxLength(255),
                                        ]),
                                    Builder\Block::make('hero_section')
                                        ->label('Hero Section')
                                        ->schema([
                                            CuratorPicker::make('background_image')
                                                ->label('Background image')
                                                ->required(),
                                            CuratorPicker::make('shape_image')
                                                ->label('Shape image (optional)'),
                                            TextInput::make('title_prefix')
                                                ->label('Title prefix')
                                                ->required()
                                                ->maxLength(255)
                                                ->default('Vind de perfecte'),
                                            TextInput::make('title_highlight')
                                                ->label('Title highlight')
                                                ->required()
                                                ->maxLength(255)
                                                ->default('naam'),
                                            TextInput::make('title_suffix')
                                                ->label('Title suffix')
                                                ->required()
                                                ->maxLength(255)
                                                ->default('voor je huisdier'),
                                            Textarea::make('subtitle')
                                                ->label('Subtitle')
                                                ->required()
                                                ->rows(3)
                                                ->default('Pas je zoekopdracht aan en ontdek duizenden namen voor honden, katten, vogels, vissen en meer.'),
                                        ]),
                                    Builder\Block::make('animal_blocks')
                                        ->label('Animal Blocks')
                                        ->schema([
                                            Repeater::make('cards')
                                                ->label('Cards')
                                                ->schema([
                                                    TextInput::make('title')
                                                        ->required()
                                                        ->maxLength(255),
                                                    Textarea::make('description')
                                                        ->required()
                                                        ->rows(2),
                                                    TextInput::make('button_label')
                                                        ->required()
                                                        ->maxLength(255),
                                                    TextInput::make('url')
                                                        ->label('Button URL')
                                                        ->maxLength(2048),
                                                    CuratorPicker::make('icon')
                                                        ->label('Icon'),
                                                ])
                                                ->minItems(9)
                                                ->maxItems(9)
                                                ->default([
                                                    ['title' => 'Hondennamen', 'description' => 'Bekijk snel onze hondennamen voor uw reu of teefje.', 'button_label' => 'Alle hondennamen', 'url' => '#'],
                                                    ['title' => 'Kattennamen', 'description' => 'Bekijk snel onze kattennamen voor uw kater of poes.', 'button_label' => 'Alle kattennamen', 'url' => '#'],
                                                    ['title' => 'Paardennamen', 'description' => 'Bekijk snel onze paardennamen.', 'button_label' => 'Alle paardennamen', 'url' => '#'],
                                                    ['title' => 'Konijnennamen', 'description' => 'Bekijk snel onze konijnennamen.', 'button_label' => 'Alle konijnennamen', 'url' => '#'],
                                                    ['title' => 'Vissennamen', 'description' => 'Bekijk snel onze visnamen.', 'button_label' => 'Alle visnamen', 'url' => '#'],
                                                    ['title' => 'Vogelnamen', 'description' => 'Bekijk snel onze vogelnamen.', 'button_label' => 'Alle vogelnamen', 'url' => '#'],
                                                    ['title' => 'Cavianamen', 'description' => 'Bekijk snel onze cavianamen.', 'button_label' => 'Alle cavianamen', 'url' => '#'],
                                                    ['title' => 'Kippennamen', 'description' => 'Bekijk snel onze kippennamen.', 'button_label' => 'Alle kippennamen', 'url' => '#'],
                                                    ['title' => 'Hamsternamen', 'description' => 'Bekijk snel onze hamsternamen.', 'button_label' => 'Alle hamsternamen', 'url' => '#'],
                                                ])
                                                ->columnSpanFull(),
                                        ]),
                                    Builder\Block::make('blogs_section')
                                        ->label('Blogs Section')
                                        ->schema([
                                            TextInput::make('heading_highlight')
                                                ->label('Heading highlight')
                                                ->required()
                                                ->maxLength(255)
                                                ->default('Meer dan een naam:'),
                                            TextInput::make('heading_text')
                                                ->label('Heading text')
                                                ->required()
                                                ->maxLength(255)
                                                ->default('Blog en tips voor het kiezen van de ideale naam'),
                                            CuratorPicker::make('featured_image')
                                                ->label('Featured image')
                                                ->required(),
                                            TextInput::make('featured_title')
                                                ->label('Featured title')
                                                ->required()
                                                ->maxLength(255)
                                                ->default('Veelgemaakte fouten bij het kiezen van een naam voor een hond of kat.'),
                                            Textarea::make('featured_excerpt')
                                                ->label('Featured excerpt')
                                                ->required()
                                                ->rows(4)
                                                ->default('Een van de meest voorkomende fouten bij het kiezen van een huisdiernaam is het kiezen van een naam die te lang of te ingewikkeld is. Dit kan het moeilijk maken voor het huisdier om de naam te leren en er correct op te reageren. Een andere veelgemaakte fout is het constant veranderen van de naam.'),
                                            TextInput::make('featured_button_label')
                                                ->label('Featured button label')
                                                ->required()
                                                ->maxLength(255)
                                                ->default('Lees meer'),
                                            TextInput::make('featured_url')
                                                ->label('Featured URL')
                                                ->maxLength(2048)
                                                ->default('#'),
                                            TextInput::make('featured_tags')
                                                ->label('Featured tags')
                                                ->maxLength(255)
                                                ->default('#fouten bij het kiezen van huisdiernamen #hondennamen #kattennamen'),
                                            Repeater::make('cards')
                                                ->label('Blog cards')
                                                ->schema([
                                                    CuratorPicker::make('image')
                                                        ->label('Image')
                                                        ->required(),
                                                    TextInput::make('title')
                                                        ->required()
                                                        ->maxLength(255),
                                                    Textarea::make('excerpt')
                                                        ->required()
                                                        ->rows(3),
                                                    TextInput::make('button_label')
                                                        ->required()
                                                        ->maxLength(255)
                                                        ->default('Lees meer'),
                                                    TextInput::make('url')
                                                        ->label('URL')
                                                        ->maxLength(2048)
                                                        ->default('#'),
                                                ])
                                                ->minItems(3)
                                                ->maxItems(3)
                                                ->default([
                                                    ['title' => 'Hoe kies je de perfecte naam voor je huisdier?', 'excerpt' => 'Het kiezen van de perfecte naam voor je huisdier is een van de eerste beslissingen...', 'button_label' => 'Lees meer', 'url' => '#'],
                                                    ['title' => 'Is een korte of lange naam beter voor een huisdier?', 'excerpt' => 'Korte namen zijn meestal de beste optie voor de meeste huisdieren.', 'button_label' => 'Lees meer', 'url' => '#'],
                                                    ['title' => 'Ideeen en tips ter inspiratie bij het kiezen van een naam', 'excerpt' => 'Weet je niet welke naam je moet kiezen? Er zijn talloze inspiratiebronnen.', 'button_label' => 'Lees meer', 'url' => '#'],
                                                ])
                                                ->columnSpanFull(),
                                            TextInput::make('cta_label')
                                                ->label('CTA label')
                                                ->required()
                                                ->maxLength(255)
                                                ->default('Bekijk alle blogposts'),
                                            TextInput::make('cta_url')
                                                ->label('CTA URL')
                                                ->maxLength(2048)
                                                ->default('#'),
                                        ]),
                                    Builder\Block::make('top_10_section')
                                        ->label('Top 10 Section')
                                        ->schema([
                                            TextInput::make('left_title')
                                                ->label('Left column title')
                                                ->required()
                                                ->maxLength(255)
                                                ->default('Top 10 namen voor mannelijke en vrouwelijke honden'),
                                            Repeater::make('left_items')
                                                ->label('Left items')
                                                ->schema([
                                                    TextInput::make('name')
                                                        ->label('Name')
                                                        ->required()
                                                        ->maxLength(255),
                                                ])
                                                ->minItems(10)
                                                ->maxItems(10)
                                                ->default([
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
                                                ]),
                                            TextInput::make('right_title')
                                                ->label('Right column title')
                                                ->required()
                                                ->maxLength(255)
                                                ->default('Top 10 originele namen voor katten'),
                                            Repeater::make('right_items')
                                                ->label('Right items')
                                                ->schema([
                                                    TextInput::make('name')
                                                        ->label('Name')
                                                        ->required()
                                                        ->maxLength(255),
                                                ])
                                                ->minItems(10)
                                                ->maxItems(10)
                                                ->default([
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
                                                ]),
                                        ]),
                                    Builder\Block::make('new_names_section')
                                        ->label('Nieuwe Namen Section')
                                        ->schema([
                                            TextInput::make('title')
                                                ->label('Title')
                                                ->required()
                                                ->maxLength(255)
                                                ->default('Nieuwe namen toegevoegd in 2026'),
                                            Repeater::make('items')
                                                ->label('Items')
                                                ->schema([
                                                    TextInput::make('name')
                                                        ->label('Name')
                                                        ->required()
                                                        ->maxLength(255),
                                                    TextInput::make('category')
                                                        ->label('Category')
                                                        ->required()
                                                        ->maxLength(255),
                                                ])
                                                ->minItems(8)
                                                ->maxItems(8)
                                                ->default([
                                                    ['name' => 'Uraia', 'category' => 'Hondennamen'],
                                                    ['name' => 'Vlekje', 'category' => 'Hondennamen'],
                                                    ['name' => 'Femke', 'category' => 'Cavionamen'],
                                                    ['name' => 'Katra', 'category' => 'Vissennamen'],
                                                    ['name' => 'Ash', 'category' => 'Paardennamen'],
                                                    ['name' => 'Cindy', 'category' => 'Kattennamen'],
                                                    ['name' => 'Katra', 'category' => 'Kattennamen'],
                                                    ['name' => 'Femke', 'category' => 'Cavionamen'],
                                                ]),
                                        ]),
                                    Builder\Block::make('content_block_section')
                                        ->label('Content Block Section')
                                        ->schema([
                                            TextInput::make('intro_title')
                                                ->label('Intro title')
                                                ->required()
                                                ->maxLength(255)
                                                ->default('Vind de perfecte naam voor je huisdier'),
                                            Textarea::make('intro_text')
                                                ->label('Intro text')
                                                ->required()
                                                ->rows(4)
                                                ->default('Het kiezen van de ideale naam voor een huisdier is een belangrijke beslissing. Een naam identificeert niet alleen je huisdier, maar weerspiegelt ook zijn of haar persoonlijkheid, stijl en de speciale band die jullie delen. Op deze site vind je een breed scala aan huisdiernamen, ontworpen om je te helpen de beste keuze te maken.'),
                                            TextInput::make('section_heading')
                                                ->label('Section heading')
                                                ->required()
                                                ->maxLength(255)
                                                ->default('Namen voor honden en andere huisdieren'),
                                            Textarea::make('section_text')
                                                ->label('Section text')
                                                ->required()
                                                ->rows(4)
                                                ->default('Hondennamen zijn vaak populair, omdat honden het meest gekozen huisdier zijn. Toch verdienen ook andere huisdieren, zoals katten, konijnen, vogels en hamsters, aandacht bij het kiezen van een geschikte naam. Op deze site vind je top-10-lijsten, populaire lijsten en suggesties voor zowel mannelijke als vrouwelijke huisdieren.'),
                                            TextInput::make('subheading_1')
                                                ->label('Sub heading 1')
                                                ->required()
                                                ->maxLength(255)
                                                ->default('Hoe kies je de beste naam voor je huisdier?'),
                                            Textarea::make('subtext_1')
                                                ->label('Sub text 1')
                                                ->required()
                                                ->rows(3)
                                                ->default('Het kiezen van een naam voor je huisdier hoeft niet ingewikkeld te zijn. Een goede naam moet makkelijk te onthouden zijn, prettig klinken en geschikt zijn voor het dier en de levensfase. Vermijd namen die te lang zijn of lijken op commando\'s.'),
                                            TextInput::make('subheading_2')
                                                ->label('Sub heading 2')
                                                ->required()
                                                ->maxLength(255)
                                                ->default('Ideeen voor huisdiernamen, toplijsten en zoekmachine'),
                                            Textarea::make('subtext_2')
                                                ->label('Sub text 2')
                                                ->required()
                                                ->rows(3)
                                                ->default('Naast inspiratie en voorbeelden biedt onze site ook een zoekmachine voor huisdiernamen. Hiermee kun je filteren op diersoort, geslacht of persoonlijkheid. Zo vind je snel een naam die perfect past bij jouw huisdier.'),
                                            TextInput::make('subheading_3')
                                                ->label('Sub heading 3')
                                                ->required()
                                                ->maxLength(255)
                                                ->default('Jouw vertrouwde plek voor huisdiernamen'),
                                            Textarea::make('subtext_3')
                                                ->label('Sub text 3')
                                                ->required()
                                                ->rows(3)
                                                ->default('Deze site is ontworpen om de bron te worden voor iedereen die op zoek is naar mooie, originele en populaire huisdiernamen. Of je nu een puppy, kitten, vogel of ander dier hebt geadopteerd, hier vind je ideeen die passen bij jouw huisdier.'),
                                        ]),
                                    Builder\Block::make('alphabet_section')
                                        ->label('Alphabet Section')
                                        ->schema([
                                            TextInput::make('title')
                                                ->label('Title')
                                                ->required()
                                                ->maxLength(255)
                                                ->default('Namen op alfabet'),
                                            Repeater::make('letters')
                                                ->label('Letters')
                                                ->schema([
                                                    TextInput::make('label')
                                                        ->label('Letter')
                                                        ->required()
                                                        ->maxLength(2),
                                                    TextInput::make('url')
                                                        ->label('URL')
                                                        ->maxLength(2048)
                                                        ->default('#'),
                                                ])
                                                ->minItems(26)
                                                ->maxItems(26)
                                                ->default([
                                                    ['label' => 'A', 'url' => '#'], ['label' => 'B', 'url' => '#'], ['label' => 'C', 'url' => '#'], ['label' => 'D', 'url' => '#'], ['label' => 'E', 'url' => '#'], ['label' => 'F', 'url' => '#'], ['label' => 'G', 'url' => '#'], ['label' => 'H', 'url' => '#'], ['label' => 'I', 'url' => '#'], ['label' => 'J', 'url' => '#'], ['label' => 'K', 'url' => '#'], ['label' => 'L', 'url' => '#'], ['label' => 'M', 'url' => '#'], ['label' => 'N', 'url' => '#'], ['label' => 'O', 'url' => '#'], ['label' => 'P', 'url' => '#'], ['label' => 'Q', 'url' => '#'], ['label' => 'R', 'url' => '#'], ['label' => 'S', 'url' => '#'], ['label' => 'T', 'url' => '#'], ['label' => 'U', 'url' => '#'], ['label' => 'V', 'url' => '#'], ['label' => 'W', 'url' => '#'], ['label' => 'X', 'url' => '#'], ['label' => 'Y', 'url' => '#'], ['label' => 'Z', 'url' => '#'],
                                                ]),
                                        ]),
                                    Builder\Block::make('contact')
                                        ->label('Contact')
                                        ->schema([
                                            TextInput::make('title')
                                                ->label('Title override')
                                                ->maxLength(255)
                                                ->helperText('Optional. If empty, value from Contact Forms settings is used.'),
                                            Textarea::make('intro')
                                                ->label('Intro override')
                                                ->rows(3)
                                                ->helperText('Optional. If empty, value from Contact Forms settings is used.'),
                                            Fieldset::make('Form settings')
                                                ->schema([
                                                    TextInput::make('send_to_email')
                                                        ->label('Send form to email')
                                                        ->email()
                                                        ->maxLength(255)
                                                        ->helperText('Recipient email for contact form submissions.'),
                                                ]),
                                        ]),
                                ])
                                ->columnSpanFull(),
                        ]),

                    Section::make('Publish')
                        ->grow(false)
                        ->extraAttributes(['class' => 'w-full lg:max-w-sm'])
                        ->schema([
                            Select::make('status')
                                ->options([
                                    'draft' => 'Draft',
                                    'published' => 'Published',
                                ])
                                ->default('draft')
                                ->required()
                                ->suffixAction(
                                    Action::make('publish')
                                        ->label('Publish')
                                        ->action(fn (Set $set) => $set('status', 'published'))
                                ),
                        ]),
                ])
                    ->from('lg')
                    ->columnSpanFull(),
            ]);
    }
}
