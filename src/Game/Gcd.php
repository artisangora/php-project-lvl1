<?php

namespace Brain\Games\Game\Gcd;

use function Brain\Games\Engine\play;
use function Brain\Games\Service\RandomGenerator\generateValue;

const RULES = 'Find the greatest common divisor of given numbers.';

function playGcd(): void
{
    $game = function (): array {
        $value1 = generateValue();
        $value2 = generateValue();
        $question = sprintf('%d %d', $value1, $value2);
        $correctAnswer = getCorrectAnswer($value1, $value2);

        return compact('question', 'correctAnswer');
    };

    play(RULES, $game);
}

function getCorrectAnswer(int $value1, int $value2): string
{
    return (string)getGcd($value1, $value2);
}

function getGcd(int $value1, int $value2): int
{
    return $value2 === 0 ? $value1 : getGcd($value2, $value1 % $value2);
}
