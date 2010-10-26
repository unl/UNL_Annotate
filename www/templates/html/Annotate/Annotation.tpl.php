<div class="editHeader">
Your <?php echo $savvy->render($context->sitekey); ?> annotation for <?php echo $savvy->render($context->fieldname); ?>
</div>
<form class="editRegion" id="<?php echo $savvy->render($context->sitekey); ?>_<?php echo $savvy->render($context->fieldname); ?>">
    <textarea name="note"><?php echo $savvy->render($context->note); ?></textarea>
    <input type="hidden" name="sitekey" value="<?php echo $savvy->render($context->sitekey); ?>" />
    <input type="hidden" name="fieldname" value="<?php echo $savvy->render($context->fieldname); ?>" />
</form>