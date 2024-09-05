<?php

namespace Soap\Laravel\RunningNumbers\Models;

use Illuminate\Database\Eloquent\Model;
use Soap\Laravel\RunningNumbers\RunningNumber;

/**
 * @property string $type
 * @property string $prefix
 * @property int $number
 */
class RunningNumberKeeper extends Model
{
    protected $fillable = [
        'type',
        'prefix',
        'number',
    ];

    /**
     * Get the table associated with the model.
     */
    public function getTable()
    {
        return RunningNumber::getTableName();
    }
}
