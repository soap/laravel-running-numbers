<?php

declare(strict_types=1);

namespace Soap\Laravel\RunningNumbers\Models;

use Illuminate\Database\Eloquent\Model;
use Soap\Laravel\RunningNumbers\RunningNumber;

/**
 * @property string $type
 * @property string $prefix
 * @property int $number
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static> where(\Closure|string|array<string, mixed> $column, mixed $operator = null, mixed $value = null, string $boolean = 'and')
 * @method static \Illuminate\Database\Eloquent\Builder<static> select(array<int, string>|string ...$columns)
 * @method static static updateOrCreate(array<string, mixed> $attributes, array<string, mixed> $values = [])
 * @method static static firstOrCreate(array<string, mixed> $attributes, array<string, mixed> $values = [])
 * @method static void truncate()
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
    public function getTable(): string
    {
        return RunningNumber::getTableName();
    }
}
