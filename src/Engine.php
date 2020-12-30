<?php

namespace Brain\Games;

use Brain\Games\Exception\GameOverException;
use Brain\Games\Service\Answer;
use Brain\Games\Service\AnswerStorage;
use Brain\Games\Task\TaskInterface;

use function cli\line;
use function cli\prompt;

class Engine
{
    private const SUCCESS_ANSWER_TO_WIN = 3;

    public function start(TaskInterface $task): void
    {
        $answerStorage = new AnswerStorage();
        line('Welcome to the Brain Games!');
        $name = prompt('May I have your name?');
        line('Hello, %s!', $name);
        line($task->getRules());

        try {
            $answerStorage = $this->process($task, $answerStorage, ['name' => $name]);
        } catch (GameOverException $gameOverException) {
            $answerStorage = $gameOverException->getAnswerStorage();
            $answer = $answerStorage->last();
            line(
                "'%s' is wrong answer ;(. Correct answer was '%s'",
                $answer->getGivenAnswer(),
                $answer->getQuestion()->getCorrectAnswer()
            );
            line("Let's try again, %s!", $name);
        }
    }

    /**
     * @param TaskInterface $task
     * @param AnswerStorage $answerStorage
     * @param array $data
     * @return AnswerStorage
     * @throws GameOverException
     */
    private function process(TaskInterface $task, AnswerStorage $answerStorage, array $data): AnswerStorage
    {
        foreach ($task->getQuestions(self::SUCCESS_ANSWER_TO_WIN) as $question) {
            line('Question: %s', $question->getQuestion());
            $givenAnswer = prompt('Your answer');
            $answerStorage->add(new Answer($question, $givenAnswer));

            if ($givenAnswer !== $question->getCorrectAnswer()) {
                throw new GameOverException('Game over', $answerStorage);
            }

            line('Correct!');
        }
        line('Congratulations, %s!', $data['name']);

        return $answerStorage;
    }
}
