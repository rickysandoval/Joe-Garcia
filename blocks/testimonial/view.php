<?php  defined('C5_EXECUTE') or die("Access Denied.");
?>

<div class="testimonial block">
<?php  if (!empty($field_1_textarea_text)): ?>
	<blockquote>"<?php  echo nl2br(htmlentities($field_1_textarea_text, ENT_QUOTES, APP_CHARSET)); ?>"</blockquote>
<?php  endif; ?>

<?php  if (!empty($field_2_textbox_text)): ?>
	<h3 class="testimonial-name"><?php  echo htmlentities($field_2_textbox_text, ENT_QUOTES, APP_CHARSET); ?></h3>
<?php  endif; ?>

<?php  if (!empty($field_3_textbox_text)): ?>
	<h3 class="testimonial-from"><?php  echo htmlentities($field_3_textbox_text, ENT_QUOTES, APP_CHARSET); ?></h3>
<?php  endif; ?>
</div>


