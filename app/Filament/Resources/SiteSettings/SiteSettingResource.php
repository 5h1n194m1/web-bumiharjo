<?php

namespace App\Filament\Resources\SiteSettings;

use App\Filament\Resources\SiteSettings\Pages\CreateSiteSetting;
use App\Filament\Resources\SiteSettings\Pages\EditSiteSetting;
use App\Filament\Resources\SiteSettings\Pages\ListSiteSettings;
use App\Models\SiteSetting;
use BackedEnum;
use Filament\Actions\EditAction;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use UnitEnum;

class SiteSettingResource extends Resource
{
    protected static ?string $model = SiteSetting::class;

    protected static string | BackedEnum | null $navigationIcon = 'heroicon-o-cog-6-tooth';
    protected static ?string $navigationLabel = 'Pengaturan Website';
    protected static ?string $modelLabel = 'Pengaturan Website';
    protected static ?string $pluralModelLabel = 'Pengaturan Website';
    protected static string | UnitEnum | null $navigationGroup = 'Konten Website';
    protected static ?int $navigationSort = 1;

    public static function canCreate(): bool
    {
        return static::getModel()::count() === 0;
    }

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Hero Section')
                ->schema([
                    TextInput::make('company_name')->label('Nama Tempat')->required()->maxLength(255),
                    TextInput::make('hero_headline')->label('Headline Hero')->required()->maxLength(255),
                    Textarea::make('hero_subheadline')->label('Subheadline Hero')->rows(3)->columnSpanFull(),
                ])
                ->columns(2),

            Section::make('Tentang & Layanan')
                ->schema([
                    TextInput::make('about_title')->label('Judul Tentang Kami')->maxLength(255),
                    TextInput::make('services_title')->label('Judul Layanan')->maxLength(255),
                    Textarea::make('about_content')->label('Isi Tentang Kami')->rows(6)->columnSpanFull(),
                    Textarea::make('services_intro')->label('Pengantar Layanan')->rows(4)->columnSpanFull(),
                ])
                ->columns(2),

            Section::make('Footer & Kontak')
                ->schema([
                    TextInput::make('footer_title')->label('Judul Footer')->maxLength(255),
                    TextInput::make('opening_hours')->label('Jam Operasional')->maxLength(255),
                    Textarea::make('address')->label('Alamat')->rows(3)->columnSpanFull(),
                    Textarea::make('maps_embed_url')->label('Link Embed Google Maps')->rows(3)->columnSpanFull(),
                    TextInput::make('whatsapp_number')->label('Nomor WhatsApp')->helperText('Contoh: 6281234567890'),
                    Textarea::make('whatsapp_message')->label('Pesan Default WhatsApp')->rows(3),
                ])
                ->columns(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('company_name')->label('Nama Tempat')->searchable(),
                TextColumn::make('whatsapp_number')->label('WhatsApp'),
                TextColumn::make('updated_at')->label('Terakhir Diubah')->dateTime('d M Y H:i'),
            ])
            ->actions([
                EditAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListSiteSettings::route('/'),
            'create' => CreateSiteSetting::route('/create'),
            'edit' => EditSiteSetting::route('/{record}/edit'),
        ];
    }
}