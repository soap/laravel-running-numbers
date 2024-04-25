<?php

namespace Soap\Laravel\RunningNumbers\Commands;

use Illuminate\Console\Command;

class RunningNumberCommand extends Command
{
    public $signature = 'laravel-running-numbers';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
