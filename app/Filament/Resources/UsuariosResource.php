<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UsuariosResource\Pages;
use App\Filament\Resources\UsuariosResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UsuariosResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function shouldRegisterNavigation(): bool
     {
         return auth()->user()->hasRole('administrador');
     }

     public static function form(Form $form): Form
     {
         return $form
             ->schema([
                 Forms\Components\TextInput::make('name')
                     ->label('Nombre')
                     ->required()
                     ->maxLength(255),
                 Forms\Components\TextInput::make('email')
                     ->label('Correo Electrónico')
                     ->required()
                     ->email()
                     ->maxLength(255),
                 Forms\Components\TextInput::make('password')
                     ->label('Contraseña')
                     ->password()
                     ->required()
                     ->minLength(8),
                 Forms\Components\Select::make('roles')
                     ->multiple()
                     ->relationship('roles', 'name') // Relación con el sistema de roles
                     ->preload()
                     ->label('Roles')
                     ->required(),
             ]);
     }
     

     public static function table(Table $table): Table
     {
         return $table
             ->columns([
                 Tables\Columns\TextColumn::make('name')
                     ->label('Nombre')
                     ->sortable()
                     ->searchable(),
                 Tables\Columns\TextColumn::make('email')
                     ->label('Correo Electrónico')
                     ->sortable()
                     ->searchable(),
                 Tables\Columns\TextColumn::make('roles.name')
                     ->label('Roles')
                     ->sortable(),
                 Tables\Columns\TextColumn::make('created_at')
                     ->label('Fecha de Creación')
                     ->dateTime(),
             ])
             ->filters([
                 // Aquí puedes agregar filtros si lo necesitas
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
            'index' => Pages\ListUsuarios::route('/'),
            'create' => Pages\CreateUsuarios::route('/create'),
            'edit' => Pages\EditUsuarios::route('/{record}/edit'),
        ];
    }
}
