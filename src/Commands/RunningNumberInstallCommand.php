<?php

declare(strict_types=1);

namespace Soap\Laravel\RunningNumbers\Commands;

use Illuminate\Console\Command;

class RunningNumberInstallCommand extends Command
{
    public $signature = 'runningnumber:install';

    public $description = 'Install the Running Numbers package \'s related resources';

    public function handle(): int
    {

        return self::SUCCESS;
    }
}
