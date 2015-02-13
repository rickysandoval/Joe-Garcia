	<footer class="site-footer">
		<div class="container">
			<div class="footer-contact">
			<h2 class="footer-title">Contact</h2>
				<?
					$a = new GlobalArea('Footer Contact Photo');
					$a->display($c);
				?>
				<div class="footer-contact_info">
					<h3>Joe Garcia | Realtor</h3>
					<p>215 Elk Avenue,<br>Crested Butte, CO</p>
					<p>Cell: <a href="tel:9702094034">970-209-4034</a></p>
					<p><a href="mailto:joe@redladyrealty.com">joe@redladyrealty.com</a></p>
				</div>
			</div>

			<div class="footer-testimonials">
			<h2 class="footer-title">Testimonials</h2>
				<div class="testimonial-list">
					<?
						$a = new GlobalArea('Testimonials');
						$a->display($c);
					?>
				</div>
			</div>
		</div>
		<div class="site-credits">
			<div class="container">
			&copy; <?php echo date("Y") ?> Red Lady Realty
			<span>Website by <a href="rickysandoval.me">Ricky Sandoval</a></span>
			</div>
		</div>
	</footer>
</div> <!-- end Site -->
<?=Loader::element("footer_required");?>
<script src="<?php echo $this->getThemePath()?>/assets/js/jquery.mixitup.js"></script>
<script src="<?php echo $this->getThemePath()?>/assets/js/slick.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?sensor=false" type="text/javascript"></script>
<script src="<?php echo $this->getThemePath()?>/assets/js/jquery.simplemaps.js"></script>
<script src="<?php echo $this->getThemePath()?>/assets/js/script.js"></script>
</body>
</html>
