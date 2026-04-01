<?php

namespace App\Filament\Resources\GalleryItems;

use App\Filament\Resources\GalleryItems\Pages\CreateGalleryItem;
use App\Filament\Resources\GalleryItems\Pages\EditGalleryItem;
use App\Filament\Resources\GalleryItems\Pages\ListGalleryItems;
use App\Models\GalleryItem;
use BackedEnum;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
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

class GalleryItemResource extends Resource
{
    protected static ?string $model = GalleryItem::class;

    protected static string | BackedEnum | null $navigationIcon = 'heroicon-o-film';
    protected static ?string $navigationLabel = 'Galeri & Video';
    protected static string | UnitEnum | null $navigationGroup = 'Konten Website';
    protected static ?int $navigationSort = 4;

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Item Galeri')
                ->schema([
                    TextInput::make('title')->label('Judul')->maxLength(255),
                    Select::make('media_type')
                        ->label('Jenis Media')
                        ->options([
                            'image' => 'Foto',
                            'video' => 'Video',
                        ])
                        ->default('image')
                        ->required(),
                    Textarea::make('caption')->label('Caption')->rows(4)->columnSpanFull(),
                    FileUpload::make('image_path')
                        ->label('Upload Foto')
                        ->image()
                        ->disk('public')
                        ->directory('gallery/images')
                        ->maxSize(5120),
                    FileUpload::make('video_path')
                        ->label('Upload Video')
                        ->disk('public')
                        ->directory('gallery/videos')
                        ->acceptedFileTypes(['video/mp4', 'video/webm', 'video/quicktime'])
                        ->maxSize(51200),
                    TextInput::make('sort_order')->label('Urutan')->numeric()->default(0),
                    Toggle::make('is_active')->label('Aktif')->default(true),
                ])
                ->columns(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image_path')->label('Preview')->disk('public'),
                TextColumn::make('title')->label('Judul')->searchable()->limit(30),
                TextColumn::make('media_type')->label('Tipe')->badge(),
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
            'index' => ListGalleryItems::route('/'),
            'create' => CreateGalleryItem::route('/create'),
            'edit' => EditGalleryItem::route('/{record}/edit'),
        ];
    }
}