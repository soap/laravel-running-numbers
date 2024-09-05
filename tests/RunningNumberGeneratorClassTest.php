<?php

use Soap\Laravel\RunningNumbers\RunningNumberGenerator;

test('Generator can create default running number set', function () {

    /**
     * Type: Default
     * Prefix: Date('Y')
     * Number: 001
     */
    $runningStr = RunningNumberGenerator::make()->generate();

    expect($runningStr)->toBe(date('Y').'-001');
});

test('Generator can create running number set with custom prefix', function () {

    /**
     * Type: Default
     * Prefix: 'INV'
     * Number: 001
     */
    $firsrRunningStr = RunningNumberGenerator::make()->prefix('INV')->generate();
    $secondRunningStr = RunningNumberGenerator::make()->prefix('INV')->generate();

    expect($firsrRunningStr)->toBe('INV-001');
    expect($secondRunningStr)->toBe('INV-002');
});

test('Generator can create running number set with custom length', function () {

    /**
     * Type: Default
     * Prefix: 'INV'
     * Number: 001
     * Length: 5
     */
    $runningStr = RunningNumberGenerator::make()->prefix('INV')->length(5)->generate();

    expect($runningStr)->toBe('INV-00001');
});

test('Generator can create running number set with reset', function () {

    /**
     * Type: Default
     * Prefix: 'INV'
     * Number: 100
     */
    $runningStr = RunningNumberGenerator::make()->prefix('INV')->reset(100)->generate();

    expect($runningStr)->toBe('INV-101');
});

test('Generator can create running number set with custom format', function () {

    /**
     * Type: Default
     * Prefix: 'INV'
     * Number: 100
     * Format: 'INV/{NUMBER}'
     */
    $runningStr = RunningNumberGenerator::make()->prefix('INV')->reset(100)->format('{PREFIX}/{NUMBER}')->generate();

    expect($runningStr)->toBe('INV/101');
});

test('Generator throws exception on invalid format token', function () {

    $runningStr = RunningNumberGenerator::make()->prefix('INV')->format('{YEAR}{PREFIX}/{NUMBER}')->generate();

})->throws(Exception::class);
