<?php

namespace Brain\Tests\Unit\Service;

use Brain\Games\Service\Answer;
use Brain\Games\Service\AnswerStorage;
use PHPUnit\Framework\TestCase;

class AnswerStorageTest extends TestCase
{
    public function testBasic(): void
    {
        $answer1 = $this->createMock(Answer::class);
        $answer2 = $this->createMock(Answer::class);
        $obj = new AnswerStorage();
        $this->assertEquals([], $obj->getElements());

        $obj->add($answer1);
        $obj->add($answer2);
        $this->assertEquals([$answer1, $answer2], $obj->getElements());

        $this->assertEquals($answer2, $obj->last());
    }
}
