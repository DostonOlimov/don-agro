<?php

namespace App\Filament\Resources\SifatSertificatesResource\Pages;

use App\Filament\Resources\SifatSertificatesResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSifatSertificates extends EditRecord
{
    protected static string $resource = SifatSertificatesResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
