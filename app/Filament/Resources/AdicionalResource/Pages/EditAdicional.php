<?php

namespace App\Filament\Resources\AdicionalResource\Pages;

use App\Filament\Resources\AdicionalResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAdicional extends EditRecord
{
    protected static string $resource = AdicionalResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
