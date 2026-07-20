<?php

namespace App\Filament\Resources\UmkmProfiles;

use App\Filament\Resources\UmkmProfiles\Pages\CreateUmkmProfile;
use App\Filament\Resources\UmkmProfiles\Pages\EditUmkmProfile;
use App\Filament\Resources\UmkmProfiles\Pages\ListUmkmProfiles;
use App\Filament\Resources\UmkmProfiles\Pages\ViewUmkmProfile;
use App\Filament\Resources\UmkmProfiles\Schemas\UmkmProfileForm;
use App\Filament\Resources\UmkmProfiles\Schemas\UmkmProfileInfolist;
use App\Filament\Resources\UmkmProfiles\Tables\UmkmProfilesTable;
use App\Models\UmkmProfile;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class UmkmProfileResource extends Resource
{
    protected static ?string $model = UmkmProfile::class;

    // ICON MENU
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedBuildingStorefront;

    // GROUP MENU (WAJIB pakai UnitEnum|string|null)
    protected static string|UnitEnum|null $navigationGroup = 'Manajemen Website';

    protected static ?string $navigationLabel = 'Profil UMKM';

    protected static ?int $navigationSort = 2;

    protected static ?string $pluralModelLabel = 'Profil UMKM';

    protected static ?string $modelLabel = 'Profil UMKM';

    protected static ?string $pluralLabel = 'Data UMKM';

    public static function form(Schema $schema): Schema
    {
        return UmkmProfileForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return UmkmProfileInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return UmkmProfilesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListUmkmProfiles::route('/'),
            'create' => CreateUmkmProfile::route('/create'),
            'view' => ViewUmkmProfile::route('/{record}'),
            'edit' => EditUmkmProfile::route('/{record}/edit'),
        ];
    }
}
