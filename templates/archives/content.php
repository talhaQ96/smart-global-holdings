<?php
/**
 * The template-part for displaying Posts in Archive Pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Coalition_Technologies
 */
?>

<div class="posts-grid">
	<?php while(have_posts()): the_post(); ?>
		<div class="post-wrapper">
			<a href="<?php the_permalink(); ?>" class="featured-image">
				<?php the_post_thumbnail(); ?>
			</a>
			<div class="post-inner">
				<p class="post-date"><?php echo get_the_date(); ?></p>
				<a href="<?php the_permalink(); ?>">
					<h3><?php the_title(); ?></h3>
				</a>
				<?php the_excerpt(); ?>
				<a href="<?php the_permalink(); ?>" class="button">Read More</a>
			</div>
		</div>
	<?php endwhile; ?>
</div>

<?php the_posts_pagination(); ?>

