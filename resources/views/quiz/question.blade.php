
<span class="question-title">{{$question->text}}</span>
<ul id="quiz-answers" quiz-id="{{$question->id}}">
@foreach($question->answers()->get() as $answer)
    <li class="{{($answer->isCorrect ? 'correct' : '')}} radio-item">
        <input type="radio"/>
        <label>{{$answer->text}}</label>
    </li>
@endforeach
</ul>
<div id="quiz-result-message"></div>
<button class="btn" id="quiz-answer-button">Ответить</button>
&nbsp;<a id="next-question-link" href="#" class="btn btn-primary">Следующий вопрос</a>
