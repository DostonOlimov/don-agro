<?php



namespace App\Providers;

use Filament\Navigation\Navigation;
use Filament\Providers\FilamentServiceProvider;
use Illuminate\Support\ServiceProvider;

class AdminPanelProvider extends ServiceProvider
{
    public function register()
    {
        // Nothing special here unless you're registering services for the panel.
    }

    public function boot()
    {
        // Customize Filament navigation
        Filament::navigation(function (Navigation $navigation) {
            // Example of adding a dropdown group to the sidebar
            $navigation->group('Location', function (Navigation $group) {
                $group->item('States', \App\Filament\Resources\StateResource::class)
                    ->icon('heroicon-o-location-marker');

                $group->item('Regions', \App\Filament\Resources\RegionResource::class)
                    ->icon('heroicon-o-map');
            });
        });
    }
}
