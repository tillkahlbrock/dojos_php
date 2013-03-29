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
    public function it_should_return_an_empty_array_if_no_arguments_are_given()
    {
        $this->assertEquals(array(), $this->parser->parse(''));
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
}
