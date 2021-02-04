
<span class="question-title">{{$question->text}}</span>
<ul class="quiz-answers" quiz-id="{{$question->id}}">
@foreach($question->answers()->get() as $answer)
    <li class="{{($answer->isCorrect ? 'correct' : '')}} radio-item">
        <input type="radio"/>
        <label>{{$answer->text}}</label>
    </li>
@endforeach
</ul>
<div class="quiz-result-message"></div>
<button class="btn quiz-answer-button">Ответить</button>
&nbsp;<a href="#" class="next-question-link btn btn-primary">Следующий вопрос</a>
