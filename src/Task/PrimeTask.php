<?php

namespace Brain\Games\Task;

use Brain\Games\Service\Question;
use Brain\Games\Service\RandomGenerator;

class PrimeTask implements TaskInterface
{
    private const YES = 'yes';
    private const NO = 'no';

    private const PRIME_MAP_SIZE = 100;

    private RandomGenerator $randomGenerator;
    private array $primeValues;

    public function __construct(RandomGenerator $randomGenerator)
    {
        $this->randomGenerator = $randomGenerator;
        $this->primeValues = $this->generatePrimes(self::PRIME_MAP_SIZE);
    }

    public function getRules(): string
    {
        return 'Answer "yes" if given number is prime. Otherwise answer "no".';
    }

    public function getQuestions(int $numberOfQuestions): \Generator
    {
        for ($i = 0; $i < $numberOfQuestions; $i++) {
            $question = $this->randomGenerator->generateValue(2, 100);
            $correctAnswer = $this->getCorrectAnswer($question);
            yield new Question($question, $correctAnswer);
        }
    }

    private function getCorrectAnswer(int $question): string
    {
        return $this->isPrime($question) ? self::YES : self::NO;
    }

    private function isPrime($value): bool
    {
        return array_key_exists($value, $this->primeValues);
    }

    private function generatePrimes($n): array
    {
        $s = [];
        $s[1] = 0;

        for ($k = 2; $k <= $n; $k++) {
            $s[$k] = 1;
        }

        for ($k = 2; $k * $k <= $n; $k++) {
            if ($s[$k] === 1) {
                for ($l = $k * $k; $l <= $n; $l += $k) {
                    $s[$l] = 0;
                }
            }
        }

        return array_filter($s, static fn($item) => $item === 1);
    }
}
