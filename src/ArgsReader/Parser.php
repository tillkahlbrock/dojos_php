<?php

namespace ArgsReader;

class Parser
{
    public function parse($argumentString)
    {
        if ($argumentString == '') {
            return array();
        }

        $arguments = array();

        $args = explode(' ', $argumentString);

        foreach ($args as $arg) {
            if (preg_match('/^-(.)$/', $arg, $matches)) {
                $arguments[substr($matches[0], 1, 1)] = true;
            } else {
                end($arguments);
                $lastKey = key($arguments);
                if ($arguments[$lastKey]) {
                    $arguments[$lastKey] = $arg;
                }
            }
        }

        return $arguments;
    }
}
