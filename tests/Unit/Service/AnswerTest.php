<?php

namespace Brain\Tests\Unit\Service;

use Brain\Games\Service\Answer;
use Brain\Games\Service\Question;
use PHPUnit\Framework\TestCase;

class AnswerTest extends TestCase
{
    public function testBasic(): void
    {
        $question = $this->createMock(Question::class);
        $obj = new Answer($question, '1234');
        $this->assertEquals($question, $obj->getQuestion());
        $this->assertEquals('1234', $obj->getGivenAnswer());
    }
}
