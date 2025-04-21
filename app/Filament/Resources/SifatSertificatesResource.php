<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SifatSertificatesResource\Pages;
use App\Filament\Resources\SifatSertificatesResource\RelationManagers;
use App\Models\SifatSertificates;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SifatSertificatesResource extends Resource
{
    protected static ?string $model = SifatSertificates::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->sortable(),
                Tables\Columns\TextColumn::make('number')->searchable(),
                Tables\Columns\TextColumn::make('application.prepared.region.name') // Assuming `application` is the relation method and `app_number` is the column
                ->label('Organization Name') // Optional: Label it as "App Number"
                ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('application.organization.name') // Assuming `application` is the relation method and `app_number` is the column
                ->label('Organization Name') // Optional: Label it as "App Number"
                ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('year')->sortable(),
                Tables\Columns\TextColumn::make('created_at')->dateTime(),
                // Display app_number from related application model
                Tables\Columns\TextColumn::make('application.id') // Assuming `application` is the relation method and `app_number` is the column
                ->label('App Number') // Optional: Label it as "App Number"
                ->sortable()
                    ->searchable(),

            ])
            ->filters([
                // Add filters if needed
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
            'index' => Pages\ListSifatSertificates::route('/'),
            'create' => Pages\CreateSifatSertificates::route('/create'),
            'edit' => Pages\EditSifatSertificates::route('/{record}/edit'),
        ];
    }
}
