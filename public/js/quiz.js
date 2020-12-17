var getQuestion = function(e) {
    if (e != undefined) e.preventDefault();

    $.ajax({
        url: "/quiz/get",
        async: true,
        success: function (resopnse) {
            if (resopnse == '')
                $('#quiz-container').closest('.right-banner-content').remove()
            else
                $('#quiz-container').html(resopnse);
        }
    });
}


$( document ).ready(function() {

    getQuestion();

    $('#quiz-banner').on('click', '#next-question-link', getQuestion);

    $('#quiz-banner').on('click', 'ul#quiz-answers > li', function (e){
        $('#quiz-answer-button').addClass('btn-primary');
    });

    $('#quiz-banner').on('click', '#quiz-answer-button', function (e){
        var id = $('#quiz-answers').attr('quiz-id');
        $.ajax({
            url: "/quiz/answer/",
            async: true,
            method: 'POST',
            data: {_token: $('meta[name="csrf-token"]').attr('content'),questionId: id},
            success: function(nextQuestion) {
                if (nextQuestion != '') {
                    $('#next-question-link').show();
                }
            }
        })

        $('#quiz-banner input:checked').closest('li').css('background-color','#ff000029');
        $('#quiz-banner li.correct').css('background-color','#0080002b');
        correctAnswer = $('#quiz-banner li.correct input').is(':checked');
        $('#quiz-result-message').text((correctAnswer) ? 'Правильно!' : 'Неправильно!').show();

        $(this).remove();
    });

});


