<?php  defined('C5_EXECUTE') or die("Access Denied.");
?>
<div class="fam">
<?php  if (!empty($field_1_textbox_text)): ?>
	<h3 class="fam-name"><?php  echo htmlentities($field_1_textbox_text, ENT_QUOTES, APP_CHARSET); ?></h3>
<?php  endif; ?>

<?php  if (!empty($field_2_image)): ?>
	<img src="<?php  echo $field_2_image->src; ?>" width="<?php  echo $field_2_image->width; ?>" height="<?php  echo $field_2_image->height; ?>" alt="" />
<?php  endif; ?>

<?php  if (!empty($field_3_textarea_text)): ?>
	<p class="fam-about"><?php  echo nl2br(htmlentities($field_3_textarea_text, ENT_QUOTES, APP_CHARSET)); ?></p>
<?php  endif; ?>
</div>

