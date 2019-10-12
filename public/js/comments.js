$( document ).ready(function() {

    var comments_container = $("#comments-container");
    var article_id = comments_container.attr('article-id');
    var comments_list_container = comments_container.find('#comments-list');

    $.ajax({
        url: "/comments/getByParent/0",
        async: true,
        data: "article="+article_id,
        success: function(comments){
            comments_list_container.append(comments);
        }
    }).responseText;


    $('#comments-container, #comments-list').on('click','button.post-comment',function (e) {
        var comment = $(this).parent().find('textarea').val();
        var parent_id = 0;
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
                $('[comment-parent="' + parent_id + '"]')
                    .append(response);
            }
        })
    });
});