<?php

namespace Brain\Games;

use function cli\line;
use function cli\prompt;

class Even
{
    private const YES = 'yes';
    private const NO = 'no';

    public function start(): void
    {
        line('Welcome to the Brain Games!');
        $name = prompt('May I have your name?');
        line('Hello, %s!', $name);
        line('Answer "yes" if the number is even, otherwise answer "no".');

        $correctAnswersCount = 0;
        while (true) {
            if ($correctAnswersCount === 3) {
                line('Congratulations, %s!', $name);
                break;
            }

            $question = $this->generateValue();
            line('Question: %s', $question);
            $answer = prompt('Your answer');

            $correctAnswer = $this->getCorrectAnswer($question);
            if ($answer === $correctAnswer) {
                $correctAnswersCount++;
                line('Correct!');
                continue;
            }

            line("'%s' is wrong answer ;(. Correct answer was '%s'", $answer, $correctAnswer);
            line("Let's try again, %s!", $name);
            break;
        }
    }

    private function getCorrectAnswer(int $questionValue): string
    {
        return $this->isEven($questionValue) ? self::YES : self::NO;
    }

    private function isEven(int $value): bool
    {
        return ($value % 2) === 0;
    }

    private function generateValue(): int
    {
        return random_int(0, 100);
    }
}
