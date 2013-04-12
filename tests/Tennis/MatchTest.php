<?php

class MatchTest extends PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function it_should_have_no_points_in_a_just_started_match()
    {
        $match = new \Tennis\Match();

        $this->assertEquals('0 : 0', $match->getScores());
    }
}
