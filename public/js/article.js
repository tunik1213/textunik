$( document ).ready(function() {

    $('#toc-toggle').on('click', toggle_toc);

    $('#comments-container, #comments-list').on('click','button.post-comment',commentPost);

    $('#comments-list').on('click','.comment-response',commentRespond);

    $(document).on('click', '.edit-comment-link', editComment);

});

let commentPost = function (e) {
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
            article:$("#comments-container").attr('article-id'),
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
}

let commentRespond = function (e) {
    e.preventDefault();

    $('#comments-list .add-comment-form').remove();

    $('#comments-container > .add-comment-form')
        .clone()
        .insertAfter(this)
        .find('textarea')
        .focus();
}

let editComment = function(e) {
    e.preventDefault();

    let comment = $(this).closest('.comment');
    let commentId = comment.attr('comment-id');
    let commentVal = comment.find('.comment-content > span').text();

    $('#comments-list .add-comment-form').remove();

    let commentForm = $('#comments-container > .add-comment-form').clone();
    commentForm
        .insertAfter(comment)
        .find('textarea')
        .val(commentVal)
        .focus()

    commentForm
        .find('label.comment-placeholder')
        .text('Редактировать комментарий');

    commentForm
        .find('button.post-comment')
        .attr('commentId',commentId)
        .on('click',function (e) {
            e.stopImmediatePropagation();
            let commentId = $(this).attr('commentId');
            let commentText = $(this)
                .closest('.add-comment-form')
                .find('textarea')
                .val();

            $.ajax({
                url: "/comments/edit/"+commentId,
                async: false,
                data: {
                    _token:$('meta[name="csrf-token"]').attr('content'),
                    comment:commentText,
                },
                method: "POST",
                success: function (response) {
                    $('.comment[comment-id='+commentId+']')
                        .find('.comment-content > span')
                        .text(commentText);
                    $('#comments-list .add-comment-form')
                        .remove();
                }
            })
        })
}

let toggle_toc = function(e) {
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
