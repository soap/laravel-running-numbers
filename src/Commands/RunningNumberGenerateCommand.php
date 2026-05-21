<?php

declare(strict_types=1);

namespace Soap\Laravel\RunningNumbers\Commands;

use Illuminate\Console\Command;
use Soap\Laravel\RunningNumbers\RunningNumberGenerator;

class RunningNumberGenerateCommand extends Command
{
    public $signature = 'runningnumber:generate 
        {type : Type of running number} 
        {prefix : Prefix before running number} 
        {--length=4 : Length of running number padding with zero} 
        {--format={PREFIX}-{NUMBER} : Format of running number}
        {--reset : Reset running number to reset-value} 
        {--reset-value=1 : Value to reset running number to}';

    public $description = 'Generate running number';

    public function handle(): int
    {
        $this->comment('Generate running number for '.$this->argument('type'));
        $this->comment('Prefix: '.$this->argument('prefix'));
        $this->comment('Length: '.$this->option('length'));
        $this->comment('Format: '.$this->option('format'));

        $generator = RunningNumberGenerator::make()
            ->type($this->argument('type'))
            ->prefix($this->argument('prefix'))
            ->length((int) $this->option('length'))
            ->format($this->option('format'));

        if ($this->option('reset')) {
            $generator->reset((int) $this->option('reset-value'));
        }

        $runningNumber = $generator->generate();

        $this->comment('Running number: '.$runningNumber);

        return self::SUCCESS;
    }
}
