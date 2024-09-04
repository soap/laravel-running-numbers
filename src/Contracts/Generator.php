<?php

namespace Soap\Laravel\RunningNumbers\Contracts;

interface Generator
{
    public function generate(string $name, array $options = []): string;
}
