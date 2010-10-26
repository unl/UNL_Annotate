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
        if (before != $(this).html()) {
            $(this).trigger('change');
        }
    });

    $('.editRegion textarea').live('change', function() {
        var dataString = $(this).parent().serialize();

        WDN.post(
            '<?php echo UNL_Annotate::$url; ?>',
            dataString,
            function(data){
                alert(1);
            },
            ''
        );
    });
});