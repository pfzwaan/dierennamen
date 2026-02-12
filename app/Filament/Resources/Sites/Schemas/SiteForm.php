<?php

namespace App\Filament\Resources\Sites\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class SiteForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255)
                    ->unique(ignoreRecord: true),

                TextInput::make('slug')
                    ->maxLength(255)
                    ->unique(ignoreRecord: true)
                    ->helperText('Optional. If left blank, it is generated from name.'),

                TextInput::make('domain')
                    ->maxLength(255)
                    ->unique(ignoreRecord: true)
                    ->placeholder('example.com')
                    ->helperText('Optional. Domain for this site.'),

                TextInput::make('locale')
                    ->required()
                    ->maxLength(10)
                    ->default('nl'),

                Toggle::make('is_active')
                    ->label('Active')
                    ->default(true),
            ]);
    }
}
