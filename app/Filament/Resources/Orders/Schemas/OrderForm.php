<?php

namespace App\Filament\Resources\Orders\Schemas;

use App\Models\product;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Filament\Forms\Components\Repeater;


class OrderForm
{
    public static function configure($schema)
    {
        return $schema->components([

            Select::make('user_id')
                ->label('Customer')
                ->relationship('user', 'name')
                ->searchable()
                ->required(),


            TextInput::make('order_number')
                ->default(fn() => 'ORD-' . time())
                ->disabled()
                ->dehydrated()
                ->required(),

            TextInput::make('total_price')
                ->numeric()
                ->disabled()
                ->dehydrated(),
            Repeater::make('items')
                ->schema([
                    Select::make('product_id')
                        ->label('Produk')
                        ->options(product::pluck('name', 'id'))
                        ->required()
                        ->searchable(),

                    TextInput::make('quantity')
                        ->numeric()
                        ->default(1)
                        ->required(),
                ])
                ->columns(2)
                ->required()


        ]);
    }
}
