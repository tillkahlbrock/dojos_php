<?php

class ReaderTest extends PHPUnit_Framework_TestCase
{
    const SOME_PARAM_STRING = 'some param string';

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
        $paramString = self::SOME_PARAM_STRING;

        $this->validator
            ->expects($this->any())
            ->method('validate')
            ->will($this->returnValue(true));

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
        $mapping = $this->someMapping();

        $this->parser = $this->getMock('\ArgsReader\Parser');
        $this->parser
            ->expects($this->any())
            ->method('parse')
            ->will($this->returnValue($mapping));

        $this->validator = $this->getMock('\ArgsReader\Validator');
        $this->validator
            ->expects($this->once())
            ->method('validate')
            ->with($this->identicalTo($mapping))
            ->will($this->returnValue(true));

        $this->buildReader()->read(self::SOME_PARAM_STRING);
    }

    /**
     * @test
     */
    public function it_should_throw_an_exception_if_the_validator_returns_false()
    {
        $this->setExpectedException('\InvalidArgumentException', 'Validation failed');

        $this->validator = $this->getMock('\ArgsReader\Validator');
        $this->validator
            ->expects($this->any())
            ->method('validate')
            ->will($this->returnValue(false));

        $this->buildReader()->read(self::SOME_PARAM_STRING);
    }

    private function someMapping()
    {
        return array('f' => 'some_arg');
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
