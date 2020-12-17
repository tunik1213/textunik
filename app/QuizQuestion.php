<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuizQuestion extends Model
{
    public function answers() {
        return $this->hasMany('App\QuizAnswer', 'QuestionId');
    }
}
