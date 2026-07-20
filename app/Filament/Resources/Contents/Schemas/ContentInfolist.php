<?php

namespace App\Filament\Resources\Contents\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ContentInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Konten Website')
                    ->schema([
                        TextEntry::make('title')
                            ->label('Judul'),

                        TextEntry::make('type')
                            ->label('Tipe')
                            ->badge()
                            ->formatStateUsing(fn (string $state): string => match ($state) {
                                'sejarah' => 'Sejarah Ulos',
                                'profil_adat' => 'Profil Adat Karo',
                                'tentang' => 'Tentang Sistem',
                                'informasi' => 'Informasi Ulos',
                                default => ucfirst($state),
                            }),

                        TextEntry::make('body')
                            ->label('Isi Konten')
                            ->html()
                            ->columnSpanFull(),
                    ])
                    ->columns(2),

                Section::make('Riwayat')
                    ->schema([
                        TextEntry::make('created_at')
                            ->label('Dibuat')
                            ->dateTime()
                            ->placeholder('-'),

                        TextEntry::make('updated_at')
                            ->label('Diupdate')
                            ->dateTime()
                            ->placeholder('-'),
                    ])
                    ->columns(2),
            ]);
    }
}
