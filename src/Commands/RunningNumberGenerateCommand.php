<?php

namespace Soap\Laravel\RunningNumbers\Commands;

use Illuminate\Console\Command;
use Soap\Laravel\RunningNumbers\RunningNumber;

class RunningNumberGenerateCommand extends Command
{
    public $signature = 'runningnumber:generate 
        {type : Type of running number} 
        {prefix : Prefix before running number} 
        {--length=4 : Length of running number padding with zero} 
        {--reset : Reset running number to reset-value} 
        {--reset-value=1 : Value to reset running number to}';

    public $description = 'Generate running number';

    public function handle(): int
    {
        $this->comment('Generate running number for '.$this->argument('type'));
        $this->comment('prefix: '.$this->argument('prefix'));
        $this->comment('Length: '.$this->option('length'));

        $runningNumber = RunningNumber::generate(
            $this->argument('type'),
            $this->argument('prefix'),
            $this->option('length'),
        );

        $this->comment('Running number: '.$runningNumber);

        return self::SUCCESS;
    }
}
