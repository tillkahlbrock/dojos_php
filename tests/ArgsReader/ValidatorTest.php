<?php

class ValidatorTest extends PHPUnit_Framework_TestCase
{
    private $specification;

    /**
     * @test
     */
    public function it_should_return_true_if_the_mapping_is_empty()
    {
        $this->asserttrue($this->buildValidator()->validate(array()));
    }

    /**
     * @test
     */
    public function it_should_return_false_if_the_mapping_has_an_unspecified_flag()
    {
        $this->specification = array();
        $this->assertFalse($this->buildValidator()->validate(array('f' => true)));
    }

    /**
     * @test
     */
    public function it_should_return_false_if_a_value_of_type_string_is_expected_but_bool_given()
    {
        $this->specification = array('f' => 'string');

        $this->assertFalse($this->buildValidator()->validate(array('f' => true)));
    }

    /**
     * @test
     */
    public function it_should_return_false_if_a_value_of_type_bool_is_expected_but_string_given()
    {
        $this->specification = array('f' => 'bool');

        $this->assertFalse($this->buildValidator()->validate(array('f' => 'some_arg')));
    }

    private function buildValidator()
    {
        return new \ArgsReader\Validator($this->specification);
    }
}
