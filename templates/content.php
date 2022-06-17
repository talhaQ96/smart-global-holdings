<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Coalition_Technologies
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="entry-content">
		<section class="section-blog has-padding-eq-sm">
			<div class="container">
				<?php the_post_thumbnail(); ?>

				<div class="blog-details">
					<p><?php the_date(); ?></p>
					<h2><?php the_title(); ?></h2>
					<?php the_category(); ?>
				</div>

				<div class="blog-content">
					<?php
						the_content(
							sprintf(
								wp_kses(
									/* translators: %s: Name of current post. Only visible to screen readers */
									__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'ct' ),
									array(
										'span' => array(
											'class' => array(),
										),
									)
								),
								wp_kses_post( get_the_title() )
							)
						);

						wp_link_pages(
							array(
								'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'ct' ),
								'after'  => '</div>',
							)
						);
					?>
				</div>

				<?php
					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;
				?>
			</div>
		</section>
	</div>
</article>
