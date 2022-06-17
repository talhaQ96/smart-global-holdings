<?php
/**
 * This is the file for the Solution ACF block type
 */

global $ctblock;
$ctblock = $block;

$background_image = get_field('background-image');
$logo = get_field('logo');
$link = get_field('link');
?>

<div class="acf-solution-block" style="background-image: url('<?php echo $background_image ?>');">
    <div class="content-wrapper">
        <?php if(get_field('logo')): ?>
            <div>
                <?php echo wp_get_attachment_image($logo); ?>
            </div>
    
            <div>
                <h6><?php the_field('title'); ?></h6>
                <p><?php the_field('text'); ?></p>
    
                <?php if($link):
                    $link_url = $link['url'];
                    $link_title = $link['title'];
                    $link_target = $link['target'] ? $link['target'] : '_self';
                ?>
                    <a href="<?php echo esc_url($link_url); ?>" target="<?php echo esc_attr($link_target); ?>"><?php echo esc_html($link_title); ?></a>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>
</div>