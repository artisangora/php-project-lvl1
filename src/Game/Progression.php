<?php

namespace Brain\Games\Game\Progression;

use function Brain\Games\Engine\play;
use function Brain\Games\Service\RandomGenerator\generateProgression;
use function Brain\Games\Service\RandomGenerator\generateValue;

const HIDDEN_ELEMENT_SYMBOL = '..';
const RULES = 'What number is missing in the progression?';

function playProgression(): void
{
    $game = function (): array {
        $progression = generateProgression();
        $hideKey = generateValue(0, count($progression) - 1);

        $question = implode(' ', hideValueInProgression($progression, $hideKey));
        $correctAnswer = getCorrectAnswer($progression, $hideKey);

        return compact('question', 'correctAnswer');
    };

    play(RULES, $game);
}

function getCorrectAnswer(array $progression, int $hideKey): string
{
    return $progression[$hideKey];
}

function hideValueInProgression(array $progression, int $key): array
{
    $progression[$key] = HIDDEN_ELEMENT_SYMBOL;

    return $progression;
}
