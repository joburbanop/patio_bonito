<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MovimientoInventarioResource\Pages;
use App\Models\MovimientoInventario;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class MovimientoInventarioResource extends Resource
{
    protected static ?string $model = MovimientoInventario::class;

    protected static ?string $navigationIcon = 'heroicon-o-arrow-path';  

    public static function getPluralLabel(): string
    {
        return 'Movimiento inventario';  
    }


    public static function shouldRegisterNavigation(): bool
    {
        return auth()->user()->hasRole('administrador');
    }


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('producto_id')
                    ->relationship('productos', 'nombre')  
                    ->required(),
                Forms\Components\TextInput::make('cantidad')
                    ->numeric()
                    ->required()
                    ->reactive() 
                    ->afterStateUpdated(function ($state, callable $set, callable $get) {
                        $tipo = $get('tipo');
                        if ($tipo === 'salida' && $state > 0) {
                            $set('cantidad', -abs($state));
                        } elseif ($tipo === 'entrada' && $state < 0) {
                            $set('cantidad', abs($state)); 
                        }
                    }),
                Forms\Components\Select::make('tipo')
                    ->options([
                        'entrada' => 'Entrada',
                        'salida' => 'Salida',
                    ])
                    ->required(),
                Forms\Components\Textarea::make('motivo')
                    ->maxLength(255)
                    ->nullable(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('productos.nombre')
                    ->label('Producto')
                    ->sortable(),
                Tables\Columns\TextColumn::make('cantidad')
                    ->label('Cantidad')
                    ->sortable(),
                Tables\Columns\TextColumn::make('tipo')
                    ->label('Tipo de Movimiento')
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Fecha de Movimiento')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                // Puedes agregar filtros adicionales si lo necesitas
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
            
        ];
    }

    

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMovimientoInventarios::route('/'),
            'create' => Pages\CreateMovimientoInventario::route('/create'),
            'edit' => Pages\EditMovimientoInventario::route('/{record}/edit'),
        ];
    }
}
