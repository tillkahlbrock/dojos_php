<?php

namespace ArgsReader;

class Reader
{
    public function __construct($specification)
    {
        $this->specification = $specification;
    }

    public function parse($argumentString)
    {
        if ($argumentString == '') {
            return true;
        }

        $args = explode(' ', $argumentString);

        $parameter = substr($args[0], 1, 1);

        if (!in_array($parameter, array_keys($this->specification))) {
            throw new \InvalidArgumentException('Unknown parameter \'-' . $parameter . '\'');
        }

        if ($args[0] == '-f' && isset($args[1]) && !preg_match('/^-.$/', $args[1])) {
            throw new \InvalidArgumentException('Parameter \'-f\' must not have any arguments.');
        }

        return true;
    }

    public function getArg()
    {
        return false;
    }
}
