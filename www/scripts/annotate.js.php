<?php 
require_once dirname(dirname(dirname(__FILE__))).'/config.inc.php';
if (false == headers_sent()) {
    header("content-type: application/x-javascript");
}
?>

WDN.jQuery(document).ready(function($){
	//initial call to load the rest of the JS
	if ($('.wdn_annotate')) {
		WDN.loadCSS('<?php echo UNL_Annotate::$url; ?>/css/annotate.css');
		WDN.loadJS('<?php echo UNL_Annotate::$url; ?>scripts/annotate_functions.js', function(){
			annotate.path = '<?php echo UNL_Annotate::$url; ?>';
			annotate.initialize();
		});
	}
});