<?php

namespace App\Filament\Resources\StateResource\Pages;

use App\Filament\Resources\StateResource;
use Filament\Resources\Pages\Page;

class Settings extends Page
{
    protected static string $resource = StateResource::class;

    protected static string $view = 'filament.resources.state-resource.pages.settings';
}
