<?php

namespace Brain\Games\Exception;

use Brain\Games\Service\AnswerStorage;

class GameOverException extends \Exception
{
    private AnswerStorage $answerStorage;

    public function __construct($message, AnswerStorage $answerStorage)
    {
        parent::__construct($message);
        $this->answerStorage = $answerStorage;
    }

    public function getAnswerStorage(): AnswerStorage
    {
        return $this->answerStorage;
    }
}
