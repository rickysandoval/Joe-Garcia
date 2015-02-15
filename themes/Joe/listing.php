<?php 
	$attr_set = AttributeSet::getByHandle('listings_display');
	$attr_keys = $attr_set->getAttributeKeys(); 
?>

<? $this->inc('elements/header.php'); ?>
	<div class="page-title">
		<div class="container">
			<h1>
				<?
					$page = Page::getCurrentPage();
					echo $page->getCollectionName();
				?>
			</h1>
		</div>
	</div>
	<main class="site-main">
<!-- if not print version -->
<?php if(!isset($_GET['print'])){ ?>	
	<?php if($page->getAttribute('is_sold')){
		?><div class="listing-sold_notice section-header">
			<h1 class="section-header_title">This property is sold.</h1>
			<hr class="section-header_line">
		</div>
	<?php } ?>
		<div class="listing-gallery block--ends">
		<?
			$a = new Area('Listing Gallery');
			$a->display($c);
		?>
		</div>
		<div class="listing-stats block--ends">
			<table>
			<tr><h1 class="listing-stats_title">Property Stats</h1></tr>
			<?php

				$i = 1;
				foreach($attr_keys as $ak) { 
					if ($c->getAttribute($ak->akHandle)){
					?>
						<tr><td><? echo $ak->akName;?></td>
						<td><?
						if($i == 1){
							setlocale(LC_MONETARY, 'en_US'); echo money_format('%(#15.0n', $c->getAttribute($ak->akHandle));
							$i++;
						} else {
							if(strcmp($ak->akHandle, 'property_type') == 0){
								echo '<a href="..?city=' . urlencode($c->getAttribute($ak->akHandle)) . '" >' . $c->getAttribute($ak->akHandle) . '</a>';
							} else {
								echo $c->getAttribute($ak->akHandle); 
							}
						}
						?></td></tr>
			<?php 	}
				} 
			?>
			</table>
		</div>
		<div class="listing-verbage block clear">
			<?
				$a = new Area('Listing Verbage');
				$a->display($c);
			?>
		</div>

		<?php if ($page->getAttribute('list_address')){ ?>
		<div id="gmap" class="listing-map block simplegmap">
			<div class="map-marker" 
				data-title="<? echo $page->getCollectionName() ?>" 
				data-address="<? echo $page->getAttribute('list_address')?>" 
				data-icon="<?php echo $this->getThemePath()?>/assets/images/marker.png" >
				<div class="map-infowindow">
					<p><? echo $page->getAttribute('list_address') ?></p>
				</div>
			</div>
		</div>
		<?php $currentPage = Page::getCurrentPage();
			Loader::helper('navigation');
			$url = NavigationHelper::getLinkToCollection($page, true);
		?>
		<div class="listing-share">
			<a href="?print=true" target="_blank">Print Version</a>
			<a href="mailto:?subject=Red%20Lady%20Realty%20|%20<?php echo $page->getCollectionName(); ?>&body=MLS Number:%20<?php echo $page->getAttribute('mls'); ?>%0d%0a%0d%0a<?php echo $url?>">Email</a>
		</div>

		<div class="listing-notice">
			<p>Buyer should verify accuracy of data as it is not guaranteed. 
			The information contained in this publication is for consumers' personal 
			non-commercial use and may not be used for any purpose other than to identify 
			prospective properties consumers may be interested in puchasing. 
			Listing courtesy of Joe Garcia from Red Lady Realty.</p>
		</div> 
		<?php } ?>

<!-- If print version -->
<?php } else { ?>
		<p><?php echo $page->getAttribute('list_address'); ?></p>
		<p>For more info call Joe at 970-209-4034 or email at joe@redladyrealty.com</p>
		<div class="listing-photo">
			<?php if($page->getAttribute('page_thumb')){ ?>
			<?php 
				$ih = Loader::helper('image');
				$img = $page->getAttribute('page_thumb');
				$thumb = $ih->getThumbnail($img, 999, 999, false);
			?>
			<img src="<?php echo $thumb->src ?>">
			<?php } ?>
		</div>
		<div class="listing-stats block--ends">
			<table>
			<tr><h1 class="listing-stats_title">Property Stats</h1></tr>
			<?php

				$i = 1;
				foreach($attr_keys as $ak) { 
					if ($c->getAttribute($ak->akHandle)){
					?>
						<tr><td><? echo $ak->akName;?></td>
						<td><?
						if($i == 1){
							setlocale(LC_MONETARY, 'en_US'); echo money_format('%(#15.0n', $c->getAttribute($ak->akHandle));
							$i++;
						} else {
							echo $c->getAttribute($ak->akHandle); 
						}
						?></td></tr>
			<?php 	}
				} 
			?>
			</table>
		</div>
		<div class="listing-verbage">
			<?
				$a = new Area('Listing Verbage');
				$a->display($c);
			?>
		</div>
		<div class="listing-map simplegmap">
			<img src="https://maps.googleapis.com/maps/api/staticmap?size=525x300&zoom=16&markers=size:mid%7Ccolor:red%7C<? echo urlencode($page->getAttribute('list_address')) ?>">
		</div>

<?php } ?>
		<script>
			$(document).ready(function(){
				$('#gmap').simplegmaps({
					MapOptions: {
						scrollwheel: false,
						zoomControl: true,
						zoomControlOptions: {
							style: 'DEFAULT'
						}
					}
				});
			});
		</script>
	</main>
<? $this->inc('elements/footer.php'); ?>