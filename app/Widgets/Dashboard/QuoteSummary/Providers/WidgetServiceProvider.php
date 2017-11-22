<?php

namespace FI\Widgets\Dashboard\QuoteSummary\Providers;

use Illuminate\Support\ServiceProvider;

class WidgetServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Register the view path
        view()->addLocation(app_path('Widgets/Dashboard/QuoteSummary/Views'));

        // Register the widget view composer
        view()->composer('QuoteSummaryWidget', 'FI\Widgets\Dashboard\QuoteSummary\Composers\QuoteSummaryWidgetComposer');

        // Register the setting view composer
        view()->composer('QuoteSummaryWidgetSettings', 'FI\Widgets\Dashboard\QuoteSummary\Composers\QuoteSummarySettingComposer');
    }

    public function register()
    {
        //
    }
}