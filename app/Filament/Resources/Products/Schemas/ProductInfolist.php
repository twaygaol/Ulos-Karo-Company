<?php

namespace App\Filament\Resources\Products\Schemas;

use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class ProductInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                ImageEntry::make('image')
                    ->label('Gambar'),

                TextEntry::make('name'),

                TextEntry::make('jenis'),

                TextEntry::make('fungsi_adat'),

                TextEntry::make('price')
                    ->money('IDR'),

                TextEntry::make('stock'),

                TextEntry::make('description'),
            ]);
    }
}
