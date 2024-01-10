<?php

namespace App;

class Quiz
{
    protected $questions = [];

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
        return $this->questions[0];
    }

    public function grade()
    {
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
