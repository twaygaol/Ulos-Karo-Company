<?php

namespace App\Filament\Resources\Orders\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class OrdersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('order_number')
                    ->label('Nomor Pesanan')
                    ->description(fn ($record): ?string => filled($record->shipping_name) ? 'Penerima: '.$record->shipping_name : null)
                    ->searchable()
                    ->sortable(),

                TextColumn::make('user.name')
                    ->label('Customer')
                    ->placeholder('-')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('total_price')
                    ->label('Total')
                    ->money('IDR')
                    ->alignEnd()
                    ->sortable(),

                TextColumn::make('status')
                    ->label('Pesanan')
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
                    })
                    ->searchable(),

                TextColumn::make('payment_status')
                    ->label('Pembayaran')
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

                TextColumn::make('items_count')
                    ->label('Item')
                    ->counts('items')
                    ->alignCenter()
                    ->sortable(),

                TextColumn::make('created_at')
                    ->label('Tanggal')
                    ->date('d M Y')
                    ->description(fn ($record): string => $record->created_at?->format('H:i').' WIB')
                    ->sortable()
                    ->toggleable(),

                TextColumn::make('updated_at')
                    ->label('Diupdate')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->striped()
            ->paginated([10, 25, 50])
            ->searchPlaceholder('Cari nomor pesanan atau customer')
            ->emptyStateIcon(Heroicon::OutlinedShoppingCart)
            ->emptyStateHeading('Belum ada transaksi')
            ->emptyStateDescription('Transaksi baru dari pelanggan akan muncul di halaman ini.')
            ->filters([
                SelectFilter::make('status')
                    ->label('Status Pesanan')
                    ->options([
                        'pending' => 'Pending',
                        'processing' => 'Diproses',
                        'shipped' => 'Dikirim',
                        'completed' => 'Selesai',
                        'cancelled' => 'Dibatalkan',
                    ]),

                SelectFilter::make('payment_status')
                    ->label('Status Pembayaran')
                    ->options([
                        'pending' => 'Pending',
                        'settlement' => 'Lunas',
                        'capture' => 'Capture',
                        'deny' => 'Ditolak',
                        'expire' => 'Kadaluarsa',
                        'cancel' => 'Dibatalkan',
                        'failure' => 'Gagal',
                    ]),
            ])
            ->defaultSort('created_at', 'desc')
            ->recordActions([
                ViewAction::make()
                    ->label('Detail'),
                EditAction::make()
                    ->label('Ubah'),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make()
                        ->label('Hapus dipilih'),
                ]),
            ]);
    }
}
