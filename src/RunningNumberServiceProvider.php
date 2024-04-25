<?php

namespace Soap\Laravel\RunningNumbers;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Soap\Laravel\RunningNumbers\Commands\RunningNumberCommand;

class RunningNumberServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('laravel-running-numbers')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_running-numbers_table')
            ->hasCommand(RunningNumberCommand::class);
    }
}
