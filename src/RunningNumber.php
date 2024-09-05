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

    /**
     * @deprecated next version will remove this method, use RunningNumberGenerator::make() instead
     */
    public static function generate(string $type, string $prefix, int $length = 3, bool $reset = false, int $resetValue = 1)
    {
        $runningNumber = RunningNumberKeeper::where('type', $type)
            ->where('prefix', $prefix)
            ->first();

        if (! $runningNumber) {
            $runningNumber = new RunningNumberKeeper;
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

        return $prefix.str_pad((string) $runningNumber->number, $length, '0', STR_PAD_LEFT);
    }

    /**
     * @deprecated next version will remove this method, use RunningNumberGenerator::make() instead
     */
    public static function make(string $type, string $prefix, int $length = 3, bool $reset = false, int $resetValue = 1)
    {
        $runningNumber = RunningNumberKeeper::where('type', $type)
            ->where('prefix', $prefix)
            ->first();
        if (! $runningNumber) {
            $runningNumber = new RunningNumberKeeper;
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

        return $prefix.str_pad((string) $runningNumber->number, $length, '0', STR_PAD_LEFT);
    }

    public static function reset(string $type, string $prefix, string|null|int $value = 0)
    {
        $runningNumber = RunningNumberKeeper::where('type', $type)
            ->where('prefix', $prefix)
            ->first();

        if (! $runningNumber) {
            $runningNumber = new RunningNumberKeeper;
            $runningNumber->type = $type;
            $runningNumber->prefix = $prefix;
            $runningNumber->number = $value;
            $runningNumber->save();
        } else {
            $runningNumber->number = $value;
            $runningNumber->save();
        }
    }

    public static function list(?string $type = null, ?string $prefix = null)
    {
        $query = RunningNumberKeeper::select('type', 'prefix', 'number');
        if ($type) {
            $query->where('type', $type);
        }

        if ($prefix) {
            $query->where('prefix', $prefix);
        }

        return $query->get()->toArray();
    }

    public static function current(string $type, string $prefix)
    {
        $runningNumber = RunningNumberKeeper::where('type', $type)
            ->where('prefix', $prefix)
            ->first();

        if (! $runningNumber) {
            return null;
        }

        return $runningNumber->number;
    }

    public static function next(string $type, string $prefix)
    {
        $runningNumber = RunningNumberKeeper::where('type', $type)
            ->where('prefix', $prefix)
            ->first();

        if (! $runningNumber) {
            $runningNumber = new RunningNumberKeeper;
            $runningNumber->type = $type;
            $runningNumber->prefix = $prefix;
            $runningNumber->number = 1;
            $runningNumber->save();
        } else {
            $runningNumber->number += 1;
            $runningNumber->save();
        }

        return $runningNumber->number;
    }

    public static function delete(string $type, ?string $prefix = null)
    {
        $query = RunningNumberKeeper::where('type', $type);
        if ($prefix) {
            $query->where('prefix', $prefix);
        }

        return $query->delete();
    }

    public static function flush()
    {
        return RunningNumberKeeper::truncate();
    }
}
