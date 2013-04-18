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

    /**
     * @test
     */
    public function it_should_return_15_to_15_points_if_both_players_score_once()
    {
        $match = $this->buildMatch();

        $match->scoreFirstPlayer();
        $match->scoreSecondPlayer();

        $this->assertEquals('15 : 15', $match->getScores());
    }

    /**
     * @test
     */
    public function it_should_return_30_points_for_first_player_if_he_scores_twice()
    {
        $match = $this->buildMatch();

        $match->scoreFirstPlayer();
        $match->scoreFirstPlayer();

        $this->assertEquals('30 : 0', $match->getScores());
    }

    /**
     * @test
     */
    public function it_should_return_40_points_for_first_player_if_he_scores_three_times()
    {
        $match = $this->buildMatch();

        $match->scoreFirstPlayer();
        $match->scoreFirstPlayer();
        $match->scoreFirstPlayer();

        $this->assertEquals('40 : 0', $match->getScores());
    }

    /**
     * @test
     */
    public function it_should_return_deuce_if_both_players_score_three_times()
    {
        $match = $this->buildMatch();

        $match->scoreFirstPlayer();
        $match->scoreFirstPlayer();
        $match->scoreFirstPlayer();

        $match->scoreSecondPlayer();
        $match->scoreSecondPlayer();
        $match->scoreSecondPlayer();

        $this->assertEquals('deuce', $match->getScores());
    }

    /**
     * @test
     */
    public function it_should_return_advantage_player1_if_player1_scores_once_after_deuce()
    {
        $match = $this->buildMatch();

        $match->scoreFirstPlayer();
        $match->scoreFirstPlayer();
        $match->scoreFirstPlayer();

        $match->scoreSecondPlayer();
        $match->scoreSecondPlayer();
        $match->scoreSecondPlayer();

        $match->scoreFirstPlayer();

        $this->assertEquals('advantage player1', $match->getScores());
    }

    /**
     * @test
     */
    public function it_should_return_advantage_player2_if_player2_scores_once_after_deuce()
    {
        $match = $this->buildMatch();

        $match->scoreFirstPlayer();
        $match->scoreFirstPlayer();
        $match->scoreFirstPlayer();

        $match->scoreSecondPlayer();
        $match->scoreSecondPlayer();
        $match->scoreSecondPlayer();

        $match->scoreSecondPlayer();

        $this->assertEquals('advantage player2', $match->getScores());
    }

    /**
     * @test
     */
    public function it_should_return_deuce_if_player1_scores_once_after_player2_had_advantage()
    {
        $match = $this->buildMatch();

        $match->scoreFirstPlayer();
        $match->scoreFirstPlayer();
        $match->scoreFirstPlayer();

        $match->scoreSecondPlayer();
        $match->scoreSecondPlayer();
        $match->scoreSecondPlayer();

        $match->scoreSecondPlayer();

        $match->scoreFirstPlayer();

        $this->assertEquals('deuce', $match->getScores());
    }

    /**
     * @test
     */
    public function it_should_return_player2_wins_if_player2_scores_once_after_he_had_advantage()
    {
        $match = $this->buildMatch();

        $match->scoreFirstPlayer();
        $match->scoreFirstPlayer();
        $match->scoreFirstPlayer();

        $match->scoreSecondPlayer();
        $match->scoreSecondPlayer();
        $match->scoreSecondPlayer();

        $match->scoreSecondPlayer();

        $match->scoreSecondPlayer();

        $this->assertEquals('player2 wins', $match->getScores());
    }

    private function buildMatch()
    {
        return new \Tennis\Match();
    }
}
