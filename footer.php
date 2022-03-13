<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Coalition_Technologies
 */

$logo = get_field('footer-logo', 'option');
?>

</div><!-- #content -->
	<footer id="footer">
		<div class="container">
			<!-- LOGO -->
			<?php
				if($logo):
			?>
					<div class="logo-wrap">
						<a href="<?php echo get_site_url(); ?>" class="logo">
							<?php echo wp_get_attachment_image($logo);?>	
						</a>
					</div>
			<?php endif; ?>
			<!-- LOGO END -->

			<div class="navigation-wrap">
				<?php
					if(is_active_sidebar('footer-1')){
						dynamic_sidebar( 'footer-1' );
					}
					if(is_active_sidebar('footer-2')){
						dynamic_sidebar( 'footer-2' );
					}
					if(is_active_sidebar('footer-3')){
						dynamic_sidebar( 'footer-3' );
					}
					if(is_active_sidebar('footer-4')){
						dynamic_sidebar( 'footer-4' );
					}
					if(is_active_sidebar('footer-5')){
						dynamic_sidebar( 'footer-5' );
					}
				?>
			</div>

			<div class="bottom">
				<div>
					<?php
						$footer_menu = array('theme_location' => 'footer');
						wp_nav_menu($footer_menu);
					?>
				</div>

				<!-- Copyright Text -->
				<?php
					if(get_field('copyright-text', 'option')):
						$copyright = get_field('copyright-text', 'option');
				?>
						<div>
							<p class="copyright">&copy; Copyright <?php echo date('Y') . ' ' . $copyright; ?></p>
						</div>
				<?php endif; ?>
				<!-- Copyright Text End -->
			</div>
		</div>
	</footer>
	</div><!-- #site-wrapper -->
</div><!-- #page -->

<?php
	wp_footer();
	the_field('footer-script', 'option');
	if (function_exists('the_field')):
		the_field('footer_code', 'option');
	endif;
?>
	</body>
</html>


