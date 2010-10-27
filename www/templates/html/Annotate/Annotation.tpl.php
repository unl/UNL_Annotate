<div class="editHeader">
<a href="<?php echo UNL_Annotate::$url; ?>?view=help" title="What is this?" target="_blank" class="whatisthis">?</a>
<?php if (UNL_Annotate::getUser()) : ?>
<span class="saved">Saved</span>
<?php else : ?>
<span class="savelogin">Login to Edit</span>
<?php endif; ?>
Your <?php echo $savvy->render($context->sitekey); ?> annotation for <?php echo $savvy->render($context->fieldname); ?>
</div>
<form class="editRegion" id="<?php echo $savvy->render($context->sitekey); ?>_<?php echo $savvy->render($context->fieldname); ?>">
    <textarea name="note"><?php echo $savvy->render($context->note); ?></textarea>
    <input type="hidden" name="sitekey" value="<?php echo $savvy->render($context->sitekey); ?>" />
    <input type="hidden" name="fieldname" value="<?php echo $savvy->render($context->fieldname); ?>" />
</form>

<?php if (!UNL_Annotate::getUser()) : ?>
<div id="notLoggedIn">Login to Edit and Save a Personal Notation</div>
<?php endif; ?>