<?php

namespace ArgsReader;

class Reader
{
    public function parse($argumentString)
    {
        $args = explode(' ', $argumentString);

        if ($args[0] == '-f' && isset($args[1])) {// && !preg_match('/^-.$/', $args[1])) {
            throw new \InvalidArgumentException('Parameter \'-f\' must not have any arguments.');
        }
        return true;
    }

    public function getArg()
    {
        return false;
    }
}
