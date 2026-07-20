<?php

namespace App\Filament\Resources\Products\Schemas;

use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ProductInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Produk Ulos')
                    ->schema([
                        ImageEntry::make('image')
                            ->label('Gambar')
                            ->disk('public')
                            ->height(220)
                            ->placeholder('-')
                            ->columnSpanFull(),

                        TextEntry::make('name')
                            ->label('Nama Ulos'),

                        TextEntry::make('jenis')
                            ->label('Jenis'),

                        TextEntry::make('fungsi_adat')
                            ->label('Fungsi Adat'),

                        TextEntry::make('price')
                            ->label('Harga')
                            ->money('IDR'),

                        TextEntry::make('stock')
                            ->label('Stok')
                            ->badge()
                            ->color(fn (int $state): string => $state <= 0 ? 'danger' : ($state <= 5 ? 'warning' : 'success')),

                        TextEntry::make('description')
                            ->label('Deskripsi')
                            ->columnSpanFull(),
                    ])
                    ->columns(2),
            ]);
    }
}
