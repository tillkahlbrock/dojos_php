<?php

namespace ArgsReader;

class Reader
{
    private $parser;

    public function __construct(\ArgsReader\Parser $parser)
    {
        $this->parser = $parser;
    }

    public function read($parameterString)
    {
        $this->parser->parse($parameterString);
    }
}
