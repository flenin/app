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
use Filament\Forms\Components\Placeholder;
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
                            Placeholder::make('url')
                                ->content(fn (Trip $record): ?string => $record->url),
                            Placeholder::make('amount')
                                ->content(fn (Trip $record): ?string => $record->amount != null ? $record->amount.' €' : null),
                            Placeholder::make('Lien de paiement Stripe')
                                ->content(fn (Trip $record): ?string => $record->url != null ? route('booking.stripe', ['trip' => $record->url]) : null),
                        ])->columns(2),
                        Section::make([
                            Placeholder::make('from_date')
                                ->content(fn (Trip $record): ?string => optional($record->from_date)->format('d/m/Y')),
                            Placeholder::make('from_time')
                                ->content(fn (Trip $record): ?string => optional($record->from_time)->format('H:i')),
                            Placeholder::make('location.from_address')
                                ->content(fn (Trip $record): ?string => optional($record->location)->from_address),
                            Placeholder::make('location.to_address')
                                ->content(fn (Trip $record): ?string => optional($record->location)->to_address),
                            Placeholder::make('location.distance')
                                ->content(fn (Trip $record): ?string => $record->location != null ? ceil($record->location->distance / 1000).' km' : null),
                            Placeholder::make('location.duration')
                                ->content(fn (Trip $record): ?string => $record->location != null ? ceil($record->location->duration / 60).' min' : null),
                        ])->columns(2),
                        Section::make([
                            Placeholder::make('name')
                                ->content(fn (Trip $record): ?string => $record->name),
                            Placeholder::make('phone')
                                ->content(fn (Trip $record): ?string => $record->phone),
                        ])->columns(2),
                        Section::make([
                            Placeholder::make('adults')
                                ->content(fn (Trip $record): ?string => $record->adults),
                            Placeholder::make('children')
                                ->content(fn (Trip $record): ?string => $record->children),
                            Placeholder::make('luggages')
                                ->content(fn (Trip $record): ?string => $record->luggages),
                        ])->columns(2),
                        Section::make([
                            Placeholder::make('voucher.code')
                                ->content(fn (Trip $record): ?string => optional($record->voucher)->code),
                            Placeholder::make('voucher.amount')
                                ->label('Réduction appliquée (€)')
                                ->content(fn (Trip $record): ?string => optional($record->voucher)->amount),
                        ])->columns(2),
                        Section::make([
                            Toggle::make('paid'),
                            Select::make('status')
                                ->options([
                                    0 => 'En cours',
                                    1 => 'Accepté',
                                    2 => 'Annulé',
                                    3 => 'Terminé',
                                ]),
                        ])->columns(2),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('url'),
                TextColumn::make('created_at')
                    ->formatStateUsing(function ($state) {
                        return $state->format('d/m/Y H:i');
                    })
                    ->sortable(),
                TextColumn::make('status')
                    ->formatStateUsing(function ($state) {
                        return match ($state) {
                            0 => 'En cours',
                            1 => 'Accepté',
                            2 => 'Annulé',
                            3 => 'Terminé',
                        };
                    })
                    ->badge()
                    ->color(function ($state) {
                        return match ($state) {
                            0 => 'warning',
                            1 => 'success',
                            2 => 'danger',
                            3 => 'success',
                        };
                    }),
                IconColumn::make('paid')
                    ->boolean()
                    ->default(false),
                TextColumn::make('from_date')
                    ->label('Date du trajet')
                    ->date('d/m/Y')
                    ->sortable(),
                TextColumn::make('from_time')
                    ->label('Heure du trajet')
                    ->dateTime('H:i'),
                TextColumn::make('name'),
                TextColumn::make('phone'),
                TextColumn::make('location.from_address')
                    ->label('Départ'),
                TextColumn::make('location.to_address')
                    ->label('Arrivée'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'edit' => Pages\EditTrip::route('/{record}/edit'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::where('status', 0)->orWhere('status', 1)->count();
    }
    
    public static function getNavigationBadgeColor(): ?string
    {
        return 'danger';
    }
}
