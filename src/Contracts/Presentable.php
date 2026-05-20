<?php

declare(strict_types=1);

namespace Soap\Laravel\RunningNumbers\Contracts;

interface Presentable
{
    public function format(string $name, string $number): string;
}
