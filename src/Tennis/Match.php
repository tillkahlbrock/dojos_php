<?php

namespace Tennis;

class Match
{
    public function __construct()
    {
        $this->scores = array(0,0);
    }

    public function scoreFirstPlayer()
    {
        $this->scores[0] += 1;
    }

    public function getScores()
    {
        $scoreMap = array(
            0 => '0',
            1 => '15'
        );

        return $scoreMap[$this->scores[0]] . ' : ' . $scoreMap[$this->scores[1]];
    }
}
