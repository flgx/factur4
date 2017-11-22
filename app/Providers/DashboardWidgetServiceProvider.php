<?php

namespace FI\Providers;

use FI\Support\Directory;
use Illuminate\Support\ServiceProvider;

class DashboardWidgetServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Loop through the widget folders and load service providers if they exist.
        $widgets = Directory::listContents(app_path('Widgets/Dashboard'));

        foreach ($widgets as $widget)
        {
            $providerPath = app_path('Widgets/Dashboard/' . $widget . '/Providers/WidgetServiceProvider.php');

            if (file_exists($providerPath))
            {
                app()->register('FI\Widgets\Dashboard\\' . $widget . '\Providers\WidgetServiceProvider');
            }
        }
    }

    public function register()
    {
        //
    }
}
