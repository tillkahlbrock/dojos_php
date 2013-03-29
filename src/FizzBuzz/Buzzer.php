<?php

namespace FizzBuzz;

class Buzzer
{
    public function printIt($number)
    {
        if ($number == 3) {
            return 'fizz';
        }
        return $number;
    }
}
