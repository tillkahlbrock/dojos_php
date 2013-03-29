<?php

class FizzBuzzTest extends \PHPUnit_Framework_TestCase
{

    private $buzzer;

    protected function setUp()
    {
        $this->buzzer = new \FizzBuzz\Buzzer();
    }

    /**
     * @test
     */
    public function it_should_return_1_for_input_1()
    {
        $this->assertEquals(1, $this->buzzer->printIt(1));
    }

    /**
     * @test
     */
    public function it_should_return_2_for_input_2()
    {
        $this->assertEquals(2, $this->buzzer->printIt(2));
    }

    /**
     * @test
     */
    public function it_should_return_fizz_for_input_3()
    {
        $this->assertEquals('fizz', $this->buzzer->printIt(3));
    }
}
