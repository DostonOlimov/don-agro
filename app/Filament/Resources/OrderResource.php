<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderResource\Pages;
use App\Filament\Resources\OrderResource\RelationManagers;
use App\Models\Order;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Components\Wizard\Step;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Grid;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Wizard::make([
                Step::make('Order Details')->schema([
                    Grid::make(2)->schema([
                        TextInput::make('order_number')
                            ->default('OR-' . rand(100000, 999999))
                            ->disabled(),
                        Select::make('customer_id')
                            ->relationship('customer', 'name')
                            ->required()
                            ->searchable()
                            ->createOptionForm([
                                TextInput::make('name')->required(),
                                TextInput::make('email')->required()->email(),
                            ]),
                    ]),
                    Select::make('status')
                        ->options([
                            'new' => 'New',
                            'processing' => 'Processing',
                            'shipped' => 'Shipped',
                            'delivered' => 'Delivered',
                            'cancelled' => 'Cancelled',
                        ])
                        ->required()
                        ->label('Status'),
                    Select::make('currency')
                        ->options(['USD' => 'USD', 'EUR' => 'EUR'])
                        ->required(),
                    Select::make('country')
                        ->options(['US' => 'United States', 'GB' => 'United Kingdom', 'DE' => 'Germany'])
                        ->searchable(),
                    Grid::make(3)->schema([
                        TextInput::make('street_address'),
                        TextInput::make('city'),
                        TextInput::make('state'),
                        TextInput::make('postal_code'),
                    ]),
                ]),

                Step::make('Order Items')->schema([
                    Repeater::make('items')
                        ->relationship()
                        ->schema([
                            Select::make('product_id')
                                ->relationship('product', 'name')
                                ->required()
                                ->reactive(),
                            TextInput::make('quantity')->numeric()->required(),
                            TextInput::make('price')->numeric()->required(),
                        ])
                        ->columns(3)
                        ->createItemButtonLabel('Add Product'),
                ]),
            ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
            ])
            ->filters([
                //
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
            'index' => Pages\ListOrders::route('/'),
            'create' => Pages\CreateOrder::route('/create'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
        ];
    }
}
