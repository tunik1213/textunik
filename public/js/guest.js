$( document ).ready(function() {
    var login_popup = function (event) {
        event.preventDefault();
        this.blur();
        $.get('/login_form', function(form) {
            $(form).appendTo('body').modal();
        });
    };

   $('body').on('focus','textarea',login_popup);
});

