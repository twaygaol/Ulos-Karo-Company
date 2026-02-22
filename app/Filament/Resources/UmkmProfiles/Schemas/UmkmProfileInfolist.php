<?php

namespace App\Filament\Resources\UmkmProfiles\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class UmkmProfileInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            TextEntry::make('name')->label('Nama UMKM'),
            TextEntry::make('phone')->label('No HP'),
            TextEntry::make('address')->label('Alamat'),

            TextEntry::make('latitude')->label('Latitude'),
            TextEntry::make('longitude')->label('Longitude'),

            TextEntry::make('created_at')
                ->label('Dibuat')
                ->dateTime('d M Y H:i'),

            TextEntry::make('updated_at')
                ->label('Diupdate')
                ->dateTime('d M Y H:i'),
        ]);
    }
}
