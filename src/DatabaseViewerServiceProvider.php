<?php

namespace LaraToolbox\DatabaseViewer;

use Illuminate\Support\ServiceProvider;
use LaraToolbox\DatabaseViewer\Commands\ShowTablesCommand;
use LaraToolbox\DatabaseViewer\Commands\ShowTableColumnsCommand;
use LaraToolbox\DatabaseViewer\Commands\ShowTableColumnsForDocBlockCommand;

class DatabaseViewerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            // Registering package commands.
            $this->commands([
                ShowTablesCommand::class,
                ShowTableColumnsCommand::class,
                ShowTableColumnsForDocBlockCommand::class,
            ]);
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Register the main class to use with the facade
        $this->app->singleton('databaseviewer', function () {
            return new DatabaseViewer;
        });
    }
}
