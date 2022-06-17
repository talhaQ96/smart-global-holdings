<?php
/**
 * This is the file for Downloadable List ACF block type
 */
 
global $ctblock;
$ctblock = $block;

$customClass = $ctblock['className'];
?>

<div class="acf-downloadable-list-block <?php echo $customClass ?>">
    <?php
        if(have_rows('downloadable-list')):
            while(have_rows('downloadable-list')):the_row();
                $file_name = get_sub_field('file-name');
                $file_url  = get_sub_field('file-url');

                if($file_name):
    ?>
                <a href="<?php echo $file_url; ?>" target="_blank">
                    <?php echo $file_name; ?>
                </a>
    <?php
                endif;
           endwhile;
        endif;
    ?>
</div>