<?php

namespace ArgsReader;

class Parser
{
    public function parse($parameterString)
    {
        if ($parameterString == '') {
            return array();
        }

        if (substr($parameterString, 0, 1) != '-') {
            throw new \InvalidArgumentException('No parameter given');
        }

        $paramArgMapping = array();

        $args = explode(' ', $parameterString);

        foreach ($args as $arg) {
            if (preg_match('/^-(.)$/', $arg, $matches)) {
                $paramArgMapping[substr($matches[0], 1, 1)] = true;
            } else {
                end($paramArgMapping);
                $lastKey = key($paramArgMapping);
                if (is_bool($paramArgMapping[$lastKey]) && $paramArgMapping[$lastKey]) {
                    $paramArgMapping[$lastKey] = $arg;
                } else {
                    throw new \InvalidArgumentException('Only one argument per parameter allowed');
                }
            }
        }

        return $paramArgMapping;
    }
}
