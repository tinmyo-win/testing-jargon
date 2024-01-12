<?php

namespace App;

use Exception;

class Quiz
{
    protected Questions $questions;

    public function __construct()
    {
        $this->questions = new Questions();
    }

    protected $current_question_key = 0;

    public function addQuestion(Question $question)
    {
        $this->questions->add($question);
    }

    public function questions()
    {
        return $this->questions;
    }

    public function nextQuestion()
    {
        return $this->questions->next();
        // if(!isset($this->questions[$this->current_question_key])) {
        //     return false;
        // }
        
        // return $this->questions[$this->current_question_key++];
    }

    public function isComplete()
    {
        $answeredQuestions = count($this->questions->answered());
        $totalQuestions = $this->questions->count();

        return $totalQuestions === $answeredQuestions;
    }

    public function grade()
    {
        if (!$this->isComplete()) {
            throw new Exception('Cannot get grade before complete the quiz');
        }

        $correct = count($this->questions->solved());

        return ($correct / $this->questions->count()) * 100;
    }
}
