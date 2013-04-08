<?php

class ReaderTest extends PHPUnit_Framework_TestCase
{

    /**
     * @var \ArgsReader\Parser | PHPUnit_Framework_MockObject_MockObject
     */
    private $parser;

    /**
     * @var \ArgsReader\Validator | PHPUnit_Framework_MockObject_MockObject
     */
    private $validator;

    protected function setUp()
    {
        parent::setUp();

        $this->parser = $this->getMock('\ArgsReader\Parser');
        $this->validator = $this->getMock('\ArgsReader\Validator');
    }


    /**
     * @test
     */
    public function it_should_call_the_parser_with_the_given_parameter_string()
    {
        $paramString = 'some param string';

        $this->parser = $this->getMock('\ArgsReader\Parser');
        $this->parser
            ->expects($this->once())
            ->method('parse')
            ->with($paramString, $this->anything());

        $reader = $this->buildReader();

        $reader->read($paramString);
    }

    /**
     * @test
     */
    public function it_should_call_the_validator_with_the_mapping_from_the_parser()
    {

    }

    /**
     * @return ArgsReader\Reader
     */
    private function buildReader()
    {
        return new \ArgsReader\Reader(
            $this->parser,
            $this->validator
        );
    }
}
