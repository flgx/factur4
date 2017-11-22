<?php

namespace FI\Widgets\Dashboard\InvoiceSummary\Providers;

use Illuminate\Support\ServiceProvider;

class WidgetServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Register the view path
        view()->addLocation(app_path('Widgets/Dashboard/InvoiceSummary/Views'));

        // Register the widget view composer
        view()->composer('InvoiceSummaryWidget', 'FI\Widgets\Dashboard\InvoiceSummary\Composers\InvoiceSummaryWidgetComposer');

        // Register the setting view composer
        view()->composer('InvoiceSummaryWidgetSettings', 'FI\Widgets\Dashboard\InvoiceSummary\Composers\InvoiceSummarySettingComposer');
    }

    public function register()
    {
        //
    }
}
