<?php

namespace App\Filament\Resources\HogarResource\Pages;

use App\Filament\Resources\HogarResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditHogar extends EditRecord
{
    protected static string $resource = HogarResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
