<?php

namespace ArgsReader;

class Parser
{
    private $paramArgMapping = array();

    public function parse($parameterString, array $specification)
    {
        $tokens = $this->tokenize($parameterString);

        if (count($tokens) == 0) {
            return array();
        }

        if ($this->isFirstTokenNotAFlag($tokens)) {
            throw new \InvalidArgumentException('Arguments must start with a flag');
        }

        $flag = null;

        foreach ($tokens as $token) {
            if ($this->isFlag($token)) {
                $flag = $this->parseFlag($token, $specification);
            } else {
                $this->parseValue($flag, $token);
            }
        }
        $this->validateMapping($specification);

        return $this->paramArgMapping;
    }

    private function isFlag($arg)
    {
        return (bool) preg_match('/^-(.)$/', $arg);
    }

    private function tokenize($parameterString)
    {
        if ($parameterString == '') {
            return array();
        }

        return explode(' ', $parameterString);
    }

    private function isFirstTokenNotAFlag($tokens)
    {
        return substr($tokens[0], 0, 1) != '-';
    }

    private function parseFlag($flag, $specification)
    {
        $flag = substr($flag, 1, 1);
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
