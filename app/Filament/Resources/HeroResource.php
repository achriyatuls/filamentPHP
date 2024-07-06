<?php

namespace App\Filament\Resources;

use App\Filament\Resources\HeroResource\Pages;
use App\Filament\Resources\HeroResource\RelationManagers;
use App\Models\Hero;
use Filament\Actions\DeleteAction;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Actions\DeleteAction as ActionsDeleteAction;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Storage;

class HeroResource extends Resource
{
    protected static ?string $model = Hero::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //add file upload for image
                Forms\Components\FileUpload::make('image')
                    ->image(),
                //add title field
                Forms\Components\TextInput::make('title')
                    ->required(),
                //add subtitle field
                Forms\Components\TextInput::make('subtitle')
                    ->required(),
                //add link one field
                Forms\Components\TextInput::make('link1')
                    ->required()
                    ->url(),
                //add link two field
                Forms\Components\TextInput::make('link2')
                    ->required()
                    ->url(),
                //add is active toggle
                Forms\Components\Toggle::make('is_active')
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //add column for hero
                ImageColumn::make('image')
                    ->circular(),

                TextColumn::make('title')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('subtitle')
                    ->searchable()
                    ->sortable(),

                //add is active as toggle collumn
                Tables\Columns\ToggleColumn::make('is_active')
                    ->sortable()
                    ->afterStateUpdated(function (Hero $hero, $state) {
                        if ($state) {
                            //update other hero records to inactive if new hero is active
                            Hero::where('id', '!=', $hero->id)->update(['is_active' => 0]);
                        }
                    })
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),

                //add delete action
                Tables\Actions\DeleteAction::make()
                    //add after delete action{
                    ->after(function (Hero $hero) {
                        //check if there are images
                        if ($hero->image) {
                            //delete image
                            Storage::disk('public')->delete($hero->image);
                        }
                    }),


            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'index' => Pages\ListHeroes::route('/'),
            'create' => Pages\CreateHero::route('/create'),
            'edit' => Pages\EditHero::route('/{record}/edit'),
        ];
    }
}
