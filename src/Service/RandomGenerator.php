<?php

namespace Brain\Games\Service\RandomGenerator;

function generateValue(int $min = 0, int $max = 100): int
{
    return random_int($min, $max);
}

function generateRandomOperator(array $availableOperators): string
{
    $key = random_int(0, count($availableOperators) - 1);
    return $availableOperators[$key];
}

function generateProgression(): array
{
    $startValue = random_int(1, 20);
    $differenceValue = random_int(2, 5);

    $count = random_int(5, 10);
    $progression = [];

    for ($i = 1; $i <= $count; $i++) {
        $progression[] = $startValue + ($i - 1) * $differenceValue;
    }

    return $progression;
}
