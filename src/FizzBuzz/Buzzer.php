<?php

namespace FizzBuzz;

class Buzzer
{
    public function printIt($number)
    {
        if ($number == 3) {
            return 'fizz';
        }

        if ($number == 5) {
            return 'buzz';
        }

        return $number;
    }
}
