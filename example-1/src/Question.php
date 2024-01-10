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

        $this->correct = $this->solution === $answer;
    }

    public function solved()
    {
        return $this->correct;
    }
}
