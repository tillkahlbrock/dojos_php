<?php

namespace ArgsReader;

class Parser
{
    private $paramArgMapping = array();

    public function parse($argumentString)
    {
        $tokens = $this->tokenize($argumentString);

        if (count($tokens) == 0) {
            return array();
        }

        if ($this->isFirstTokenNotAFlag($tokens)) {
            throw new \InvalidArgumentException('Arguments must start with a flag');
        }

        $flagWithoutDash = null;

        foreach ($tokens as $token) {
            if ($this->isFlag($token)) {
                $flagWithoutDash = substr($token, 1, 1);
                $this->paramArgMapping[$flagWithoutDash] = true;
            } else {
                $value = $this->parseValue($flagWithoutDash, $token);
                $this->paramArgMapping[$flagWithoutDash] = $value;
            }
        }

        return $this->paramArgMapping;
    }

    private function isFlag($arg)
    {
        return (bool) preg_match('/^-(.)$/', $arg);
    }

    private function tokenize($argumentString)
    {
        if ($argumentString == '') {
            return array();
        }

        return explode(' ', $argumentString);
    }

    private function isFirstTokenNotAFlag($tokens)
    {
        return substr($tokens[0], 0, 1) != '-';
    }

    private function parseValue($flag, $value)
    {
        if (!is_bool($this->paramArgMapping[$flag])) {
            throw new \InvalidArgumentException('Only one argument per parameter allowed');
        }

        return $value;
    }
}
