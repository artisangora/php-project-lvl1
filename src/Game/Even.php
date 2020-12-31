<?php

namespace Brain\Games\Game\Even;

use function Brain\Games\Engine\play;
use function Brain\Games\Service\RandomGenerator\generateValue;

const RULES = 'Answer "yes" if the number is even, otherwise answer "no".';

const YES = 'yes';
const NO = 'no';

function playEven(): void
{
    $game = function (): array {
        $question = generateValue();
        $correctAnswer = getCorrectAnswer($question);

        return compact('question', 'correctAnswer');
    };

    play(RULES, $game);
}

function getCorrectAnswer(int $question): string
{
    return isEven($question) ? YES : NO;
}

function isEven(int $value): bool
{
    return ($value % 2) === 0;
}
