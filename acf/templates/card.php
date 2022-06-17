<?php
/**
 * This is the file for Card ACF block type
 */
 
global $ctblock;
$ctblock = $block;

$image = get_field('image');
$link  = get_field('link');
?>

<div class="acf-card-block">
    <div class="thumbnail">
        <?php echo wp_get_attachment_image($image, 'full'); ?>
    </div>

    <div class="content">
        <div>
            <h4><?php the_field('title'); ?></h4>
            <p><?php the_field('text'); ?></p>
        </div>

        <div>
            <div>
                <p class="learn-more">Learn More</p>
            </div>

            <?php if(have_rows('logo-repeater-field')): ?>
                <div class="brand-logos">
                    <?php
                        while( have_rows('logo-repeater-field')) : the_row();
                            $logo = get_sub_field('logo');
                            $url  = get_sub_field('url');
                    ?>
                        <a href="<?php echo $url ?>" target="_blank">
                            <?php echo wp_get_attachment_image($logo, 'full'); ?>  
                        </a>

                    <?php endwhile; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>