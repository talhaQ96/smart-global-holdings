<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Coalition_Technologies
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <?php
        if(has_post_thumbnail()):
            $feat_img = get_the_post_thumbnail_url();
            $sec_feat_img = get_field('sec-feat-img');
    ?>
            <!-- Header Image CSS -->
            <style>
                .banner{
                    background-image: url('<?php echo $feat_img; ?>');
                }

                <?php if($sec_feat_img): ?>
                    @media (max-width: 1199px){
                        .banner{
                            background-image: url('<?php echo $sec_feat_img; ?>');
                        }
                    }
                <?php endif; ?>
            </style>
             <!-- Header Image CSS END-->

            <section class="banner <?php the_field('heading-position'); ?>">
               <!-- Transparent Overlay -->
               <?php
                   if(get_field('enable-overlay')):
                       $background = get_field('overlay-color');
                       $opacity    = get_field('overlay-opacity');
               ?>
                       <div class="overlay" style="background: <?php echo $background ?>; opacity: <?php echo $opacity ?>;"></div>
               <?php endif; ?>
               <!-- Transparent Overlay END -->
    
                   <div class="container">
                           <?php
                               if(get_field('heading-text')):
                                   $text  = get_field('heading-text');
                                   $color = get_field('heading-color');
                                   $class = get_field('css-class');
                           ?>
                               <h1 class="title <?php echo $class; ?>"
                                   <?php
                                       if($color):
                                           echo 'style="color:' . $color . '"';
                                       endif;
                                   ?>
                               >
                                   <?php echo $text ?>
                               </h1>
                           <?php endif; ?>
                   </div>
           </section>
    <?php endif; ?>

	<div class="entry-content">
		<?php the_content(); ?>
	</div>
</article>