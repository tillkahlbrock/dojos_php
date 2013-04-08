<?php

namespace ArgsReader;

class Validator
{
    private $specification;

    public function __construct($specification = array())
    {
        $this->specification = $specification;
    }

    public function validate($mapping)
    {
        foreach ($mapping as $flag => $value) {
            if (!array_key_exists($flag, $this->specification)) {
                return false;
            }

            if ($this->specification[$flag] == 'string' && is_bool($value)) {
                return false;
            }

            if ($this->specification[$flag] == 'bool' && is_string($value)) {
                return false;
            }

        }
        return true;
    }
}
