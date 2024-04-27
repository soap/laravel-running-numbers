<?php

namespace Soap\Laravel\RunningNumbers\Commands;

use Illuminate\Console\Command;
use Soap\Laravel\RunningNumbers\Models\RunningNumberKeeper;

class RunningNumberListCommand extends Command
{
    public $signature = 'runningnumber:list 
        {type? : Type of running number} 
        {prefix? : Prefix before running number}';

    public $description = 'List running number tracking';

    public function handle(): int
    {
        $this->comment('List running number tracking');
        if ($this->argument('type') || $this->argument('prefix')) {
            $this->comment('Filter by:');
        } else {
            $this->comment('All types and prefixes');
        }
        $this->newLine();
        if ($this->argument('type')) {
            $this->comment('type: '.$this->argument('type'));
        }
        if ($this->argument('prefix')) {
            $this->comment('prefix: '.$this->argument('prefix'));
        }

        $query = RunningNumberKeeper::select('type', 'prefix', 'number');
        if ($this->argument('type')) {
            $query->where('type', $this->argument('type'));
        }

        if ($this->argument('prefix')) {
            $query->where('prefix', $this->argument('prefix'));
        }

        $this->table(['Type', 'Prefix', 'Number'],
            $query->get()->toArray()
        );

        return self::SUCCESS;
    }
}
