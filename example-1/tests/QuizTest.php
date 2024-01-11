<?php

namespace Tests;

use App\Question;
use App\Quiz;
use Exception;
use PHPUnit\Framework\TestCase;

class QuizTest extends TestCase
{
    /** @test */
    public function it_consists_of_questions()
    {
        $quiz = new Quiz;

        $quiz->addQuestion(new Question('What is 2 + 2?', 4));

        $this->assertCount(1, $quiz->questions());
    }

    /** @test */
    public function it_grades_a_perfect_quiz()
    {
        $quiz = new Quiz;

        $quiz->addQuestion(new Question('What is 2 + 2?', 4));

        $question = $quiz->nextQuestion();

        $question->answer(4);

        $this->assertEquals(100, $quiz->grade());   
    }

    /** @test */
    public function it_grades_a_failed_quiz()
    {
        $quiz = new Quiz;

        $quiz->addQuestion(new Question('What is 2 + 2?', 4));

        $question = $quiz->nextQuestion();

        $question->answer('incorrect answer');

        $this->assertEquals(0, $quiz->grade());
    }

    /** @test */
    public function it_correctly_tracks_the_next_question_in_the_queue()
    {
        $quiz = new Quiz;

        $quiz->addQuestion(new Question('What is 2 + 2?', 4));
        $quiz->addQuestion(new Question('What is 3 * 2?', 6));
        $quiz->addQuestion(new Question('What is 5 * 2?', 10));

        $question = $quiz->nextQuestion();
        $question->answer(4);

        $question = $quiz->nextQuestion();
        $question->answer(6);

        $question = $quiz->nextQuestion();
        $question->answer(10);

        $this->assertEquals(100, $quiz->grade());
    }

    /** @test */
    public function it_cannot_be_graded_until_all_questions_have_been_answered()
    {
        $this->expectException(Exception::class);
        $this->expectExceptionMessage('Cannot get grade before complete the quiz');
        $quiz = new Quiz;

        $quiz->addQuestion(new Question('What is 2 + 2?', 4));
        $quiz->addQuestion(new Question('What is 3 * 2?', 6));
        $quiz->addQuestion(new Question('What is 5 * 2?', 10));

        $question = $quiz->nextQuestion();
        $question->answer('incorrect answer');

        $question = $quiz->nextQuestion();
        $question->answer(6);

        $quiz->grade();

    }
}