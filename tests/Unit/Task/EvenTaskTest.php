<?php

namespace Brain\Tests\Unit\Task;

use Brain\Games\Service\Question;
use Brain\Games\Service\RandomGenerator;
use Brain\Games\Task\EvenTask;
use PHPUnit\Framework\TestCase;

class EvenTaskTest extends TestCase
{
    public function testGetQuestionsMethod(): void
    {
        $count = 3;
        $correctAnswers = [['1' => 'no'], ['2' => 'yes'], ['3' => 'no']];

        $randomGenerator = $this->createMock(RandomGenerator::class);
        $randomGenerator
            ->expects($this->exactly($count))
            ->method('generateValue')
            ->willReturn(1, 2, 3);

        $task = new EvenTask($randomGenerator);
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
