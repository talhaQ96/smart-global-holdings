<?php
/**
 * This is the file for Testimonial ACF block type
 */
 
global $ctblock;
$ctblock = $block;

$image = get_field('image');
?>

<div class="acf-testimonail-block">
    <div>
        <?php echo wp_get_attachment_image($image, 'full');?>
    </div>

    <div>
        <div class="comment">
            <p><?php the_field('comment'); ?></p>
        </div>

        <div class="author-info">
            <p><?php the_field('name'); ?></p>
            <p><?php the_field('designation'); ?></p>
        </div>
    </div>
</div>