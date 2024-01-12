<?php

namespace App;

class Question
{
    protected $body;
    protected $solution;
    protected $correct;
    protected $answer;

    public function __construct($body, $solution)
    {
        $this->body = $body;
        $this->solution = $solution;
    }
    public function answer($answer) {
        $this->answer = $answer;

        return $this->solved();
    }

    public function answered()
    {
        return isset($this->answer);
    }

    public function solved()
    {
        return $this->answer === $this->solution;
    }
}
