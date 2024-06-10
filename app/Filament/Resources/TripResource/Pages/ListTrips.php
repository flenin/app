<?php

namespace App\Filament\Resources\TripResource\Pages;

use App\Filament\Resources\TripResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Components\Tab;
use Illuminate\Database\Eloquent\Builder;

class ListTrips extends ListRecords
{
    protected static string $resource = TripResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }

    public function getTabs(): array
    {
        return [
            'Réservations en cours' => Tab::make()
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', 0)->orWhere('status', 1)->orderByDesc('id')),
            'Annulées' => Tab::make()
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', 2)->orderByDesc('id')),
            'Terminées' => Tab::make()
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', 3)->orderByDesc('id')),
            'Formulaires non terminés' => Tab::make()
                ->modifyQueryUsing(fn (Builder $query) => $query->whereNull('status')->orderByDesc('id')),
        ];
    }
}
