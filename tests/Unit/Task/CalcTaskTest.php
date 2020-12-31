<?php

namespace Brain\Tests\Unit\Task;

use Brain\Games\Service\Question;
use Brain\Games\Service\RandomGenerator;
use Brain\Games\Task\CalcTask;
use PHPUnit\Framework\TestCase;

class CalcTaskTest extends TestCase
{
    public function testGetQuestionsMethod(): void
    {
        $count = 3;
        $correctAnswers = [['1 + 1' => '2'], ['3 - 5' => '-2'], ['3 * 5' => '15']];

        $randomGenerator = $this->createMock(RandomGenerator::class);
        $randomGenerator
            ->expects($this->exactly($count * 2))
            ->method('generateValue')
            ->willReturn(1, 1, 3, 5, 3, 5);
        $randomGenerator
            ->expects($this->exactly($count))
            ->method('generateRandomOperator')
            ->willReturn('+', '-', '*');

        $task = new CalcTask($randomGenerator);
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
