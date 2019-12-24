$( document ).ready(function() {

    expand_read_more_button();

    if($(window).width() > 1000){
        scroll_up_button();
    }

});

function expand_read_more_button(){
    $('.expand-read-more').each(function (i,link) {
        collapsable = "#"+$(link).attr('for');
        $(collapsable).hide();
        $(link).on('click',function () {
            $("#"+$(this).attr('for')).toggle(200);
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
        $('html, body').animate({scrollTop:0}, '300');
    });
}