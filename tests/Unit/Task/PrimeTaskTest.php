<?php

namespace Brain\Tests\Unit\Task;

use Brain\Games\Service\Question;
use Brain\Games\Service\RandomGenerator;
use Brain\Games\Task\PrimeTask;
use PHPUnit\Framework\TestCase;

class PrimeTaskTest extends TestCase
{
    public function testGetQuestionsMethod(): void
    {
        $count = 5;
        $correctAnswers = [['2' => 'yes'], ['4' => 'no'], ['96' => 'no'], ['97' => 'yes'], ['98' => 'no']];

        $randomGenerator = $this->createMock(RandomGenerator::class);
        $randomGenerator
            ->expects($this->exactly($count))
            ->method('generateValue')
            ->willReturn(2, 4, 96, 97, 98);

        $task = new PrimeTask($randomGenerator);
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
