<?php

namespace Soap\Laravel\RunningNumbers\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Soap\Laravel\RunningNumbers\RunningNumber
 */
class RunningNumber extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \Soap\Laravel\RunningNumbers\RunningNumber::class;
    }
}
