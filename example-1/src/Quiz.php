<?php

namespace App;

use Exception;

class Quiz
{
    protected $questions = [];

    protected $current_question_key = 0;

    public function addQuestion(Question $question)
    {
        $this->questions[] = $question;
    }

    public function questions()
    {
        return $this->questions;
    }

    public function nextQuestion()
    {
        return $this->questions[$this->current_question_key++];
    }

    public function grade()
    {
        $is_complete = count($this->questions) === $this->current_question_key;

        if(!$is_complete)
        {
            throw new Exception('Cannot get grade before complete the quiz');
        }
        
        $correct = count($this->corerctlyAnsweredQuestions());

        return ($correct / count($this->questions)) * 100;
    }

    protected function corerctlyAnsweredQuestions()
    {
        return array_filter($this->questions, function ($question) {
            return $question->solved();
        });
    }
}
