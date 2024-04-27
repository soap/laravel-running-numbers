<?php

namespace Soap\Laravel\RunningNumbers\Commands;

use Illuminate\Console\Command;
use Soap\Laravel\RunningNumbers\Models\RunningNumberKeeper;

class RunningNumberResetCommand extends Command
{
    public $signature = 'runningnumber:reset 
        {type : Type of running number}
        {prefix : Prefix before running number}
        {--reset-value=1 : Value to reset running number to}';

    public function handle(): int
    {
        $this->comment('Reset running number of '
            .$this->argument('type')
            .' with prefix '
            .$this->argument('prefix')
            .' to '.$this->option('reset-value')
            .'...');

        RunningNumberKeeper::where('type', $this->argument('type'))
            ->where('prefix', $this->argument('prefix'))
            ->update(['number' => $this->option('reset-value')]);

        return self::SUCCESS;
    }
}
