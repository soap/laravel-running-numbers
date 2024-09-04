<?php

namespace Soap\Laravel\RunningNumbers\Contracts;

interface Presentable
{
    public function format(string $name, string $number): string;
}
