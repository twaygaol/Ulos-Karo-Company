<?php

namespace App\Filament\Resources\UmkmProfiles\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class UmkmProfileForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                Textarea::make('address')
                    ->required()
                    ->columnSpanFull(),
                TextInput::make('phone')
                    ->tel()
                    ->required(),
                TextInput::make('latitude')
                    ->label('Latitude')
                    ->numeric()
                    ->step(0.0000001)
                    ->placeholder('Contoh: 3.595196'),

                TextInput::make('longitude')
                    ->label('Longitude')
                    ->numeric()
                    ->step(0.0000001)
                    ->placeholder('Contoh: 98.672226'),
            ]);
    }
}
