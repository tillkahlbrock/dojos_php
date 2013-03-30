<?php

namespace ArgsReader;

class Parser
{
    public function parse($parameterString)
    {
        if ($parameterString == '') {
            return array();
        }

        $paramArgMapping = array();

        $args = explode(' ', $parameterString);

        foreach ($args as $arg) {
            if (preg_match('/^-(.)$/', $arg, $matches)) {
                $paramArgMapping[substr($matches[0], 1, 1)] = true;
            } else {
                end($paramArgMapping);
                $lastKey = key($paramArgMapping);
                if ($paramArgMapping[$lastKey]) {
                    $paramArgMapping[$lastKey] = $arg;
                }
            }
        }

        return $paramArgMapping;
    }
}
