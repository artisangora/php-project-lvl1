<?php

namespace Brain\Tests\Unit\Task;

use Brain\Games\Service\Question;
use Brain\Games\Service\RandomGenerator;
use Brain\Games\Task\EvenTask;
use Brain\Games\Task\GcdTask;
use PHPUnit\Framework\TestCase;

class GcdTaskTest extends TestCase
{
    public function testGetQuestionsMethod(): void
    {
        $count = 3;
        $correctAnswers = [['25 50' => '25'], ['39 7' => '1'], ['2 4' => '2']];

        $randomGenerator = $this->createMock(RandomGenerator::class);
        $randomGenerator
            ->expects($this->exactly($count * 2))
            ->method('generateValue')
            ->willReturn(25, 50, 39, 7, 2, 4);

        $task = new GcdTask($randomGenerator);
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
