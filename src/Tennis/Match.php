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

    public function scoreSecondPlayer()
    {
        $this->scores[1] += 1;
    }

    public function getScores()
    {
        $scoreMap = array(
            0 => '0',
            1 => '15',
            2 => '30',
            3 => '40'
        );

        if ($this->scores[0] < 3 || $this->scores[1] < 3) {
            return $scoreMap[$this->scores[0]] . ' : ' . $scoreMap[$this->scores[1]];
        }

        if ($this->scores[0] == $this->scores[1]) {
            return 'deuce';
        }

        if ($this->scores[0] == ($this->scores[1] + 1)) {
            return 'advantage player1';
        }

        if ($this->scores[0] == ($this->scores[1] + 2)) {
            return 'player1 wins';
        }

        if ($this->scores[0] == ($this->scores[1] - 2)) {
            return 'player2 wins';
        }

        if ($this->scores[0] == ($this->scores[1] - 1)) {
            return 'advantage player2';
        }
    }
}
