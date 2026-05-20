<?php

declare(strict_types=1);

namespace Soap\Laravel\RunningNumbers\Contracts;

interface Generator
{
    public function generate(string $name, array $options = []): string;
}
