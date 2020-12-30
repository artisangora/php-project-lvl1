<?php

namespace Brain\Games\Task;

use Brain\Games\Service\Question;

interface TaskInterface
{
    public function getRules(): string;

    /**
     * @param int $numberOfQuestions
     * @return \Generator|Question[]
     */
    public function getQuestions(int $numberOfQuestions): \Generator;
}
