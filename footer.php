<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package 50Jones
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer">
		<div class="container">
			<div class="justify-edges">
				<div class="contact-section">
					<h3 class="cap-header">Contact</h3>
					<p class="address"><?php echo get_field('address_line_one'); ?>&nbsp;|&nbsp;<?php echo get_field('address_line_two'); ?></p>
				</div>
				<div class="follow-section">
					<h3 class="cap-header follow-header">Follow</h3>
					<ul class="social-icons">
						<li><a href="<?php echo get_field('facebook_url'); ?>" target="_blank"><i class="fab fa-facebook"></i></a></li>
						<li><a href="<?php echo get_field('twitter_url'); ?>" target="_blank"><i class="fab fa-twitter"></i></a></li>
						<li><a href="<?php echo get_field('instagram_url'); ?>" target="_blank"><i class="fab fa-instagram"></i></a></li>
						<li><a href="<?php echo get_field('pinterest_url'); ?>" target="_blank"><i class="fab fa-pinterest"></i></a></li>
					</ul>
				</div>
			</div>
			<div class="row">
				<p class="disclaimer"><?php echo get_field('disclaimer_text'); ?></p>
			</div>
		</div>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>
<script src="https://kit.fontawesome.com/30405ba8ca.js" crossorigin="anonymous"></script>

</body>
</html>
