<?php

declare(strict_types=1);

namespace Soap\Laravel\RunningNumbers;

/** @phpstan-consistent-constructor */
final class RunningNumberGenerator
{
    protected string $type = 'Default';

    protected ?string $prefix = null;

    protected int $length = 3;

    protected bool $reset = false;

    protected ?int $runningNumber = null;

    protected string $format = '{PREFIX}-{NUMBER}';

    private array $tokens = [
        'TYPE',
        'PREFIX',
        'NUMBER',
    ];

    public static function make(): self
    {
        return new RunningNumberGenerator;
    }

    public function type(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function prefix(string $prefix): self
    {
        $this->prefix = $prefix;

        return $this;
    }

    public function length(int $length): self
    {
        $this->length = $length;

        return $this;
    }

    public function reset(int $value = 0): self
    {
        $this->reset = true;
        $this->runningNumber = $value;

        return $this;
    }

    /**
     * @todo validate format tokens
     */
    public function format(string $format): self
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

        $paddedNumber = str_pad((string) $this->runningNumber, $this->length, '0', STR_PAD_LEFT);

        return str_replace([
            '{TYPE}', '{PREFIX}', '{NUMBER}',
        ],
            [$this->type, $this->prefix, $paddedNumber],
            $this->format
        );
    }

    protected function validateFormat(string $format): void
    {
        $pattern = "/\{([^}]+)\}/"; // Match anything inside curly braces
        preg_match_all($pattern, $format, $matches);

        $resultArray = $matches[1]; // extract the tokens from the matches

        foreach ($resultArray as $token) {
            if (! in_array($token, $this->tokens, true)) {
                throw new \Exception("Invalid token: {$token}");
            }
        }

    }
}
