<?php

namespace App\Filament\Resources\Products\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([


                FileUpload::make('image')
                    ->image()
                    ->directory('products')
                    ->disk('public')
                    ->columnSpanFull()
                    ->label('Gambar Ulos')
                    ->required(),

                TextInput::make('name')
                    ->required()
                    ->label('Nama Ulos'),

                Textarea::make('description')
                    ->label('Deskripsi')
                    ->required()
                    ->rows(4),

                TextInput::make('jenis')
                    ->label('Jenis Ulos')
                    ->required(),

                TextInput::make('fungsi_adat')
                    ->label('Fungsi Adat')
                    ->required(),

                TextInput::make('price')
                    ->numeric()
                    ->prefix('Rp')
                    ->required(),

                TextInput::make('stock')
                    ->numeric()
                    ->required(),
            ])
            ->columns(2);

    }
}
