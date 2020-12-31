<?php

namespace Brain\Games\Game\Prime;

use function Brain\Games\Engine\play;
use function Brain\Games\Service\RandomGenerator\generateValue;

const YES = 'yes';
const NO = 'no';
const PRIME_MAP_SIZE = 100;

const RULES = 'Answer "yes" if given number is prime. Otherwise answer "no".';

function playPrime(): void
{
    $game = function (): array {
        $question = generateValue(0, PRIME_MAP_SIZE);
        $correctAnswer = getCorrectAnswer($question);

        return compact('question', 'correctAnswer');
    };

    play(RULES, $game);
}

function getCorrectAnswer(int $question): string
{
    return isPrime($question) ? YES : NO;
}

function isPrime(int $value): bool
{
    return array_key_exists($value, generatePrimes(PRIME_MAP_SIZE));
}

function generatePrimes(int $n): array
{
    $isPrime = 1;
    $notPrime = 0;

    $s = [];
    $s[1] = $notPrime;

    for ($k = 2; $k <= $n; $k++) {
        $s[$k] = $isPrime;
    }

    for ($k = 2; $k * $k <= $n; $k++) {
        if ($s[$k] === $isPrime) {
            for ($l = $k * $k; $l <= $n; $l += $k) {
                $s[$l] = $notPrime;
            }
        }
    }

    return array_filter($s, static fn($item) => $item === $isPrime);
}
