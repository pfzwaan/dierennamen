<?php

namespace App\Filament\Pages;

use App\Models\GlobalContent;
use BackedEnum;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use UnitEnum;

class GlobalContents extends Page implements HasForms
{
    use InteractsWithForms;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedGlobeAlt;

    protected static ?string $navigationLabel = 'Global Contents';

    protected static UnitEnum|string|null $navigationGroup = 'Content';

    protected static ?int $navigationSort = 110;

    protected string $view = 'filament.pages.global-contents';

    public ?array $data = [];

    public function mount(): void
    {
        $globalContent = GlobalContent::singleton();

        $this->form->fill($globalContent->only([
            'header_cta_label',
            'header_cta_url',
            'footer_title_1',
            'footer_content_1',
            'footer_title_2',
            'footer_content_2',
            'footer_title_3',
            'footer_content_3',
            'footer_title_4',
            'footer_content_4',
        ]));
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->statePath('data')
            ->components([
                Section::make('Header')
                    ->schema([
                        TextInput::make('header_cta_label')
                            ->label('CTA Label')
                            ->maxLength(255),
                        TextInput::make('header_cta_url')
                            ->label('CTA URL')
                            ->url()
                            ->maxLength(2048),
                    ])
                    ->columns(2),

                Section::make('Footer')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextInput::make('footer_title_1')
                                    ->label('Footer Title 1')
                                    ->maxLength(255),
                                TextInput::make('footer_title_2')
                                    ->label('Footer Title 2')
                                    ->maxLength(255),
                                TextInput::make('footer_title_3')
                                    ->label('Footer Title 3')
                                    ->maxLength(255),
                                TextInput::make('footer_title_4')
                                    ->label('Footer Title 4')
                                    ->maxLength(255),
                            ]),

                        RichEditor::make('footer_content_1')
                            ->label('Footer Content 1')
                            ->columnSpanFull(),
                        RichEditor::make('footer_content_2')
                            ->label('Footer Content 2')
                            ->columnSpanFull(),
                        RichEditor::make('footer_content_3')
                            ->label('Footer Content 3')
                            ->columnSpanFull(),
                        RichEditor::make('footer_content_4')
                            ->label('Footer Content 4')
                            ->columnSpanFull(),
                    ]),
            ]);
    }

    public function save(): void
    {
        $globalContent = GlobalContent::singleton();

        $globalContent->fill($this->form->getState());
        $globalContent->save();

        Notification::make()
            ->title('Global contents updated')
            ->success()
            ->send();
    }
}
