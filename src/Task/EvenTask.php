<?php

namespace Brain\Games\Task;

use Brain\Games\Service\Question;
use Brain\Games\Service\RandomGenerator;

class EvenTask implements TaskInterface
{
    private const YES = 'yes';
    private const NO = 'no';

    private RandomGenerator $randomGenerator;

    public function __construct(RandomGenerator $randomGenerator)
    {
        $this->randomGenerator = $randomGenerator;
    }

    public function getRules(): string
    {
        return 'Answer "yes" if the number is even, otherwise answer "no".';
    }

    public function getQuestions(int $numberOfQuestions): \Generator
    {
        for ($i = 0; $i < $numberOfQuestions; $i++) {
            $question = $this->randomGenerator->generateValue();
            $correctAnswer = $this->getCorrectAnswer($question);
            yield new Question($question, $correctAnswer);
        }
    }

    private function getCorrectAnswer(int $question): string
    {
        return $this->isEven($question) ? self::YES : self::NO;
    }

    private function isEven(int $value): bool
    {
        return ($value % 2) === 0;
    }
}
