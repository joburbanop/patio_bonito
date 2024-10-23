<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PedidoResource\Pages;
use App\Models\Pedido;
use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class PedidoResource extends Resource
{
    protected static ?string $model = Pedido::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-cart'; 

    public static function shouldRegisterNavigation(): bool
    {
        return auth()->user()->hasRole('mesero') || auth()->user()->hasRole('cocinero');
    }


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('mesa_id')
                    ->relationship('mesa', 'nombre')
                    ->required()
                    ->label('Mesa'),
                Forms\Components\Select::make('estado')
                    ->options([
                        'pendiente' => 'Pendiente',
                        'preparando' => 'Preparando',
                        'listo' => 'Listo',
                        'entregado' => 'Entregado',
                    ])
                    ->required()
                    ->default('pendiente')
                    ->label('Estado del Pedido'),

                
                Forms\Components\Select::make('producto_id')
                    ->relationship('productos', 'nombre') 
                    ->required()
                    ->label('Producto')
                    ->reactive()
                    ->afterStateUpdated(function (callable $set, $state) {
                        // Buscar el precio del producto seleccionado
                        $producto = \App\Models\Productos::find($state);
                        if ($producto) {
                            // Establecer el precio del producto
                            $set('precio_unitario', $producto->precio);
                        }
                    }),
                Forms\Components\TextInput::make('cantidad')
                    ->required()
                    ->numeric()
                    ->minValue(1)
                    ->label('Cantidad')
                    ->reactive() // Hacerlo reactivo para recalcular el total
                    ->afterStateUpdated(function (callable $set, $get, $state) {
                        // Recalcular el precio total basado en la cantidad
                        $set('precio', $get('precio_unitario') * $state);
                    }),
                Forms\Components\TextInput::make('precio_unitario')
                    ->label('Precio Unitario')
                    ->disabled()
                    ->numeric()
                    ->dehydrated(false)
                    ->prefix('$'),

                Forms\Components\TextInput::make('precio')
                    ->required()
                    ->disabled()
                    ->numeric()
                    ->label('Precio Total')
                    ->prefix('$'),
            
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('mesa.nombre')
                    ->label('Mesa')
                    ->sortable(),
                Tables\Columns\TextColumn::make('estado')
                    ->label('Estado del Pedido')
                    ->sortable(),
                Tables\Columns\TextColumn::make('productos.nombre')
                    ->label('Producto'),
                Tables\Columns\TextColumn::make('cantidad')
                    ->label('Cantidad'),
                Tables\Columns\TextColumn::make('precio')
                    ->label('Precio por unidad'),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Fecha de Creación')
                    ->dateTime(),
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
            // Aquí puedes definir relaciones adicionales si es necesario
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPedidos::route('/'),
            'create' => Pages\CreatePedido::route('/create'),
            'edit' => Pages\EditPedido::route('/{record}/edit'),
        ];
    }
}