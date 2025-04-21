<?php

namespace App\Filament\Resources\SifatSertificatesResource\Pages;

use App\Filament\Resources\SifatSertificatesResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSifatSertificates extends ListRecords
{
    protected static string $resource = SifatSertificatesResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
