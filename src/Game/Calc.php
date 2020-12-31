<?php

namespace Brain\Games\Game\Calc;

use function Brain\Games\Engine\play;
use function Brain\Games\Service\RandomGenerator\generateRandomOperator;
use function Brain\Games\Service\RandomGenerator\generateValue;

const RULES = 'What is the result of the expression?';

const PLUS = '+';
const MINUS = '-';
const MULTIPLY = '*';

function getAvailableOperators(): array
{
    return [PLUS, MINUS, MULTIPLY];
}

function playCalc(): void
{
    $game = function (): array {
        $operator = generateRandomOperator(getAvailableOperators());
        $value1 = generateValue();
        $value2 = generateValue();
        $question = sprintf('%d %s %d', $value1, $operator, $value2);
        $correctAnswer = getCorrectAnswer($value1, $operator, $value2);

        return compact('question', 'correctAnswer');
    };

    play(RULES, $game);
}

function getCorrectAnswer(int $value1, string $operator, int $value2): string
{
    switch ($operator) {
        case PLUS:
            return (string)($value1 + $value2);
        case MINUS:
            return (string)($value1 - $value2);
        case MULTIPLY:
            return (string)($value1 * $value2);
    }
    throw new \InvalidArgumentException('Unsupported operator');
}
