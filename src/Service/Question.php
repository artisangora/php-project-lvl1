<?php

namespace Brain\Games\Service;

class Question
{
    private string $question;
    private string $correctAnswer;

    public function __construct(string $question, string $correctAnswer)
    {
        $this->question = $question;
        $this->correctAnswer = $correctAnswer;
    }

    public function getQuestion(): string
    {
        return $this->question;
    }

    public function getCorrectAnswer(): string
    {
        return $this->correctAnswer;
    }
}
