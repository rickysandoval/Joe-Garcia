<?php defined('C5_EXECUTE') or die(_("Access Denied.")); ?>

<?php
/* You can loop through all of the images in the chosen file set with some code like this:
 *
 *   <?php foreach ($images as $img): ?>
 *       ...
 *   <?php endforeach; ?>
 *
 * Inside the loop, the following data is available about each image:
 *   $img->title : Image's "Title" attribute (set via File Manager properties). Note that C5 sets titles to the file name upon initial upload, so you might not want to display this if you don't expect users to edit them)
 *   $img->description : Image's "Description" attribute (set via File Manager properties) -- use this for captions
 *   $img->orig->src : Original (full-size) image src
 *   $img->orig->width : Original (full-size) image width (in pixels)
 *   $img->orig->height : Original (full-size) image height (in pixels)
 *   $img->large->src : Large image src
 *   $img->large->width : Large image width (in pixels)
 *   $img->large->height : Large image height (in pixels)
 *   $img->thumb->src : Thumbnail image src
 *   $img->thumb->width : Thumbnail image width (in pixels)
 *   $img->thumb->height : Thumbnail image height (in pixels)
 *   $img->titleRaw : Unescaped title (html entities are not encoded -- use with caution!)
 *   $img->descriptionRaw : Unescaped title (html entities are not encoded -- use with caution!)
 *   $img->fID : Image's File ID (assigned by Concrete5 when first uploaded)
 *   $img->linkUrl : URL of a page that the image should link to when clicked (NOTE THAT THIS DOES NOT WORK OUT OF THE BOX -- SEE DOCUMENTATION FOR HOW TO SET THIS UP ON YOUR SITE)
 *
 * If you need to set a container width/height or pass in an overall width/height to your plugin, you can use these:
 *   <?php echo $maxOrigWidth ?>
 *   <?php echo $maxOrigHeight ?>
 *   <?php echo $maxLargeWidth ?>
 *   <?php echo $maxLargeHeight ?>
 *   <?php echo $maxThumbWidth ?>
 *   <?php echo $maxThumbHeight ?>
 *
 * As with all C5 block templates, the $bID (Block ID) variable is available. If you're using a jquery plugin,
 * you will want to output this variable as part of an id so that this block's images can be uniquely identified
 * (otherwise there will be problems if the user adds more than one of this block to the same page).
 */
?>
<div class="slick-homepage__container">
<div class="slick-next"></div>
<div class="slick-prev"></div>
<div id="gallery<?php echo $bID ?>" class="slick-homepage">
	<?php foreach ($images as $img): ?>
		<div class="hide">
			<img src="<?php echo $img->large->src ?>" width="<?php echo $img->large->width ?>" height="<?php echo $img->large->height ?>" alt="" />
		</div>
	<?php endforeach; ?>
</div>
<div class="slick-homepage_shadow"></div>
</div>

<script type="text/javascript" async>
$(document).ready(function() {
	//JQUERY PLUGIN EXAMPLE:
	var slick = $('.slick-homepage').slick({
		dots: false,
		infinite: true,
		autoplay: true,
		autoplaySpeed: 5000,
		fade:true,
		cssEase: 'linear',
		arrows: false
	});

	$(window).scroll(function(){
		var scrollTop = Math.min((document.documentElement.scrollTop || document.body.scrollTop), 400);
		$('.slick-homepage .slick-slide').css({ 'margin-top': -scrollTop/6 });
	});

	$('.slick-homepage__container .slick-prev').on('click',function(){
		$('.slick-homepage').slick('slickPrev');
	});
	$('.slick-homepage__container .slick-next').on('click',function(){
		$('.slick-homepage').slick('slickNext');
	});
});
</script>
