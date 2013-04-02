<?php

namespace ArgsReader;

class Parser
{
    public function parse($parameterString, array $specification)
    {
        if ($parameterString == '') {
            return array();
        }

        $paramArgMapping = array();

        $args = explode(' ', $parameterString);

        foreach ($args as $arg) {
            if (preg_match('/^-(.)$/', $arg, $matches)) {
                $flag = $matches[1];
                if (!array_key_exists($flag, $specification)) {
                    throw new \InvalidArgumentException('Parameter \'-' . $flag . '\' not specified');
                }
                $paramArgMapping[$flag] = true;
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

        foreach ($paramArgMapping as $param => $arg) {
            if (!is_bool($arg) && $specification[$param] == 'bool' ) {
                throw new \InvalidArgumentException('Parameter \'-' . $lastKey . '\' must not be called with an argument');
            }

            if (is_bool($arg) && $specification[$param] != 'bool') {
                throw new \InvalidArgumentException('Parameter \'-' . $param . '\' must not be called without an argument');
            }
        }

        return $paramArgMapping;
    }
}
