<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<script type="text/javascript" src="/wdn/templates_3.0/scripts/jquery.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo UNL_Annotate::getURL(); ?>css/annotate_iframe.css" />
<script type="text/javascript">
jQuery(document).ready(function($){
	//Adjust for scrollbars, overflow, padding uglyness
	var height = $('#editRegion').height();
	var width = $('#editRegion').width();
	$('#editRegion').height(height-20);
	$('#editRegion').width(width-5);
});

</script>
</head>
<body>
<?php echo $savvy->render($context->actionable); ?>
</body>
</html>