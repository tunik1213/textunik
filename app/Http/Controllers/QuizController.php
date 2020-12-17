<?php

namespace App\Http\Controllers;

use App\QuizAnswer;
use App\QuizQuestion;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    const S_KEY = 'last_answered_quiz';

    public function get(Request $request) {
        $last_answered_id = $request->session()->get(self::S_KEY, 0);

        $result = QuizQuestion::where('id','>',$last_answered_id)
            ->orderBy('id', 'asc')
            ->limit(1)
            ->get();
        if ($result->count() == 0)
            return '';


        $question = $result[0];

        $answers = $question->answers()->get();

        return view('quiz.question',['question' => $question]);
    }

    public function answer(Request $request) {
        $request->session()->put(self::S_KEY, $request->input('questionId'));

        return $this->get($request);
    }
}
