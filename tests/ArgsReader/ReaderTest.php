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

    /**
     * @test
     */
    public function it_should_return_true_if_parameter_f_is_specified_but_not_given()
    {
        $spec = array(
            'f' => 'boolean'
        );

        $reader = new \ArgsReader\Reader($spec);
        $this->assertTrue($reader->parse(array()));
    }

    /**
     * @test
     */
    public function it_should_return_the_default_value_false_for_a_boolean_parameter()
    {
        $spec = array(
            'f' => 'boolean'
        );

        $reader = new \ArgsReader\Reader($spec);
        $reader->parse(array());

        $this->assertFalse($reader->getArg('f'));
    }
}
