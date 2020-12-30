<?php

namespace Brain\Games\Service;

class Answer
{
    private Question $question;
    private string $givenAnswer;

    public function __construct(Question $question, string $givenAnswer)
    {
        $this->question = $question;
        $this->givenAnswer = $givenAnswer;
    }

    public function getQuestion(): Question
    {
        return $this->question;
    }

    public function getGivenAnswer(): string
    {
        return $this->givenAnswer;
    }
}
