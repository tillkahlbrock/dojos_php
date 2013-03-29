<?php

class ReaderTest extends PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function it_should_return_true_for_an_empty_argslist_if_no_specification_is_given()
    {
       $reader = new \ArgsReader\Reader(array());
       $this->assertTrue($reader->parse(array()));
    }
}
