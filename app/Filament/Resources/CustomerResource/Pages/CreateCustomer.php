<?php

namespace App\Filament\Resources\CustomerResource\Pages;

use App\Filament\Resources\CustomerResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateCustomer extends CreateRecord
{
    protected static string $resource = CustomerResource::class;

    protected function getFormActions(): array
    {
        return [
            $this->getCreateFormAction(), // keep only this if you want just "Создать"
            $this->getCancelFormAction() // if you want Cancel
        ];
    }
}
