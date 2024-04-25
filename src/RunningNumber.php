<?php

namespace Soap\Laravel\RunningNumbers;

use Soap\Laravel\RunningNumbers\Models\RunningNumberKeeper;

class RunningNumber
{
    public static function getTablePrefix()
    {
        return config('running-numbers.table_prefix');
    }

    public static function generate($type, $prefix, $length = 3, $reset = false)
    {
        $runningNumber = RunningNumberKeeper::where('type', $type)
            ->where('prefix', $prefix)
            ->first();

        if (! $runningNumber) {
            $runningNumber = new RunningNumberKeeper();
            $runningNumber->type = $type;
            $runningNumber->prefix = $prefix;
            $runningNumber->number = 1;
            $runningNumber->save();
        } else {
            if ($reset) {
                $runningNumber->number = 1;
                $runningNumber->save();
            } else {
                $runningNumber->number += 1;
                $runningNumber->save();
            }
            $runningNumber->save();
        }

        return $prefix.str_pad($number, $length, '0', STR_PAD_LEFT);
    }

    public static function make($type, $prefix, $length = 3, $reset = false)
    {

    }
}
