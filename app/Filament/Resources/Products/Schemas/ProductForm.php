<?php

namespace App\Filament\Resources\Products\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informasi Produk')
                    ->schema([
                        FileUpload::make('image')
                            ->image()
                            ->directory('products')
                            ->disk('public')
                            ->imageEditor()
                            ->columnSpanFull()
                            ->label('Gambar Ulos'),

                        TextInput::make('name')
                            ->required()
                            ->maxLength(255)
                            ->label('Nama Ulos'),

                        TextInput::make('jenis')
                            ->label('Jenis Ulos')
                            ->required()
                            ->maxLength(255),

                        TextInput::make('fungsi_adat')
                            ->label('Fungsi Adat')
                            ->required()
                            ->maxLength(255),

                        TextInput::make('price')
                            ->label('Harga')
                            ->numeric()
                            ->prefix('Rp')
                            ->minValue(0)
                            ->required(),

                        TextInput::make('stock')
                            ->label('Stok')
                            ->numeric()
                            ->minValue(0)
                            ->required(),

                        Textarea::make('description')
                            ->label('Deskripsi')
                            ->required()
                            ->rows(4)
                            ->columnSpanFull(),
                    ])
                    ->columns(2),
            ])
            ->columns(2);

    }
}
