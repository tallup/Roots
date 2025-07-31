<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AdminResource\Pages;
use App\Filament\Resources\AdminResource\RelationManagers;
use App\Models\Admin;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AdminResource extends Resource
{
    protected static ?string $model = Admin::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('AdminName')
                    ->required()
                    ->maxLength(255)
                    ->label('Admin Name'),
                Forms\Components\TextInput::make('UserName')
                    ->required()
                    ->maxLength(255)
                    ->label('Username')
                    ->unique(ignoreRecord: true),
                Forms\Components\TextInput::make('MobileNumber')
                    ->tel()
                    ->maxLength(20)
                    ->label('Mobile Number'),
                Forms\Components\TextInput::make('Email')
                    ->email()
                    ->maxLength(255)
                    ->label('Email'),
                Forms\Components\TextInput::make('Password')
                    ->password()
                    ->dehydrated(fn ($state) => filled($state))
                    ->required(fn (string $context): bool => $context === 'create')
                    ->label('Password'),
                Forms\Components\TextInput::make('addedby')
                    ->maxLength(255)
                    ->label('Added By'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('ID')
                    ->label('ID')
                    ->sortable(),
                Tables\Columns\TextColumn::make('AdminName')
                    ->label('Admin Name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('UserName')
                    ->label('Username')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('MobileNumber')
                    ->label('Mobile Number')
                    ->searchable(),
                Tables\Columns\TextColumn::make('Email')
                    ->label('Email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('addedby')
                    ->label('Added By')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListAdmins::route('/'),
            'create' => Pages\CreateAdmin::route('/create'),
            'edit' => Pages\EditAdmin::route('/{record}/edit'),
        ];
    }    
}
