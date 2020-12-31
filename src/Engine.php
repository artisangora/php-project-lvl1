<?php

namespace Brain\Games\Engine;

use function cli\line;
use function cli\prompt;

const SUCCESS_ANSWER_TO_WIN = 3;

function play(string $rules, callable $game): void
{
    line('Welcome to the Brain Games!');
    $name = prompt('May I have your name?');
    line('Hello, %s!', $name);
    line($rules);

    for ($i = 0; $i < SUCCESS_ANSWER_TO_WIN; $i++) {
        $gameData = $game();
        $question = $gameData['question'];
        $correctAnswer = $gameData['correctAnswer'];

        line('Question: %s', $question);
        $givenAnswer = prompt('Your answer');

        if ($givenAnswer !== $correctAnswer) {
            line("'%s' is wrong answer ;(. Correct answer was '%s'", $givenAnswer, $correctAnswer);
            line("Let's try again, %s!", $name);
            return;
        }

        line('Correct!');
    }

    line('Congratulations, %s!', $name);
}
