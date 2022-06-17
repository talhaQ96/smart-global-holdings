<?php
/**
 * Template-Part for displaying a message that posts cannot be found
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Coalition_Technologies
 */

?>

<section class="not-found has-padding-eq">
	<div class="container">
		<div class="wrapper">
			<h2><?php esc_html_e('Nothing Found', 'ct'); ?></h2>

			<?php
				//if blog post page and user can pusblish posts

				if (is_home() && current_user_can('publish_posts')):
					printf(
						'<p>' . wp_kses(
							__( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'ct' ),
							array(
								'a' => array(
									'href' => array(),
								),
							)
						) . '</p>',
						esc_url(admin_url('post-new.php'))
					);

				//if search page
		
				elseif (is_search()):
			?>
					<p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'ct' ); ?></p>

			<?php
					get_search_form();

				else:
			?>
					<p><?php esc_html_e('It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'ct'); ?></p>

			<?php
					get_search_form();

				endif;
			?>
		</div>
	</div>
</section>
