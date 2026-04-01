<?php

namespace App\Filament\Resources\HeroSlides;

use App\Filament\Resources\HeroSlides\Pages\CreateHeroSlide;
use App\Filament\Resources\HeroSlides\Pages\EditHeroSlide;
use App\Filament\Resources\HeroSlides\Pages\ListHeroSlides;
use App\Models\HeroSlide;
use BackedEnum;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use UnitEnum;

class HeroSlideResource extends Resource
{
    protected static ?string $model = HeroSlide::class;

    protected static string | BackedEnum | null $navigationIcon = 'heroicon-o-photo';
    protected static ?string $navigationLabel = 'Hero Slides';
    protected static string | UnitEnum | null $navigationGroup = 'Konten Website';
    protected static ?int $navigationSort = 2;

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Slide Hero')
                ->schema([
                    TextInput::make('title')->label('Judul Slide')->maxLength(255),
                    Textarea::make('subtitle')->label('Subjudul')->rows(4)->columnSpanFull(),
                    TextInput::make('button_text')->label('Teks Tombol')->maxLength(255),
                    TextInput::make('button_link')->label('Link Tombol')->default('#layanan'),
                    FileUpload::make('image_path')
                        ->label('Gambar Hero')
                        ->image()
                        ->disk('public')
                        ->directory('hero')
                        ->maxSize(5120),
                    TextInput::make('sort_order')->numeric()->default(0),
                    Toggle::make('is_active')->label('Aktif')->default(true),
                ])
                ->columns(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image_path')->label('Gambar')->disk('public'),
                TextColumn::make('title')->label('Judul')->searchable()->limit(40),
                TextColumn::make('sort_order')->label('Urutan')->sortable(),
                IconColumn::make('is_active')->label('Aktif')->boolean(),
                TextColumn::make('updated_at')->label('Update')->dateTime('d M Y H:i'),
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->bulkActions([
                DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListHeroSlides::route('/'),
            'create' => CreateHeroSlide::route('/create'),
            'edit' => EditHeroSlide::route('/{record}/edit'),
        ];
    }
}