<?php

namespace ArgsReader;

class Parser
{
    private $paramArgMapping = array();

    public function parse($parameterString, array $specification)
    {
        if ($parameterString == '') {
            return array();
        }

        $args = explode(' ', $parameterString);
        $lastKey = null;

        foreach ($args as $arg) {
            if (preg_match('/^-(.)$/', $arg, $matches)) {
                $lastKey = $this->parseFlag($matches, $specification);
            } else {
                if (!is_bool($this->paramArgMapping[$lastKey])) {
                    throw new \InvalidArgumentException('Only one argument per parameter allowed');
                }
                $this->paramArgMapping[$lastKey] = $arg;
            }
        }

        $this->validateMapping($specification);

        return $this->paramArgMapping;
    }

    private function parseFlag($matches, $specification)
    {
        $flag = $matches[1];
        if (!array_key_exists($flag, $specification)) {
            throw new \InvalidArgumentException('Parameter \'-' . $flag . '\' not specified');
        }
        $this->paramArgMapping[$flag] = true;
        return $flag;
    }

    private function validateMapping($specification)
    {
        foreach ($this->paramArgMapping as $param => $arg) {
            if (!is_bool($arg) && $specification[$param] == 'bool' ) {
                throw new \InvalidArgumentException('Parameter \'-' . $param . '\' must not be called with an argument');
            }

            if (is_bool($arg) && $specification[$param] != 'bool') {
                throw new \InvalidArgumentException('Parameter \'-' . $param . '\' must not be called without an argument');
            }
        }
    }
}
