<?php

namespace ArgsReader;

class Reader
{
    public function __construct($specification)
    {
        $this->specification = $specification;
    }

    public function read($parameterString)
    {
        $parser = new \ArgsReader\Parser();
        $paramMapping = $parser->parse($parameterString);
        $this->validate($paramMapping);
        $this->paramMapping = $paramMapping;
    }

    public function getParam($key)
    {
        return $this->paramMapping[$key];
    }
}
