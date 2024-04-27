<?php

namespace Soap\Laravel\RunningNumbers;

use Soap\Laravel\RunningNumbers\Models\RunningNumberKeeper;

class RunningNumber
{
    public static function getTablePrefix()
    {
        return config('running-numbers.table_prefix', '');
    }

    public static function getTableName()
    {
        return self::getTablePrefix().'running_numbers';
    }

    public static function generate(string $type, string $prefix, int $length = 3, bool $reset = false, int $resetValue = 1)
    {
        $runningNumber = RunningNumberKeeper::where('type', $type)
            ->where('prefix', $prefix)
            ->first();

        if (! $runningNumber) {
            $runningNumber = new RunningNumberKeeper();
            $runningNumber->type = $type;
            $runningNumber->prefix = $prefix;
            if ($reset) {
                $runningNumber->number = $resetValue;
            } else {
                $runningNumber->number = 1;
            }
            $runningNumber->save();
        } else {
            if ($reset) {
                $runningNumber->number = $resetValue;
            } else {
                $runningNumber->number += 1;
            }
            $runningNumber->save();
        }

        return $prefix.str_pad($runningNumber->number, $length, '0', STR_PAD_LEFT);
    }

    public static function make(string $type, string $prefix, int $length = 3, bool $reset = false, int $resetValue = 1)
    {
        $runningNumber = RunningNumberKeeper::where('type', $type)
            ->where('prefix', $prefix)
            ->first();
        if (! $runningNumber) {
            $runningNumber = new RunningNumberKeeper();
            $runningNumber->type = $type;
            $runningNumber->prefix = $prefix;
            if ($reset) {
                $runningNumber->number = $resetValue;
            } else {
                $runningNumber->number = 1;
            }
            $runningNumber->number = 1;
            $runningNumber->save();
        } else {
            if ($reset) {
                $runningNumber->number = $resetValue;
            } else {
                $runningNumber->number += 1;
            }        
        }

        return $prefix.str_pad($runningNumber->number, $length, '0', STR_PAD_LEFT);
    }
}
