<?php

namespace Soap\Laravel\RunningNumbers;

use Soap\Laravel\RuningNumbers\RunningNumber;

class RunningNumberGenerator
{
    protected $type = 'Default';

    protected $prefix;

    protected $length = 3;

    protected $reset = false;

    protected $runningNumber;

    protected $format = '{PREFIX}-{NUMBER}';

    public static function make()
    {
        return new static(self::class);
    }

    public function type($type)
    {
        $this->type = $type;

        return $this;
    }

    public function prefix($prefix)
    {
        $this->prefix = $prefix;

        return $this;
    }

    public function length($length)
    {
        $this->length = $length;

        return $this;
    }

    public function reset($value = 0)
    {
        $this->reset = true;
        $this->runningNumber = $value;

        return $this;
    }

    /**
     * @todo validate format tokens
     */
    public function format($format)
    {
        $this->format = $format;

        return $this;
    }

    public function generate()
    {
        if ($this->reset) {
            RunningNumber::reset($this->type, $this->prefix, $this->runningNumber);
        }

        $this->runningNumber = RuningNumber::next($this->type, $this->prefix);

        $paddedNumber = str_pad($this->runningNumber, $this->length, '0', STR_PAD_LEFT);

        return str_replace([
            '{TYPE}', '{PREFIX}', '{NUMBER}',
        ],
            [$this->type, $this->prefix, $paddedNumber],
            $this->format
        );
    }
}
