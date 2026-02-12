<?php

namespace App\Filament\Resources\Names\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class NameForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->label('Name')
                    ->required()
                    ->maxLength(255),

                TextInput::make('slug')
                    ->maxLength(255)
                    ->unique(ignoreRecord: true)
                    ->helperText('Optional. If left blank, it is generated from name.'),

                Select::make('gender')
                    ->label('Gender')
                    ->options([
                        'male' => 'Male',
                        'female' => 'Female',
                    ])
                    ->searchable()
                    ->preload(),

                Select::make('name_category_id')
                    ->label('Name Category')
                    ->relationship('nameCategory', 'name')
                    ->required()
                    ->searchable()
                    ->preload(),
            ]);
    }
}
