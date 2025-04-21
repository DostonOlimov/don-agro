<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrganizationResource\Pages;
use App\Filament\Resources\OrganizationResource\RelationManagers;
use App\Models\Area;
use App\Models\OrganizationCompanies;
use App\Models\Region;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Columns\TextColumn;


class OrganizationResource extends Resource
{
    protected static ?string $model = OrganizationCompanies::class;
    protected static ?string $recordTitleAttribute = 'Buyurtmachi korxonalar';
    protected static ?string $navigationIcon = 'heroicon-o-collection';

    use Tables\Concerns\InteractsWithTable;

    protected function getTableQuery(): Builder
    {
        return OrganizationCompanies::query()->latest('id');
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Grid::make(2)->schema([
                Forms\Components\TextInput::make('name')
                    ->label(__('app.Korxona nomi'))
                    ->required(),

                TextInput::make('owner_name')
                    ->label(__('app.Raxbarning ismi-sharifi'))
                    ->required(),

                TextInput::make('inn')
                    ->label(__('app.STIR'))
                    ->unique(OrganizationCompanies::class, 'inn')
                    ->mask(fn (TextInput\Mask $mask) => $mask
                        ->range()
                        ->from(100000000) // Set the lower limit.
                        ->to(999999999) // Set the upper limit.
                        ->maxValue(999999999), // Pad zeros at the start of smaller numbers.
                    )
                    ->minLength(9)
                    ->maxLength(9)
                    ->required(),

                TextInput::make('mobile')
                    ->label(__('app.Mobile No'))
                    ->tel()
                    ->mask(fn (TextInput\Mask $mask) => $mask->pattern('+{998} (00) 000-00-00'))
                    ->required(),

                Select::make('state_id')
                    ->label(__('app.Region'))
                    ->options(Region::all()->pluck('name', 'id'))
                    ->reactive()
                    ->required()
                    ->afterStateUpdated(fn (callable $set) => $set('city_id', null))
                    ->default(fn ($record) => $record->city->state_id),

                Select::make('city_id')
                    ->label(__('app.Tuman nomi'))
                    ->options(fn (callable $get) =>
                    Area::where('state_id', $get('state_id'))->pluck('name', 'id')
                    )
                    ->required()
                    ->disabled(fn (callable $get) => !$get('state_id'))
                    ->default(fn ($record) => $record->city_id),

                Textarea::make('address')
                    ->label(__('app.Address'))
                    ->maxLength(100)
                    ->required(),
            ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->label(__('app.Korxona nomi'))->searchable(),
                TextColumn::make('inn')->label(__('app.STIR'))->searchable(),
                TextColumn::make('city.region.name')->label(__('app.Region')),
            ])
            ->filters([
                // Region Filter
                SelectFilter::make('region')
                    ->label(__('app.Region'))
                    ->options(Region::all()->pluck('name', 'id')) // Get all regions
                    ->query(function ($query, array $data) {
                        if (isset($data['value'])) {
                            return $query->whereHas('city.region', function ($q) use ($data) {
                                return $q->where('id', $data['value']);
                            });
                        }
                        return $query;
                    }),

                // Name Filter using TextInput
                Filter::make('name')
                    ->form([
                        \Filament\Forms\Components\TextInput::make('value')
                            ->placeholder(__('app.Korxona nomi'))
                            ->label(__('app.Korxona nomi'))
                    ])
                    ->query(function ($query, array $data) {
                        if (!empty($data['value'])) {
                            return $query->where('name', 'like', '%' . $data['value'] . '%');
                        }
                        return $query;
                    }),

                // INN Filter using TextInput
                Filter::make('inn')
                    ->form([
                        \Filament\Forms\Components\TextInput::make('value')
                            ->placeholder(__('app.STIR'))
                            ->label(__('app.STIR'))
                    ])
                    ->query(function ($query, array $data) {
                        if (!empty($data['value'])) {
                            return $query->where('inn', 'like', '%' . $data['value'] . '%');
                        }
                        return $query;
                    }),
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
            'index' => Pages\ListOrganizations::route('/'),
            'create' => Pages\CreateOrganization::route('/create'),
            'edit' => Pages\EditOrganization::route('/{record}/edit'),
        ];
    }
}
