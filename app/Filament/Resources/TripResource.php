<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TripResource\Pages;
use App\Filament\Resources\TripResource\RelationManagers;
use App\Models\Trip;
use App\Models\Location;
use App\Models\Voucher;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TripResource extends Resource
{
    protected static ?string $model = Trip::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make(1)
                    ->schema([
                        Section::make([
                            Select::make('from_location_id')
                                ->options(Location::get()->pluck('name', 'id'))
                                ->required()
                                ->exists(
                                    table: Location::class,
                                    column: 'id',
                                ),
                            Select::make('to_location_id')
                                ->options(Location::get()->pluck('name', 'id'))
                                ->required()
                                ->exists(
                                    table: Location::class,
                                    column: 'id',
                                )
                                ->different('from_location_id'),
                        ])->columns(2),
                        Section::make([
                            DatePicker::make('from_date')
                                ->displayFormat('d/m/Y')
                                ->native(false)
                                ->format('Y-m-d'),
                            TimePicker::make('from_time')
                                ->seconds(false)
                                ->native(false)
                                ->format('H:i'),
                        ])->columns(2),
                        Section::make([
                            TextInput::make('adults')
                                ->numeric()
                                ->default(0),
                            TextInput::make('children')
                                ->numeric()
                                ->default(0),
                            TextInput::make('luggages')
                                ->numeric()
                                ->default(0),
                        ])->columns(3),
                        TextInput::make('amount')
                            ->postfix('€')
                            ->numeric(),
                        TextInput::make('name'),
                        TextInput::make('phone'),
                        Toggle::make('paid'),
                        Textarea::make('notes'),
                        Select::make('voucher_id')
                            ->options(Voucher::get()->pluck('code', 'id'))
                            ->exists(
                                table: Voucher::class,
                                column: 'id',
                            ),
                        Select::make('status')
                            ->options([
                                1 => 'Accepté',
                                2 => 'Annulé',
                                0 => 'En cours',
                            ]),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('status')
                    ->formatStateUsing(function ($state) {
                        return match ($state) {
                            1 => 'Accepté',
                            2 => 'Annulé',
                            default => 'En cours',
                        };
                    })
                    ->badge()
                    ->color(function ($state) {
                        return match ($state) {
                            1 => 'success',
                            2 => 'danger',
                            default => 'warning',
                        };
                    }),
                IconColumn::make('paid')
                    ->boolean(),
                TextColumn::make('from_date')
                    ->date('d/m/Y'),
                TextColumn::make('from_time')
                    ->dateTime('H:i'),
                TextColumn::make('name'),
                TextColumn::make('phone'),
                TextColumn::make('from_location.name'),
                TextColumn::make('to_location.name'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListTrips::route('/'),
            'create' => Pages\CreateTrip::route('/create'),
            'edit' => Pages\EditTrip::route('/{record}/edit'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::where('status', 0)->count();
    }
    
    public static function getNavigationBadgeColor(): ?string
    {
        return 'warning';
    }
}
