<?php

/**
 * Template Name: Leadership
 */
get_header();
?>

<!-- Featured Image Banner -->
<?php
    if(has_post_thumbnail()):
        $feat_img = get_the_post_thumbnail_url();
    ?>
    <section class="banner <?php the_field('heading-position'); ?>" style="background-image: url('<?php echo $feat_img ?>')">
        <div class="container">
            <?php
                if(get_field('heading-text')):
                    $text  = get_field('heading-text');
                    $color = get_field('heading-color');
            ?>
                <h1 class="title"
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
<!-- Featured Image Banner END-->

<!-- Management Team Section -->
<?php
    $team = array(
        'post_type'      => 'team-member',
        'posts_per_page' => -1,
        'tax_query' => array(
            array(
                'taxonomy' => 'member_type',
                'terms' => 'management',
                'field' => 'slug'
            )
        ),
    );

    $teamQuery = new WP_Query($team);

    if($teamQuery->have_posts()):
?>
    <section class="leadership section-management has-padding">
        <div class="container">
            <h2>Our Team</h2>
            <div class="grid">
                <?php
                  while($teamQuery->have_posts()): $teamQuery->the_post();

                        $member_picture     = get_field('member-picture');
                        $member_designation = get_field('member-designation');
                ?>
                        <div class="wrapper">
                            <div>
                                <div class="member-info">
                                    <h3><?php the_title(); ?></h3>
                                    <p><?php echo $member_designation; ?></p>
                                    <span class="open">+</span>
                                </div>                                    
                            </div>

                            <div>
                                <div><?php echo wp_get_attachment_image($member_picture, 'full'); ?></div>
                            </div>

                            <div class="bio">
                                <div>
                                    <?php
                                        echo wp_get_attachment_image($member_picture, 'full');
                                        echo '<p>' . $member_designation . '</p>';
                                    ?>
                                </div>
                                <div>
                                    <?php the_content(); ?>
                                </div>
                                <span class="close"><i class="fas fa-window-close"></i></span>
                            </div>
                        </div>

                <?php endwhile; ?>
            </div>
        </div>
    </section>
<?php endif; ?>
<!-- Management Section END -->

<!-- Board of Directors Section -->
<?php
    $team = array(
        'post_type'      => 'team-member',
        'posts_per_page' => -1,
        'tax_query' => array(
            array(
                'taxonomy' => 'member_type',
                'terms' => 'board-of-directors',
                'field' => 'slug'
            )
        ),
    );

    $teamQuery = new WP_Query($team);

    if($teamQuery->have_posts()):
?>
    <section class="leadership section-BOD has-padding-eq-sm">
        <div class="container">
            <h2>Board of Directors</h2>
            <div class="grid">
                <?php
                  while($teamQuery->have_posts()): $teamQuery->the_post();

                        $member_picture     = get_field('member-picture');
                        $member_designation = get_field('member-designation');
                ?>
                         <div class="wrapper">
                            <div>
                                <div class="member-info">
                                    <h3><?php the_title(); ?></h3>
                                    <p><?php echo $member_designation; ?></p>
                                    <span class="open">+</span>
                                </div>
                            </div>

                            <div>
                                <div><?php echo wp_get_attachment_image($member_picture, 'full'); ?></div>
                            </div>

                            <div class="bio">
                                <div>
                                    <?php
                                        echo wp_get_attachment_image($member_picture, 'full');
                                        echo '<p>' . $member_designation . '</p>';
                                    ?>
                                </div>
                                <div>
                                    <?php the_content(); ?>
                                </div>
                                <span class="close"><i class="fas fa-window-close"></i></span>
                            </div>
                        </div>

                <?php endwhile; ?>
            </div>
        </div>
    </section>
<?php endif; ?>
<!-- Board of Directors Section END -->

<!-- Advisors Section -->
<?php
    $team = array(
        'post_type'      => 'team-member',
        'posts_per_page' => -1,
        'tax_query' => array(
            array(
                'taxonomy' => 'member_type',
                'terms' => 'advisor',
                'field' => 'slug'
            )
        ),
    );

    $teamQuery = new WP_Query($team);

    if($teamQuery->have_posts()):
?>
    <section class="leadership section-management has-padding-rev">
        <div class="container">
            <h2>Advisors</h2>
            <div class="grid">
                <?php
                  while($teamQuery->have_posts()): $teamQuery->the_post();

                        $member_picture     = get_field('member-picture');
                        $member_designation = get_field('member-designation');
                ?>
                        <div class="wrapper">
                            <div>
                                <div class="member-info">
                                    <h3><?php the_title(); ?></h3>
                                    <p><?php echo $member_designation; ?></p>
                                </div>                                    
                            </div>

                            <div>
                                <div><?php echo wp_get_attachment_image($member_picture, 'full'); ?></div>
                            </div>
                        </div>

                <?php endwhile; ?>
            </div>
        </div>
    </section>
<?php endif; ?>
<!-- Advisors Section END -->

<?php get_footer(); ?>