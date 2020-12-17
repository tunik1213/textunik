var right_banner_height;
var right_banner_width;

$(document).ready(function() {

    expand_read_more_button();

    if ($(window).width() > 1000) {
        scroll_up_button();
    }

    $('body').on('mouseenter', '.user-mini-avatar', show_author_popup);
    $('body').on('mouseleave', '.user-mini-avatar', hide_author_popup);

    $('body').on('focus', 'textarea.restrict', login_popup);
    $('body').on('click', 'a.restrict', login_popup);

    $('body').on('keydown', function(e) {
        if (e.keyCode == 13 && e.ctrlKey) {
            reportError();
        }
    });

    accordionTabs();

    show_startup_modal_message();

    $(window).scroll(fix_right_banner);

    right_banner_width = $('.right-banner').width();
    header_height = $('.right-banner').offset().top;

    $('body').on('click','.radio-item',function (e){
        $(this).parent().find('.radio-item input[type=radio]')
            .prop('checked', false);
        $(this).find('input[type=radio]').prop('checked', true);
    })

});


var fix_right_banner = function() {

    right_banner = $('.right-banner');
    right_banner_height = right_banner.height();

    if ($(window).scrollTop()+$(window).height() > right_banner_height + header_height) {
        right_banner.addClass('fixed')
    } else {
        right_banner.removeClass('fixed');
    };

    right_banner.css({'width': right_banner_width });

};

var show_startup_modal_message = function() {
    modal_block = $('#modal-startup-message');
    if (modal_block.length == 0) return;

    modal_block.modal();
}

var accordionTabs = function() {
    $('.accordion-tabs').children('li').first().children('a').addClass('active')
        .next().addClass('open').show();
    $('.accordion-tabs').on('click', 'li > a', function(event) {
        event.preventDefault();
        if ($(this).hasClass('active')) {
            return;
        }

        $('.accordion-tabs .open').removeClass('open').hide();
        $(this).next().toggleClass('open').toggle();
        $('.accordion-tabs').find('.active').removeClass('active');
        $(this).addClass('active');

    });
};

function reportError() {
    var selectedText = document.getSelection().toString();

    $.get('/error_report_form', function(form) {
        var _form = $(form);
        _form
            .appendTo('body')
            .modal()
            .find('textarea')
            .focus();

        _form
            .find('#selected-error-text')
            .text(selectedText);

        _form.on('click', '#send-error-report', function(event) {
            $.ajax({
                method: "POST",
                url: "/sendErrorReport",
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    selection: selectedText,
                    message: _form.find('textarea').val()
                },
                success: function() {
                    $.jGrowl("Спасибо! Ваше сообщение отправлено администрации");
                }
            });
        });
    });
}

function login_popup(event) {

    event.preventDefault();
    event.stopPropagation();
    this.blur();
    $.get('/login_form', function(form) {
        $(form).appendTo('body').modal();
    });
};


function show_author_popup() {
    profile_link = $(this).parent().find('a.author-profile-link');
    authorId = profile_link.attr('author-id');
    preview = getUserPreview(authorId);
    preview
        .appendTo(profile_link)
        .show();

    if ($('#footer').offset().top - preview.offset().top < 500) {
        preview.css('bottom', '35px');
    }
}

function hide_author_popup() {
    authorId = $(this).parent().find('a.author-profile-link').attr('author-id');
    getUserPreview(authorId).hide();
}

function getUserPreview(id) {

    var popup_selector = '.user-preview-popup[userId="' + id + '"]';
    var popup_block = $(popup_selector);
    if (popup_block.length > 0)
        return popup_block;

    $.ajax({
        url: "/profile/getPreview/" + id,
        async: false,
        success: function(html_result) {
            $('body').append('<div class="user-preview-popup" userId="' + id + '"></div>');
            popup_block = $(popup_selector);
            popup_block.append(html_result);
        }
    });

    return popup_block;
}

function expand_read_more_button() {
    $('.expand-read-more').each(function(i, link) {
        collapsable = "#" + $(link).attr('for');
        $(collapsable).hide();
        $(link).on('click', function() {
            $("#" + $(this).attr('for')).toggle(200);
        });
    });
}

function scroll_up_button() {
    var btn = $('#scroll-top-button');
    $(window).scroll(function() {
        if ($(window).scrollTop() > 300) {
            btn.show();
        } else {
            btn.hide();
        }
    });
    btn.on('click', function(e) {
        e.preventDefault();
        $('html, body').animate({ scrollTop: 0 }, '300');
    });
}
