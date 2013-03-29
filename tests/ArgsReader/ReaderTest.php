<?php

class ReaderTest extends PHPUnit_Framework_TestCase
{

    private $specification;

    public function setUp()
    {
        $this->specification = array();
    }

    /**
     * @test
     */
    public function it_should_return_true_for_no_args_if_no_specification_is_given()
    {
       $this->assertTrue($this->buildReader()->parse(''));
    }

    /**
     * @test
     */
    public function it_should_return_true_if_parameter_f_is_specified_but_not_given()
    {
        $this->specification = array(
            'f' => 'boolean'
        );

        $this->assertTrue($this->buildReader()->parse(''));
    }

    /**
     * @test
     */
    public function it_should_throw_an_exception_if_a_not_specified_parameter_is_given()
    {
        $this->setExpectedException('\InvalidArgumentException', 'Unknown parameter \'-f\'');

        $this->specification = array();

        $this->buildReader()->parse('-f');
    }

    /**
     * @test
     */
    public function it_should_throw_an_exception_if_boolean_parameter_is_specified_but_string_is_given()
    {
        $this->setExpectedException('\InvalidArgumentException', 'Parameter \'-f\' must not have any arguments.');

        $this->specification = array(
            'f' => 'boolean'
        );

        $this->buildReader()->parse('-f some_string_arg');
    }

    /**
     * @test
     */
    public function it_should_allow_to_parse_two_bool_parameters_successively()
    {
        $this->specification = array(
            'f' => 'boolean',
            'l' => 'boolean'
        );

        $this->assertTrue($this->buildReader()->parse('-f -l'));
    }

    /**
     * @test
     */
    public function it_should_return_the_default_value_false_for_a_boolean_parameter()
    {
        $this->specification = array(
            'f' => 'boolean'
        );

        $reader = $this->buildReader();
        $reader->parse('');

        $this->assertFalse($reader->getArg('f'));
    }

    /**
     * @return \ArgsReader\Reader
     */
    private function buildReader()
    {
        return new \ArgsReader\Reader($this->specification);
    }
}
