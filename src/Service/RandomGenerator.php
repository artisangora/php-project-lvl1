<?php

namespace Brain\Games\Service;

class RandomGenerator
{
    public function generateValue(): int
    {
        return random_int(0, 100);
    }

    public function generateRandomOperator(array $availableOperators)
    {
        $key = random_int(0, count($availableOperators) - 1);
        return $availableOperators[$key];
    }
}
