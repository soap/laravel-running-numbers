<?php

namespace Soap\Laravel\RunningNumbers\Commands;

use Illuminate\Console\Command;
use Soap\Laravel\RunningNumbers\RunningNumber;

class RunningNumberResetCommand extends Command
{
    public $signature = 'runningnumber:reset 
        {type : Type of running number}
        {prefix : Prefix before running number}
        {--value=1 : Value to reset running number to}';

    public function handle(): int
    {
        $this->comment('Reset running number of '
            .$this->argument('type')
            .' with prefix '
            .$this->argument('prefix')
            .' to '.$this->option('value')
            .'...');
        RunningNumber::reset(
            $this->argument('type'),
            $this->argument('prefix'),
            $this->option('value')
        );

        return self::SUCCESS;
    }
}
