<?php  defined('C5_EXECUTE') or die(_("Access Denied."));
$teaserBlockCount = ($controller->truncateSummaries ? 1 : null);
$teaserTruncateChars = ($controller->truncateSummaries ? $controller->truncateChars : 0);
$plth = Loader::helper('page_list_teasers', 'page_list_teasers');
$rssUrl = $plth->getRssUrl($b);
$th = Loader::helper('text');
$ih = Loader::helper('image');
$current = Page::getCurrentPage();
//Note that $nh (navigation helper) is already loaded for us by the controller (for legacy reasons)
?>

<?php 
$categories = [];
foreach ($pages as $page) {
	if ($page->getAttribute('property_type')){
		$categories[(string)$page->getAttribute('property_type')] = (string)$page->getAttribute('property_type');
	}
}
?>
<!-- Check if passed a starting filter to url -->
<? if (isset($_GET['city'])){ ?>
	<div id="list-filter-start" class="is-visually-hidden" data-start=".<? echo $_GET['city']; ?>">
	</div>
<? } ?>

<? if (sizeof($categories) > 0){ ?>
<div class="list-filters">
	<div class="filter-label">Filter By</div>
	<button class="filter" data-filter="all">All</button>
	<?php foreach($categories as $cat){ ?>
	<button class="filter" data-filter=".<?echo str_replace(' ', '-', $cat)?>"><? echo $cat ?></button>
	<?php } ?>
</div>
<? } ?>

<div class="listing-list gw sm-two-up md-three-up mix-container">

	<?php foreach ($pages as $page):
		$title = $th->entities($page->getCollectionName());
		$url = $nh->getLinkToCollection($page);
		$target = ($page->getCollectionPointerExternalLink() != '' && $page->openCollectionPointerExternalLinkInNewWindow()) ? '_blank' : $page->getAttribute('nav_target');
		$target = empty($target) ? '_self' : $target;
		$description = $page->getCollectionDescription();
		$description = $th->entities($description);
		?>
		<a class="listing-list_link g mix <? echo str_replace(' ', '-', $page->getAttribute('property_type'))?>" href="<?php echo $url; ?>">
		<div class="listing-list_item">
			<?php
				$img = $page->getAttribute('page_thumb');
				$thumb = $ih->getThumbnail($img, 9999, 600, false);
			?>	<div class="listing-thumb_container <?php echo $portrait; ?>">
					<img class="listing-thumb" src="<?php echo $thumb->src; ?>" width="<?php  echo $thumb->width ?>" height="<?php  echo $thumb->height ?>" alt="<?php  echo $title; ?>" />
					<p class="listing-price"><? setlocale(LC_MONETARY, 'en_US'); echo money_format('%(#15.0n', $page->getAttribute('list_price')); ?></p>
				</div>
				<h3 class="listing-name"><?echo $title?></h3>
				<div class="listing-info_top">
					<h4><?echo $page->getAttribute('list_city')?><span><?echo $page->getAttribute('property_type')?></span></h4>
				</div>
				<div class="listing-info_bottom">
					<? if(strcmp($page->getAttribute('property_type'), 'Land') == 0){ ?>
						<table>
						<tr><th>Acres</th><th>Type</th></tr>
						<tr>
							<td><?echo $page->getAttribute('acres'); ?></td>
							<td><?echo $page->getAttribute('list_hometype'); ?></td>
						</tr>
						</table>
					<? } else { ?>
						<table>
						<tr><th>Area</th><th>Beds</th><th>Baths</th></tr>
						<tr>
							<td><?echo $page->getAttribute('square_feet'); ?> ft<span class="superscript">2</span></td>
							<td><?echo $page->getAttribute('bedrooms'); ?></td>
							<td><?echo $page->getAttribute('full_baths'); ?></td>
						</tr>
						</table>
					<? } ?>
				</div>
		</div></a>
	<?php endforeach; ?>
</div><!-- end .listing-list -->
