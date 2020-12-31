<?php

namespace Brain\Games\Task;

use Brain\Games\Service\Question;
use Brain\Games\Service\RandomGenerator;

class ProgressionTask implements TaskInterface
{
    private const HIDDEN_ELEMENT_SYMBOL = '..';

    private RandomGenerator $randomGenerator;

    public function __construct(RandomGenerator $randomGenerator)
    {
        $this->randomGenerator = $randomGenerator;
    }

    public function getRules(): string
    {
        return 'What number is missing in the progression?';
    }

    public function getQuestions(int $numberOfQuestions): \Generator
    {
        for ($i = 0; $i < $numberOfQuestions; $i++) {
            $progression = $this->randomGenerator->generateProgression();
            $hideKey = $this->randomGenerator->generateValue(0, count($progression) - 1);

            $question = implode(' ', $this->hideValueInProgression($progression, $hideKey));
            $correctAnswer = $this->getCorrectAnswer($progression, $hideKey);

            yield new Question($question, $correctAnswer);
        }
    }

    private function getCorrectAnswer(array $progression, int $hideKey): string
    {
        return $progression[$hideKey];
    }

    public function hideValueInProgression(array $progression, int $key): array
    {
        $progression[$key] = self::HIDDEN_ELEMENT_SYMBOL;

        return $progression;
    }
}
