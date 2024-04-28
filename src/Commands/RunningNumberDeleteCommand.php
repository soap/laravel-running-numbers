<?php

namespace Soap\Laravel\RunningNumbers\Commands;

use Illuminate\Console\Command;
use Soap\Laravel\RunningNumbers\RunningNumber;

class RunningNumberDeleteCommand extends Command
{
    public $signature = 'runningnumber:delete 
        {type : Type of running number}
        {prefix : Prefix before running number}';

    public function handle(): int
    {
        $this->comment('Delete running number of '
            .$this->argument('type')
            .' with prefix '
            .$this->argument('prefix')
            .'...');
        RunningNumber::delete(
            $this->argument('type'),
            $this->argument('prefix')
        );

        return self::SUCCESS;
    }
}
