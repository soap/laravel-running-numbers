<?php

declare(strict_types=1);

namespace Soap\Laravel\RunningNumbers;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

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
            ->hasMigration('create_running_numbers_table')
            ->hasMigration('add_composite_index_to_running_numbers_table')
            ->hasCommands([
                Commands\RunningNumberInstallCommand::class,
                Commands\RunningNumberGenerateCommand::class,
                Commands\RunningNumberResetCommand::class,
                Commands\RunningNumberListCommand::class,
                Commands\RunningNumberDeleteCommand::class,
            ]);
    }
}
