$( document ).ready(function() {

    $('.expand-read-more').each(function (i,link) {
        collapsable = "#"+$(link).attr('for');
        $(collapsable).hide();
        $(link).on('click',function () {
            $("#"+$(this).attr('for')).toggle(200);
        });

    });
});