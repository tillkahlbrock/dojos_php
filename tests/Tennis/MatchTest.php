<?php

class MatchTest extends PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function it_should_have_no_points_in_a_just_started_match()
    {
        $this->assertEquals('0 : 0', $this->buildMatch()->getScores());
    }

    /**
     * @test
     */
    public function it_should_return_15_to_zero_points_if_first_player_scores_once()
    {
        $match = $this->buildMatch();

        $match->scoreFirstPlayer();

        $this->assertEquals('15 : 0', $match->getScores());
    }

    private function buildMatch()
    {
        return new \Tennis\Match();
    }
}
