<?php

namespace Brain\Games\Task;

use Brain\Games\Service\Question;
use Brain\Games\Service\RandomGenerator;

class GcdTask implements TaskInterface
{
    private RandomGenerator $randomGenerator;

    public function __construct(RandomGenerator $randomGenerator)
    {
        $this->randomGenerator = $randomGenerator;
    }

    public function getRules(): string
    {
        return 'Find the greatest common divisor of given numbers.';
    }

    public function getQuestions(int $numberOfQuestions): \Generator
    {
        for ($i = 0; $i < $numberOfQuestions; $i++) {
            $value1 = $this->randomGenerator->generateValue();
            $value2 = $this->randomGenerator->generateValue();
            $question = sprintf('%d %d', $value1, $value2);
            $correctAnswer = $this->getCorrectAnswer($value1, $value2);

            yield new Question($question, $correctAnswer);
        }
    }

    private function getCorrectAnswer(int $value1, int $value2): string
    {
        return $value2 === 0 ? $value1 : $this->getCorrectAnswer($value2, $value1 % $value2);
    }
}
