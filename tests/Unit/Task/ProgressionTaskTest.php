<?php

namespace Brain\Tests\Unit\Task;

use Brain\Games\Service\Question;
use Brain\Games\Service\RandomGenerator;
use Brain\Games\Task\ProgressionTask;
use PHPUnit\Framework\TestCase;

class ProgressionTaskTest extends TestCase
{
    public function testGetQuestionsMethod(): void
    {
        $count = 3;
        $correctAnswers = [
            ['5 7 9 11 13 .. 17 19 21 23' => '15'],
            ['2 5 8 .. 14 17 20 23 26 29' => '11'],
            ['14 19 24 29 34 39 44 49 54 ..' => '59']
        ];

        $randomGenerator = $this->createMock(RandomGenerator::class);
        $randomGenerator
            ->expects($this->exactly($count))
            ->method('generateValue')
            ->willReturn(5, 3, 9);
        $randomGenerator
            ->expects($this->exactly($count))
            ->method('generateProgression')
            ->willReturn(
                [5, 7, 9, 11, 13, 15, 17, 19, 21, 23],
                [2, 5, 8, 11, 14, 17, 20, 23, 26, 29],
                [14, 19, 24, 29, 34, 39, 44, 49, 54, 59],
            );

        $task = new ProgressionTask($randomGenerator);
        $questions = $task->getQuestions($count);
        $questions = iterator_to_array($questions);
        $this->assertCount($count, $questions);


        $result = array_map(
            static fn(Question $question) => [$question->getQuestion() => $question->getCorrectAnswer()],
            $questions
        );

        $this->assertEquals($correctAnswers, $result);
    }
}
