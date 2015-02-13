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
	<div class="block--ends">
	<?
		$a = new GlobalArea('Testimonials');
		$a->display($c);
	?>
	</div>
	</main>
<? $this->inc('elements/footer.php'); ?>
