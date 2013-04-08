<?php

namespace ArgsReader;

class Reader
{
    private $parser;
    private $validator;

    public function __construct(
        \ArgsReader\Parser $parser,
        \ArgsReader\Validator $validator
    )
    {
        $this->parser = $parser;
        $this->validator = $validator;
    }

    public function read($parameterString)
    {
        $paramArgMapping = $this->parser->parse($parameterString, array());
        if (!$this->validator->validate($paramArgMapping)) {
            throw new \InvalidArgumentException('Validation failed');
        }
    }
}
