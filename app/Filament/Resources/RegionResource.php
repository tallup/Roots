<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RegionResource\Pages;
use App\Filament\Resources\RegionResource\RelationManagers;
use App\Models\Region;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class RegionResource extends Resource
{
    protected static ?string $model = Region::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('region_initial')
                    ->required()
                    ->maxLength(10)
                    ->label('Region Initial'),
                Forms\Components\TextInput::make('region_name')
                    ->required()
                    ->maxLength(255)
                    ->label('Region Name'),
                Forms\Components\TextInput::make('addedby')
                    ->required()
                    ->numeric()
                    ->label('Added By'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('regId')
                    ->label('ID')
                    ->sortable(),
                Tables\Columns\TextColumn::make('region_initial')
                    ->label('Region Initial')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('region_name')
                    ->label('Region Name')
                    ->searchable()
                    ->sortable(),
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
            'index' => Pages\ListRegions::route('/'),
            'create' => Pages\CreateRegion::route('/create'),
            'edit' => Pages\EditRegion::route('/{record}/edit'),
        ];
    }    
}
