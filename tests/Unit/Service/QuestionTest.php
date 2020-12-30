<?php

namespace Brain\Tests\Unit\Service;

use Brain\Games\Service\Question;
use PHPUnit\Framework\TestCase;

class QuestionTest extends TestCase
{
    public function testBasic(): void
    {
        $obj = new Question('123?', '1234');
        $this->assertEquals('123?', $obj->getQuestion());
        $this->assertEquals('1234', $obj->getCorrectAnswer());
    }
}
