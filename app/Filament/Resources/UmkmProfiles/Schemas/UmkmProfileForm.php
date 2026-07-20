<?php

namespace App\Filament\Resources\UmkmProfiles\Schemas;

use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class UmkmProfileForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Profil UMKM')
                    ->schema([
                        TextInput::make('name')
                            ->label('Nama UMKM')
                            ->required()
                            ->maxLength(255),

                        TextInput::make('phone')
                            ->label('No. HP')
                            ->tel()
                            ->required()
                            ->maxLength(255),

                        Textarea::make('address')
                            ->label('Alamat')
                            ->required()
                            ->rows(3)
                            ->columnSpanFull(),
                    ])
                    ->columns(2),

                Section::make('Lokasi')
                    ->schema([
                        TextInput::make('latitude')
                            ->label('Latitude')
                            ->numeric()
                            ->minValue(-90)
                            ->maxValue(90)
                            ->step(0.0000001)
                            ->placeholder('Contoh: 3.595196'),

                        TextInput::make('longitude')
                            ->label('Longitude')
                            ->numeric()
                            ->minValue(-180)
                            ->maxValue(180)
                            ->step(0.0000001)
                            ->placeholder('Contoh: 98.672226'),
                    ])
                    ->columns(2),
            ]);
    }
}
