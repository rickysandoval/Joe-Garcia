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
		<div class="listing-gallery block--ends">
		<?
			$a = new Area('Listing Gallery');
			$a->display($c);
		?>
		</div>
		<div class="listing-stats block--ends">
			<table>
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
				data-address="<? echo $page->getAttribute('list_address')?> Colorado" 
				data-icon="<?php echo $this->getThemePath()?>/assets/images/marker.png" >
				<div class="map-infowindow">
					<p><? echo $page->getAttribute('list_address') ?></p>
				</div>
			</div>
		</div>

		<div class="notice">
			<p>Buyer should verify accuracy of data as it is not guaranteed. 
			The information contained in this publication is for consumers' personal 
			non-commercial use and may not be used for any purpose other than to identify 
			prospective properties consumers may be interested in puchasing. 
			Listing courtesy of Joe Garcia from Red Lady Realty.</p>
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