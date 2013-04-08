<?php

namespace ArgsReader;

class Reader
{
    private $parser;
    private $validator;
    private $parameters;

    public function __construct(
        \ArgsReader\Parser $parser,
        \ArgsReader\Validator $validator
    )
    {
        $this->parser = $parser;
        $this->validator = $validator;
        $this->parameters = array();
    }

    public function read($parameterString)
    {
        $paramArgMapping = $this->parser->parse($parameterString, array());

        if (!$this->validator->validate($paramArgMapping)) {
            throw new \InvalidArgumentException('Validation failed');
        }

        $this->parameters = $paramArgMapping;
    }

    public function getArgument($flag)
    {
        if (isset($this->parameters[$flag])) {
            return $this->parameters[$flag];
        }

        return null;
    }
}
