$( document ).ready(function() {

    $('#toc-toggle').on('click', toggle_toc);


    var comments_container = $("#comments-container");
    var article_id = comments_container.attr('article-id');
    var comments_list_container = comments_container.find('#comments-list');

    $.ajax({
        url: "/comments/getByParent/0",
        async: true,
        data: "article="+article_id,
        success: function(comments){
            if (comments.length>0) {
                comments_list_container.append('<h3>Комментарии:</h3>');
                comments_list_container.append(comments);
            }

        }
    }).responseText;


    $('#comments-container, #comments-list').on('click','button.post-comment',function (e) {
        e.stopPropagation();
        e.preventDefault();

        var textarea = $(this).parent().find('textarea');
        var comment = textarea.val();
        textarea.val('').blur();
        var parent_id = $(this).closest('.comment').attr('comment-id');
        if (parent_id === undefined) parent_id = 0;

        parent_container = $('[comment-id="' + parent_id + '"] > .comment-children');
        if (parent_container.length === 0)
            parent_container = $('#comments-list');

        $.ajax({
            url: "/comments/add",
            async: false,
            data: {
                _token:$('meta[name="csrf-token"]').attr('content'),
                comment:comment,
                article:article_id,
                parent_id: parent_id
            },
            method: "POST",
            success: function (response) {
                parent_container
                    .append(response);
                $('#comments-list .add-comment-form')
                    .remove();
            }
        })
    });

    $('#comments-list').on('click','.comment-response',function (e) {
        e.preventDefault();

        $('#comments-list .add-comment-form').remove();

        $('#comments-container > .add-comment-form')
            .clone()
            .insertAfter(this)
            .find('textarea')
            .focus();
    });


});

function toggle_toc(e) {
    e.preventDefault();

    if ($(this).hasClass('toc-visible')) {
        $(this).removeClass('toc-visible')
            .addClass('toc-hidden')
            .text('показать');

    } else if ($(this).hasClass('toc-hidden')) {
        $(this).removeClass('toc-hidden')
            .addClass('toc-visible')
            .text('скрыть');
    }

    $('#toc li').toggle();
}