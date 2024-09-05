<?php

// declare(strict_types = 1);

namespace Soap\Laravel\RunningNumbers;

/** @phpstan-consistent-constructor */
final class RunningNumberGenerator

{
    protected $type = 'Default';

    protected $prefix;

    protected $length = 3;

    protected $reset = false;

    protected $runningNumber;

    protected $format = '{PREFIX}-{NUMBER}';

    private $tokens = [
        'TYPE',
        'PREFIX',
        'NUMBER',
    ];

    public static function make(): self
    {
        return new RunningNumberGenerator;
    }

    public function type($type): self
    {
        $this->type = $type;

        return $this;
    }

    public function prefix($prefix): self
    {
        $this->prefix = $prefix;

        return $this;
    }

    public function length($length): self
    {
        $this->length = $length;

        return $this;
    }

    public function reset($value = 0): self
    {
        $this->reset = true;
        $this->runningNumber = $value;

        return $this;
    }

    /**
     * @todo validate format tokens
     */
    public function format($format): self
    {
        $this->validateFormat($format);

        $this->format = $format;

        return $this;
    }

    public function generate(): string
    {
        if (empty($this->prefix)) {
            $this->prefix = date('Y');
        }

        if ($this->reset) {
            RunningNumber::reset($this->type, $this->prefix, $this->runningNumber);
            $this->reset = false;
        }

        $this->runningNumber = RunningNumber::next($this->type, $this->prefix);

        $paddedNumber = str_pad($this->runningNumber, $this->length, '0', STR_PAD_LEFT);

        return str_replace([
            '{TYPE}', '{PREFIX}', '{NUMBER}',
        ],
            [$this->type, $this->prefix, $paddedNumber],
            $this->format
        );
    }

    protected function validateFormat($format): void
    {
        $pattern = "/\{([^}]+)\}/"; // Match anything inside curly braces
        preg_match_all($pattern, $format, $matches);

        $resultArray = $matches[1]; // extract the tokens from the matches

        foreach ($resultArray as $token) {
            if (! in_array($token, $this->tokens)) {
                throw new \Exception("Invalid token: {$token}");
            }
        }

    }
}
