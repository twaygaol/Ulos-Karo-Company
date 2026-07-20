<?php

namespace App\Filament\Resources\Orders\Schemas;

use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class OrderInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informasi Pesanan')
                    ->schema([
                        TextEntry::make('order_number')
                            ->label('Nomor Pesanan'),

                        TextEntry::make('user.name')
                            ->label('Customer')
                            ->placeholder('-'),

                        TextEntry::make('total_price')
                            ->label('Total')
                            ->money('IDR'),

                        TextEntry::make('status')
                            ->label('Status Pesanan')
                            ->badge()
                            ->formatStateUsing(fn (string $state): string => match ($state) {
                                'processing' => 'Diproses',
                                'shipped' => 'Dikirim',
                                'completed' => 'Selesai',
                                'cancelled' => 'Dibatalkan',
                                default => 'Pending',
                            })
                            ->color(fn (string $state): string => match ($state) {
                                'processing', 'shipped' => 'warning',
                                'completed' => 'success',
                                'cancelled' => 'danger',
                                default => 'gray',
                            }),

                        TextEntry::make('payment_status')
                            ->label('Status Pembayaran')
                            ->badge()
                            ->formatStateUsing(fn (?string $state): string => match ($state) {
                                'settlement', 'capture' => 'Lunas',
                                'deny' => 'Ditolak',
                                'expire' => 'Kadaluarsa',
                                'cancel' => 'Dibatalkan',
                                'failure' => 'Gagal',
                                default => 'Pending',
                            })
                            ->color(fn (?string $state): string => match ($state) {
                                'settlement', 'capture' => 'success',
                                'deny', 'expire', 'cancel', 'failure' => 'danger',
                                default => 'warning',
                            }),

                        TextEntry::make('payment_type')
                            ->label('Metode Pembayaran')
                            ->placeholder('-'),
                    ])
                    ->columns(3),

                Section::make('Pengiriman')
                    ->schema([
                        TextEntry::make('shipping_name')
                            ->label('Nama Penerima')
                            ->placeholder('-'),

                        TextEntry::make('shipping_phone')
                            ->label('No. HP')
                            ->placeholder('-'),

                        TextEntry::make('shipping_address')
                            ->label('Alamat')
                            ->placeholder('-')
                            ->columnSpanFull(),
                    ])
                    ->columns(2),

                Section::make('Produk Dipesan')
                    ->schema([
                        RepeatableEntry::make('items')
                            ->label('Item Pesanan')
                            ->schema([
                                TextEntry::make('product.name')
                                    ->label('Produk'),

                                TextEntry::make('quantity')
                                    ->label('Jumlah')
                                    ->numeric(),

                                TextEntry::make('price')
                                    ->label('Harga Satuan')
                                    ->money('IDR'),
                            ])
                            ->columns(3),
                    ]),

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
