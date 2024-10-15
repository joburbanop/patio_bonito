<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductosResource\Pages;
use App\Models\Productos;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ProductosResource extends Resource
{
    protected static ?string $model = Productos::class;  // Cambiado a singular según convención del modelo.

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nombre')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('descripcion')
                    ->maxLength(65535),
                Forms\Components\TextInput::make('precio')
                    ->required()
                    ->numeric()
                    ->minValue(0),
                Forms\Components\TextInput::make('cantidad')
                    ->required()
                    ->numeric()
                    ->minValue(0),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nombre')->sortable(),
                Tables\Columns\TextColumn::make('precio')->sortable(),
                Tables\Columns\TextColumn::make('cantidad')->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Fecha creacion')
                    ->dateTime(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Fecha actualizacion')
                    ->dateTime(),
            ])
            ->filters([
                // Puedes agregar filtros aquí
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            // Puedes definir relaciones aquí si es necesario
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProductos::route('/'),
            'create' => Pages\CreateProductos::route('/create'),
            'edit' => Pages\EditProductos::route('/{record}/edit'),
        ];
    }
}
