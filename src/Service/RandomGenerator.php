<?php

namespace Brain\Games\Service;

class RandomGenerator
{
    public function generateValue(): int
    {
        return random_int(0, 100);
    }
}
