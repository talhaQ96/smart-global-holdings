<?php
/**
 * This is the file for the Social Accounts ACF block type
 */

global $ctblock;
$ctblock = $block;
?>

<?php if(have_rows('social-accounts')): ?>
    <div class="acf-social-accounts">
        <ul id="social">
            <?php while(have_rows('social-accounts')): the_row(); ?>
                <li>
                    <a href="<?php the_sub_field('url'); ?>" target="_blank">
                        <?php the_sub_field('social-icon'); ?>
                    </a>
                </li>
            <?php endwhile; ?>
        </ul>
    </div>
<?php endif; ?>