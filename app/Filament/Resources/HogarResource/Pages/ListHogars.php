<?php

namespace App\Filament\Resources\HogarResource\Pages;

use App\Filament\Resources\HogarResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListHogars extends ListRecords
{
    protected static string $resource = HogarResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
