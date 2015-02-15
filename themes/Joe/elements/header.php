<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta content="width=device-width; initial-scale=1.0" name="viewport">
		<?php 
			$page = Page::getCurrentPage();
			$ih = Loader::helper('image');
			if ($page->getAttribute('page_thumb')){
				$img = $page->getAttribute('page_thumb');
				$thumb = $ih->getThumbnail($img, 9999, 600, false);
				?>
		<meta property="og:image" content="<? echo $thumb->src ?>">
				<?php
			}
		?>
		<link href="<?=$this->getThemePath()?>/assets/css/screen.css" rel="stylesheet" media="all">
		<link href="<?=$this->getThemePath()?>/assets/css/font-awesome/css/font-awesome.min.css" rel="stylesheet" media="all">
		<link href="<?=$this->getThemePath()?>/assets/css/slick.css" rel="stylesheet" media="all">
		<?=Loader::element("header_required");?>
	</head>
	<body class="<?php if(isset($_GET['print'])){ echo 'print'; } ?>">
	<nav class="mobile-nav">
		<?
			$a = new GlobalArea('Mobile Nav');
			$a->display();
		?>
		<div class="hamburger">
			<div>
				<div></div>
				<div></div>
				<div></div>
				<div></div>
			</div>
		</div>
	</nav>
	<div class="site">
		<header class="site-header">
			<div class="site-header_overlay">
				<div class="branding container">
				<div class="header-contact">
					<p>970-209-4034 <i class="fa fa-phone"></i></p>
					<p>joe@redladyrealty.com <i class="fa fa-envelope"></i></p>
				</div>
					<div class="branding-corporate">			
						<?
							$a = new GlobalArea('Corporate Logo');
							$a->display();
						?>
					</div>
					<div class="branding-personal">
						<a href="/">
						<?
							$a = new GlobalArea('Personal Logo');
							$a->display();
						?>
						</a>
					</div>
					</div>
				<nav>
					<div class="site-nav container">
					<?
						$a = new GlobalArea('Header Nav');
						$a->display();
					?>
					</div>
				</nav>
			</div>
		</header>