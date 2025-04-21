<?php

namespace App\Filament\Resources\LocationResource\Pages;

use App\Filament\Resources\LocationResource;
use Filament\Resources\Pages\Page;

class LocationDashboard extends Page
{

    protected static ?string $navigationLabel = 'Location';
    protected static string $view = 'admin.filament.pages.location-dashboard';

    public function mount(): void
    {
        // Add logic here to pass any data or config to the view, if needed
    }
}
