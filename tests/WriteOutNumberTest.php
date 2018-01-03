<?php

use PHPUnit\Framework\TestCase;

class WriteOutNumbersTest extends TestCase
{
    private $class;
    
    public function setUp()
    {
        parent::setUp();
        $this->class = new \App\Generator();
    }

    /**
     * Use these tests to help you build your generator.
     * Remember it should handle ALL numbers between 0 and 999999, not just the ones
     * below
     */
    public function testBasic()
    {
        $this->assertEquals('zero', $this->class->number2words(0));
        $this->assertEquals('one', $this->class->number2words(1));
        $this->assertEquals('eight', $this->class->number2words(8));
        $this->assertEquals('ten', $this->class->number2words(10));
        $this->assertEquals('nineteen', $this->class->number2words(19));
        $this->assertEquals('twenty', $this->class->number2words(20));
        $this->assertEquals('twenty-two', $this->class->number2words(22));
        $this->assertEquals('fifty-four', $this->class->number2words(54));
        $this->assertEquals('eighty', $this->class->number2words(80));
        $this->assertEquals('ninety-eight', $this->class->number2words(98));
        $this->assertEquals('one hundred', $this->class->number2words(100));
        $this->assertEquals('three hundred one', $this->class->number2words(301));
        $this->assertEquals('seven hundred ninety-three', $this->class->number2words(793));
        $this->assertEquals('eight hundred', $this->class->number2words(800));
        $this->assertEquals('six hundred fifty', $this->class->number2words(650));
        $this->assertEquals('one thousand', $this->class->number2words(1000));
        $this->assertEquals('one thousand three', $this->class->number2words(1003));
    }
}
