<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MesaResource\Pages;
use App\Models\Mesa;
use Filament\Forms;
use Filament\Tables;
use Filament\Resources\Resource;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class MesaResource extends Resource
{
    protected static ?string $model = Mesa::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    public static function shouldRegisterNavigation(): bool
    {
        return auth()->user()->hasRole('administrador') || auth()->user()->hasRole('mesero');
    }


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nombre')
                    ->required()
                    ->unique(Mesa::class, 'nombre', ignoreRecord: true),
                Forms\Components\Toggle::make('disponible')
                    ->label('¿Está disponible?')
                    ->default(true),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nombre')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\BooleanColumn::make('disponible')
                    ->label('Disponible'),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Fecha de creación')
                    ->dateTime(),
            ])
            ->filters([
                // Puedes agregar filtros si es necesario
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMesas::route('/'),
            'create' => Pages\CreateMesa::route('/create'),
            'edit' => Pages\EditMesa::route('/{record}/edit'),
        ];
    }
}
