<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<script type="text/javascript" src="http://code.jquery.com/jquery-1.4.3.min.js"></script>
<script type="text/javascript" src="<?php echo UNL_Annotate::getURL(); ?>scripts/annotate_iframe.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo UNL_Annotate::getURL(); ?>css/annotate_iframe.css" />
<script type="text/javascript">
var ANNOTATE_URL = '<?php echo UNL_Annotate::getURL(); ?>';
function snugFit()
{
    //Adjust for scrollbars, overflow, padding ugliness
    var height = $('.editRegion textarea').height();
    var width = $('.editRegion textarea').width();
    $('.editRegion textarea').height(height-30);
    $('.editRegion textarea').width(width-10);
}
setTimeout('snugFit()',500);
</script>
</head>
<body>
<?php echo $savvy->render($context->actionable); ?>
</body>
</html>