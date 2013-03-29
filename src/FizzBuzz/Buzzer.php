<?php

namespace FizzBuzz;

class Buzzer
{
    public function printIt($number)
    {
        $output = '';

        if ($number % 3 == 0) {
            $output .= 'fizz';
        }

        if ($number % 5 == 0) {
            $output .= 'buzz';
        }

        if ($output == '') {
            return $number;
        }

        return $output;
    }
}
