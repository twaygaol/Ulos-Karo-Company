<?php

namespace App\Filament\Resources\UmkmProfiles\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class UmkmProfileInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Profil UMKM')
                ->schema([
                    TextEntry::make('name')->label('Nama UMKM'),
                    TextEntry::make('phone')->label('No. HP'),
                    TextEntry::make('address')
                        ->label('Alamat')
                        ->columnSpanFull(),
                ])
                ->columns(2),

            Section::make('Lokasi')
                ->schema([
                    TextEntry::make('latitude')
                        ->label('Latitude')
                        ->numeric(decimalPlaces: 7)
                        ->placeholder('-'),

                    TextEntry::make('longitude')
                        ->label('Longitude')
                        ->numeric(decimalPlaces: 7)
                        ->placeholder('-'),

                    TextEntry::make('map_url')
                        ->label('Google Maps')
                        ->state(fn ($record): ?string => filled($record->latitude) && filled($record->longitude)
                            ? "https://www.google.com/maps?q={$record->latitude},{$record->longitude}"
                            : null)
                        ->url(fn (?string $state): ?string => $state)
                        ->openUrlInNewTab()
                        ->placeholder('-')
                        ->columnSpanFull(),
                ])
                ->columns(2),

            Section::make('Riwayat')
                ->schema([
                    TextEntry::make('created_at')
                        ->label('Dibuat')
                        ->dateTime('d M Y H:i'),

                    TextEntry::make('updated_at')
                        ->label('Diupdate')
                        ->dateTime('d M Y H:i'),
                ])
                ->columns(2),
        ]);
    }
}
