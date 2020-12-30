<?php

namespace Brain\Games\Service;

class AnswerStorage
{
    private array $elements = [];

    public function getElements(): array
    {
        return $this->elements;
    }

    public function add(Answer $answer): void
    {
        $this->elements[] = $answer;
    }

    public function last(): Answer
    {
        return end($this->elements);
    }
}
