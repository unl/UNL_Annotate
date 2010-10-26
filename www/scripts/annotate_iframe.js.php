<?php 
require_once dirname(dirname(dirname(__FILE__))).'/config.inc.php';
if (false == headers_sent()) {
    header("content-type: application/x-javascript");
}
?>
WDN.jQuery(document).ready(function($){
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

        WDN.post(
            '<?php echo UNL_Annotate::$url; ?>',
            dataString,
            function(data){
                if (data == 'success') {
                    $('.editHeader span.save').html('Saved');
                }
            },
            ''
        );
    });
});