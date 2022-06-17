<?php
/**
 * This is the file for Button ACF block type
 */
 
global $ctblock;
$ctblock = $block;

$button       = get_field('button');
$link         = $button['link'];
$css_class    = $button['css-class'];

    if($link):
        $url  = $link['url'];
        $text = $link['title'];
        $link_target = $link['target'] ? $link['target'] : '_self';
?>

    <div class="acf-button-block">
        <a class="button <?php echo $css_class; ?>"
           href="<?php echo $url; ?>"
           target="<?php echo esc_attr( $link_target ); ?>"
           >
           <?php echo $text; ?>
           <span></span>
        </a>
    </div>
<?php endif; ?>