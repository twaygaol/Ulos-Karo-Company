<?php

namespace App\Filament\Resources\Contents\Schemas;

use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class ContentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make('title')
                ->required()
                ->maxLength(255),

            Select::make('type')
                ->options([
                    'sejarah' => 'Sejarah Ulos',
                    'profil_adat' => 'Profil Adat Karo',
                    'tentang' => 'Tentang Sistem',
                    'informasi' => 'Informasi Ulos',
                ])
                ->required(),

            RichEditor::make('body')
                ->required()
                ->columnSpanFull(),
        ]);
    }
}
