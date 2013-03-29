<?php

namespace ArgsReader;

class Parser
{
    public function parse($argumentString)
    {
        $arguments = array();

        $args = explode(' ', $argumentString);

        foreach ($args as $arg) {
            if (preg_match('/^-(.)$/', $arg, $matches)) {
                $arguments[substr($matches[0], 1, 1)] = true;
            }
        }

        return $arguments;
    }
}
