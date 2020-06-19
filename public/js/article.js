$( document ).ready(function() {

    $('#toc-toggle').on('click', toggle_toc);

    $('#comments-container, #comments-list').on('click','button.post-comment',commentPost);

    $('#comments-list').on('click','.comment-response',commentRespond);

    $(document).on('click', '.edit-comment-link', editComment);

    create_comment_input('#comments-container-input','');

});


var create_comment_input = function(selector,value)
{
    commentInput = $('#comment-input-sample > .add-comment-form').clone()
    var target = $(selector);
    var childrenSelector = (selector+' > .comment-children');
    if ($(childrenSelector).length > 0)
        commentInput.insertBefore(childrenSelector);
    else
        commentInput.appendTo(selector);

    tinymce.init({
        selector: selector + ' > .add-comment-form > textarea',
        language: 'ru',
        language_url: '/js/lib/lang/tinymce-ru.js',
        plugins: "link, emoticons, lists, charmap, paste",
        paste_as_text: true,
        toolbar: 'bold italic | alignleft aligncenter alignright alignjustify | bullist numlist | indent outdent | charmap emoticons link',
        menubar: false,
        contextmenu: false,
        browser_spellcheck: true,
        relative_urls: false,
        setup: function (editor) {
            editor.on('init', function (e) {
                editor.setContent(value);
            });
        }
    });

    return commentInput;
}

var commentPost = function (e) {

    e.stopPropagation();
    e.preventDefault();

    tinymce.triggerSave();
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
            tinymce.editors[0].setContent('');
            scrollTop = (parent_container.is('#comments-list')) ? $(document).height() : parent_container.last('.comment').offset().top;
            $([document.documentElement, document.body]).animate({
                scrollTop: scrollTop
            }, 300);
        }
    })
}

var commentRespond = function (e) {
    e.preventDefault();

    $('#comments-list .add-comment-form').remove();

    create_comment_input('#'+this.closest('.comment').id);

}

var editComment = function(e) {
    e.preventDefault();

    var comment = $(this).closest('.comment');
    var commentId = comment.attr('id');
    var commentVal = $('#'+commentId + ' > .comment-content > span').html();

    $('#comments-list .add-comment-form').remove();

    var commentForm = create_comment_input('#'+commentId,commentVal);

    commentForm
        .find('button.post-comment')
        .attr('commentId',commentId)
        .on('click',function (e) {
            e.stopImmediatePropagation();
            tinymce.triggerSave();

            var commentId = $(this).closest('.comment').attr('comment-id');
            var commentText = $(this)
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
                    $('.comment[comment-id='+commentId+'] > .comment-content > span')
                        .html(commentText);
                    $('#comments-list .add-comment-form')
                        .remove();
                }
            })
        })
}

var toggle_toc = function(e) {
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
