<?php

namespace App\Filament\Resources\Orders\Schemas;

use App\Models\Product;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class OrderForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informasi Pesanan')
                    ->schema([
                        Select::make('user_id')
                            ->label('Customer')
                            ->relationship('user', 'name')
                            ->searchable()
                            ->preload()
                            ->required(),

                        TextInput::make('order_number')
                            ->label('Nomor Pesanan')
                            ->default(fn () => 'ORD-'.now()->format('YmdHis'))
                            ->disabled()
                            ->dehydrated()
                            ->required(),

                        Select::make('status')
                            ->label('Status Pesanan')
                            ->options([
                                'pending' => 'Pending',
                                'processing' => 'Diproses',
                                'shipped' => 'Dikirim',
                                'completed' => 'Selesai',
                                'cancelled' => 'Dibatalkan',
                            ])
                            ->default('pending')
                            ->required(),

                        Select::make('payment_status')
                            ->label('Status Pembayaran')
                            ->options([
                                'pending' => 'Pending',
                                'settlement' => 'Lunas',
                                'capture' => 'Capture',
                                'deny' => 'Ditolak',
                                'expire' => 'Kadaluarsa',
                                'cancel' => 'Dibatalkan',
                                'failure' => 'Gagal',
                            ])
                            ->default('pending'),

                        TextInput::make('payment_type')
                            ->label('Metode Pembayaran')
                            ->maxLength(255),

                        TextInput::make('total_price')
                            ->label('Total')
                            ->numeric()
                            ->prefix('Rp')
                            ->default(0)
                            ->disabled()
                            ->dehydrated(),
                    ])
                    ->columns(2),

                Section::make('Pengiriman')
                    ->schema([
                        TextInput::make('shipping_name')
                            ->label('Nama Penerima')
                            ->maxLength(255),

                        TextInput::make('shipping_phone')
                            ->label('No. HP Penerima')
                            ->tel()
                            ->maxLength(255),

                        Textarea::make('shipping_address')
                            ->label('Alamat Pengiriman')
                            ->rows(3)
                            ->columnSpanFull(),
                    ])
                    ->columns(2),

                Section::make('Produk Dipesan')
                    ->schema([
                        Repeater::make('items')
                            ->label('Item Pesanan')
                            ->relationship()
                            ->schema([
                                Select::make('product_id')
                                    ->label('Produk')
                                    ->relationship('product', 'name')
                                    ->searchable()
                                    ->preload()
                                    ->required(),

                                TextInput::make('quantity')
                                    ->label('Jumlah')
                                    ->numeric()
                                    ->minValue(1)
                                    ->default(1)
                                    ->required(),

                                TextInput::make('price')
                                    ->label('Harga Satuan')
                                    ->numeric()
                                    ->prefix('Rp')
                                    ->default(0)
                                    ->dehydrated()
                                    ->required(),
                            ])
                            ->mutateRelationshipDataBeforeCreateUsing(fn (array $data): array => self::fillItemPrice($data))
                            ->mutateRelationshipDataBeforeSaveUsing(fn (array $data): array => self::fillItemPrice($data))
                            ->columns(3)
                            ->defaultItems(1)
                            ->reorderable(false)
                            ->required(),
                    ]),
            ]);
    }

    private static function fillItemPrice(array $data): array
    {
        if (! empty($data['product_id'])) {
            $data['price'] = Product::query()
                ->whereKey($data['product_id'])
                ->value('price') ?? ($data['price'] ?? 0);
        }

        $data['quantity'] = max(1, (int) ($data['quantity'] ?? 1));

        return $data;
    }

    public static function calculateTotal(array $items): float
    {
        return collect($items)
            ->sum(function (array $item): float {
                $price = Product::query()
                    ->whereKey($item['product_id'] ?? null)
                    ->value('price') ?? ($item['price'] ?? 0);

                return (float) $price * max(1, (int) ($item['quantity'] ?? 1));
            });
    }
}
