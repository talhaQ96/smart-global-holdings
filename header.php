<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Coalition_Technologies
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<?php get_template_part('templates/head', 'nitro'); ?>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php
		the_field('header-script', 'option');
		wp_head();
		if (function_exists('the_field')):
			the_field('header_code', 'option');
		endif;

		if(is_page('about')){
			echo '<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.5.1/chart.min.js"></script>';
			echo '<script src="https://cdnjs.cloudflare.com/ajax/libs/chartjs-plugin-datalabels/2.0.0/chartjs-plugin-datalabels.min.js"></script>';
		}
	?>

</head>
<body>
	<?php
		the_field('body-script', 'option');
		wp_body_open();
	?>
	<div id="overlay"></div>
	<div id="page">
		<div id="site-wrapper" <?php body_class( 'site' ); ?>>

	<header id="header">
		<div class="container">
			<!-- Desktop Navigation -->
			<div class="navigation-wrap">
				<!-- LEFT Navigation -->
				<div>
					<nav>
						<?php
							$header_menu_1 = array('theme_location' => 'primary_1');
							wp_nav_menu($header_menu_1);
						?>
					</nav>
				</div>
				<!-- LEFT Navigation END -->

				<!-- LOGO -->
				<?php
					$logo = get_field('header-logo', 'option');
					if($logo):
				?>
						<div class="logo-wrap">
							<a href="<?php echo get_site_url(); ?>" class="logo">
								<?php echo wp_get_attachment_image($logo);?>	
							</a>
						</div>
				<?php endif; ?>
				<!-- LOGO END -->

				<!-- RIGHT Navigation -->
				<div class="ml-neg">
					<nav>
						<?php
							$header_menu_2 = array('theme_location' => 'primary_2');
							wp_nav_menu($header_menu_2);
						?>
					</nav>
				</div>
				<!-- RIGHT Navigation END -->

				<!-- Search Field -->
					<div class="large-dvc-search">
						<?php get_search_form(); ?>
					</div>
				<!-- Search Field End -->
			</div>
			<!-- Desktop Navigation End -->

			<!-- Mobile Navigation -->
			<div class="mobile-navigation">
				<!-- LOGO -->
				<?php
					$logo = get_field('header-logo', 'option');
					if($logo):
				?>
						<div class="logo-wrap">
							<a href="<?php echo get_site_url(); ?>" class="logo">
								<?php echo wp_get_attachment_image($logo);?>	
							</a>
						</div>
				<?php endif; ?>
				<!-- LOGO END -->

				<div id="ham-icon-wrap">
					<div class="ham-icon"><div class="lines"></div></div>
				</div>
			</div>
			<!-- Mobile Navigation End-->	
		</div>
	</header>

	<!-- Overlay Mobile Menu -->
	<div id="overlay-menu">
		<div class="container">
			<nav>
				<?php
					$mobile_menu = array('theme_location' => 'mobile_menu');
					wp_nav_menu($mobile_menu);
				?>
			</nav>
		</div>
	</div>
	<!-- Overlay Mobile Menu End-->

	<div id="content" class="site-content">
