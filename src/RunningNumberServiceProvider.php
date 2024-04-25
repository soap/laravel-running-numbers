<?php

namespace Soap\Laravel\RunningNumbers;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Soap\Laravel\RunningNumbers\Commands\RunningNumberInstallCommand;
use Soap\Laravel\RunningNumbers\Commands\RunningNumberGenerateCommand;

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
            ->hasMigration('create_running-numbers_table')
            ->hasCommands([
                RunningNumberInstallCommand::class,
                RunningNumberGenerateCommand::class
            ]);
    }
}
