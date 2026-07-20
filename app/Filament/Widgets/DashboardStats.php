<?php

namespace App\Filament\Widgets;

use App\Models\Content;
use App\Models\Order;
use App\Models\Product;
use App\Models\UmkmProfile;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Number;

class DashboardStats extends StatsOverviewWidget
{
    protected ?string $pollingInterval = null;

    protected function getStats(): array
    {
        $paidStatuses = ['settlement', 'capture'];

        return [
            Stat::make('Produk Ulos', Product::query()->count())
                ->description('Total produk di katalog')
                ->descriptionIcon('heroicon-m-shopping-bag')
                ->color('primary'),

            Stat::make('Stok Rendah', Product::query()->where('stock', '<=', 5)->count())
                ->description('Produk dengan stok 5 atau kurang')
                ->descriptionIcon('heroicon-m-exclamation-triangle')
                ->color('warning'),

            Stat::make('Pesanan', Order::query()->count())
                ->description('Semua transaksi tercatat')
                ->descriptionIcon('heroicon-m-shopping-cart')
                ->color('info'),

            Stat::make('Pesanan Pending', Order::query()->where('status', 'pending')->count())
                ->description('Perlu ditinjau admin')
                ->descriptionIcon('heroicon-m-clock')
                ->color('gray'),

            Stat::make('Omzet Lunas', Number::currency(
                Order::query()->whereIn('payment_status', $paidStatuses)->sum('total_price'),
                in: 'IDR',
                locale: 'id_ID',
            ))
                ->description('Dari pembayaran settlement/capture')
                ->descriptionIcon('heroicon-m-banknotes')
                ->color('success'),

            Stat::make('Konten & UMKM', Content::query()->count().' / '.UmkmProfile::query()->count())
                ->description('Konten website / profil UMKM')
                ->descriptionIcon('heroicon-m-document-text')
                ->color('primary'),
        ];
    }
}
