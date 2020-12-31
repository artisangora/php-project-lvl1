<?php

namespace Brain\Games\Task;

use Brain\Games\Service\Question;
use Brain\Games\Service\RandomGenerator;
use InvalidArgumentException;

class CalcTask implements TaskInterface
{
    private const PLUS = '+';
    private const MINUS = '-';
    private const MULTIPLY = '*';

    private static array $availableOperators = [
        self::PLUS,
        self::MINUS,
        self::MULTIPLY
    ];

    private RandomGenerator $randomGenerator;

    public function __construct(RandomGenerator $randomGenerator)
    {
        $this->randomGenerator = $randomGenerator;
    }

    public function getRules(): string
    {
        return 'What is the result of the expression?';
    }

    public function getQuestions(int $numberOfQuestions): \Generator
    {
        for ($i = 0; $i < $numberOfQuestions; $i++) {
            $operator = $this->randomGenerator->generateRandomOperator(self::$availableOperators);
            $value1 = $this->randomGenerator->generateValue();
            $value2 = $this->randomGenerator->generateValue();
            $question = sprintf('%d %s %d', $value1, $operator, $value2);
            $correctAnswer = $this->getCorrectAnswer($value1, $operator, $value2);

            yield new Question($question, $correctAnswer);
        }
    }

    private function getCorrectAnswer(int $value1, string $operator, int $value2): string
    {
        switch ($operator) {
            case self::PLUS:
                return $value1 + $value2;
            case self::MINUS:
                return $value1 - $value2;
            case self::MULTIPLY:
                return $value1 * $value2;
        }
        throw new InvalidArgumentException('Unsupported operator');
    }
}
