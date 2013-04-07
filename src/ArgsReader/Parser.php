<?php

namespace ArgsReader;

class Parser
{
    private $paramArgMapping = array();

    public function parse($parameterString, array $specification)
    {
        $args = $this->tokenize($parameterString);

        $lastFlag = null;

        foreach ($args as $arg) {
            if (preg_match('/^-(.)$/', $arg, $matches)) {
                $lastFlag = $this->parseFlag($matches, $specification);
            } else {
                $this->parseValue($lastFlag, $arg);
            }
        }
        $this->validateMapping($specification);

        return $this->paramArgMapping;
    }

    private function tokenize($parameterString)
    {
        if ($parameterString == '') {
            return array();
        }

        if (substr($parameterString, 0, 1) != '-') {
            throw new \InvalidArgumentException('At least one parameter must be given');
        }

        return explode(' ', $parameterString);
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

    private function parseValue($flag, $value)
    {
        if (!is_bool($this->paramArgMapping[$flag])) {
            throw new \InvalidArgumentException('Only one argument per parameter allowed');
        }
        $this->paramArgMapping[$flag] = $value;
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
