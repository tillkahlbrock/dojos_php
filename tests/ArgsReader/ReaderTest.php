<?php

class ReaderTest extends PHPUnit_Framework_TestCase
{
    const SOME_PARAM_STRING = 'some param string';
    const SOME_FLAG = 'f';
    const SOME_ARGUMENT = 'an argument';

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

        $this->parser = $this->aStub('\ArgsReader\Parser')->with('parse', array());
        $this->validator = $this->validator = $this->aStub('\ArgsReader\Validator')->with('validate', true);
    }


    /**
     * @test
     */
    public function it_should_call_the_parser_with_the_given_parameter_string()
    {
        $paramString = self::SOME_PARAM_STRING;

        $this->parser = $this->aMock('\ArgsReader\Parser');
        $this->parser
            ->expectsCall('parse')
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

        $this->parser->with('parse', $mapping);

        $this->validator = $this->aMock('\ArgsReader\Validator');
        $this->validator
            ->expectsCall('validate')
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

        $this->validator->with('validate', false);

        $this->buildReader()->read(self::SOME_PARAM_STRING);
    }

    /**
     * @test
     */
    public function it_should_return_null_if_the_requested_flag_has_not_been_parsed()
    {
        $this->parser->with('parse', array('f' => 'an argument'));

        $reader = $this->buildReader();

        $reader->read(self::SOME_PARAM_STRING);
        $this->assertNull($reader->getArgument('g'));
    }

    /**
     * @test
     */
    public function it_should_return_the_value_for_the_requested_flag()
    {
        $flag = self::SOME_FLAG;
        $argument = self::SOME_ARGUMENT;

        $this->parser->with('parse', array($flag => $argument));

        $reader = $this->buildReader();

        $reader->read(self::SOME_PARAM_STRING);
        $this->assertEquals($argument, $reader->getArgument($flag));
    }

    private function someMapping()
    {
        return array(self::SOME_FLAG => self::SOME_ARGUMENT);
    }

    /**
     * @return ArgsReader\Reader
     */
    private function buildReader()
    {
        $objectBuilder = new TestDataBuilder_ObjectBuilder('\ArgsReader\Reader');
        return $objectBuilder->with(
            array(
                $this->parser,
                $this->validator
            )
        )->build();
    }

    private function aStub($className)
    {
        return new TestDataBuilder_StubBuilder($className, $this);
    }

    private function aMock($className)
    {
        return new TestDataBuilder_MockBuilder($className, $this);
    }
}
