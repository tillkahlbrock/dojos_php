<?php

class ParserTest extends PHPUnit_Framework_TestCase
{
    private $parser;

    protected function setUp()
    {
        $this->parser = new \ArgsReader\Parser();
    }

    /**
     * @test
     */
    public function it_should_return_an_empty_array_if_no_parameters_are_given()
    {
        $this->assertEquals(array(), $this->parser->parse('', array()));
    }

    /**
     * @test
     */
    public function it_should_parse_one_bool_parameter()
    {
        $this->assertEquals(array('f' => true), $this->parser->parse('-f'));
    }

    /**
     * @test
     */
    public function it_should_parse_two_bool_parameter()
    {
        $this->assertEquals(
            array(
                'f' => true,
                'p' => true
            ),
            $this->parser->parse('-f -p')
        );
    }

    /**
     * @test
     */
    public function it_should_parse_a_parameter_with_one_argument()
    {
        $this->assertEquals(array('n' => 123), $this->parser->parse('-n 123'));
    }

    /**
     * @test
     */
    public function it_should_throw_an_exception_if_called_with_a_parameter_with_two_arguments()
    {
        $this->setExpectedException('\InvalidArgumentException', 'Only one argument per parameter allowed');
        $this->parser->parse('-p some_argument another_argument');
    }

    /**
     * @test
     */
    public function it_should_throw_an_exception_if_no_parameter_but_an_argument_is_given()
    {
        $this->setExpectedException('\InvalidArgumentException', 'Arguments must start with a flag');

        $this->parser->parse('some_argument', array());
    }
}
