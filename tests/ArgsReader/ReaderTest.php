<?php

class ReaderTest extends PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function it_should_call_the_parser_with_the_given_parameter_string()
    {
        $paramString = 'some param string';

        $parser = $this->getMock('\ArgsReader\Parser');
        $parser
            ->expects($this->once())
            ->method('parse')
            ->with($paramString);

        $reader = new \ArgsReader\Reader($parser);

        $reader->read($paramString);
    }
}
