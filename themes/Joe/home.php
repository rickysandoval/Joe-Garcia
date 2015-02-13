<? $this->inc('elements/header.php'); ?>
	<div class="container no-padding homeslider">
	<?php
		$a = new Area('Homepage Slider');
		$a->display($c);
	?>
	</div>
	<main class="site-main container">
		<section class="site-intro">
			<header class="section-header">
				<h1 class="section-header_title">Joe Garcia</h1>
				<hr class="section-header_line">
			</header>
			<?php
				$a = new Area('Intro Picture');
				$a->display($c);

				$a = new Area('Site Intro');
				$a->display($c);
			?>
		</section>
		<section>
			<header class="section-header">
				<h1 class="section-header_title">Featured Listings</h1>
				<hr class="section-header_line">
			</header>
		<?php
			$a = new Area('Main Area');
			$a->display($c);
		?>
		</section>
	</main>
<? $this->inc('elements/footer.php'); ?>