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
        $specification = array('f' => 'bool');
        $this->assertEquals(array('f' => true), $this->parser->parse('-f', $specification));
    }

    /**
     * @test
     */
    public function it_should_parse_two_bool_parameter()
    {
        $specification = array(
            'f' => 'bool',
            'p' => 'bool'
        );

        $this->assertEquals(
            array(
                'f' => true,
                'p' => true
            ),
            $this->parser->parse('-f -p', $specification)
        );
    }

    /**
     * @test
     */
    public function it_should_parse_a_parameter_with_one_argument()
    {
        $specification = array('n' => 'int');
        $this->assertEquals(array('n' => 123), $this->parser->parse('-n 123', $specification));
    }

    /**
     * @test
     */
    public function it_should_throw_an_exception_if_called_with_a_parameter_with_two_arguments()
    {
        $specification = array('p' => 'string');
        $this->setExpectedException('\InvalidArgumentException', 'Only one argument per parameter allowed');
        $this->parser->parse('-p some_argument another_argument', $specification);
    }

    /**
     * @test
     */
    public function it_should_throw_an_exception_if_called_with_an_unspecified_parameter()
    {
        $this->setExpectedException('\InvalidArgumentException', 'Parameter \'-u\' not specified');

        $specification = array('f' => 'bool');

        $this->parser->parse('-u', $specification);
    }

    /**
     * @test
     */
    public function it_should_throw_an_exception_if_a_bool_parameter_is_called_with_an_argument()
    {
        $this->setExpectedException('\InvalidArgumentException', 'Parameter \'-u\' must not be called with an argument');

        $specification = array('u' => 'bool');

        $this->parser->parse('-u some_argument', $specification);
    }

    /**
     * @test
     */
    public function it_should_throw_an_exception_if_a_string_parameter_is_called_without_an_argument()
    {
        $this->setExpectedException('\InvalidArgumentException', 'Parameter \'-u\' must not be called without an argument');

        $specification = array('u' => 'string');

        $this->parser->parse('-u', $specification);
    }
}
