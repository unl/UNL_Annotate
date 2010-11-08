$(document).ready(function(){
    $('.editRegion textarea').live('focus', function() {
        before = $(this).html();
    }).live('keyup paste', function() {
        $('.editHeader span.saved').removeClass('saved').addClass('save').html('Save Now');

        if (before != $(this).html()) {
            $(this).trigger('change');
        }
    });

    $('.editHeader span.save').click(function(){
        $('.editRegion textarea').trigger('change');
    });

    $('.editRegion textarea').live('change', function() {
        $('.editHeader span.save').removeClass('save').addClass('saved').html('Saving');

        var dataString = $(this).parent().serialize();

        $.post(
            ANNOTATE_URL + '?view=annotation',
            dataString,
            function(data){
                if (data == 'success') {
                    $('.editHeader span.saved').html('Saved');
                } else if (data == 'loginfail') {
                    $('.editHeader span.saved').removeClass('saved').addClass('savelogin').html('Login to Save');
                    $('.editHeader span.savelogin').click(function(){
                        window.open(ANNOTATE_URL + '?view=popuplogin','UNL_Login','height=700,width=1100,scrollbars=yes');
                        return false;
                    });
                } else {
                	$('.editHeader span.saved').html('Error Occurred').removeClass('saved').addClass('save');
                }
            }
        );
    });

    $('#notLoggedIn').click(function(){
        window.open(ANNOTATE_URL + '?view=popuplogin','UNL_Login','height=700,width=1100,scrollbars=yes');
        return false;
    });

    $('#notLoggedIn').hover(
        function(){
            $(this).css('text-decoration','underline');
        },
        function(){
            $(this).css('text-decoration','none');
        }
    );
});