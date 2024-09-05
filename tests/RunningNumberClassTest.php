<?php

use Soap\Laravel\RunningNumbers\RunningNumber;

test('RunningNumber can reset running number in database', function () {
    RunningNumber::reset('invoice', '2024', 100);
    $data = RunningNumber::list('invoice', '2024');

    expect(count($data))->toBe(1);
    expect($data[0]['type'])->toBe('invoice');
    expect($data[0]['prefix'])->toBe('2024');
    expect($data[0]['number'])->toBe(100);
});

test('RunningNumber can reset running number in database with default value', function () {
    RunningNumber::reset('invoice', '2024');
    $data = RunningNumber::list('invoice', '2024');

    expect(count($data))->toBe(1);
    expect($data[0]['type'])->toBe('invoice');
    expect($data[0]['prefix'])->toBe('2024');
    expect($data[0]['number'])->toBe(0);
});

test('RunningNumber can generate running number', function () {
    $startNumber = 0;
    RunningNumber::reset('invoice', '2024');
    $data = RunningNumber::list('invoice', '2024');
    $currentNumber = RunningNumber::current('invoice', '2024');

    $nextNumber = RunningNumber::next('invoice', '2024');
    expect($currentNumber)->toBe($startNumber);
    expect($nextNumber)->toBe($currentNumber + 1);
});
