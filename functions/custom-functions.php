<?php

/**
 * Function for Adding Custom Admin Dashboard Logo
 */
function wpb_login_logo() { ?>
    <style type="text/css">
        #login h1 a, .login h1 a {
            background-image: url(<?php echo assets_uri(); ?>/images/custom-logo.svg);
            height: 45px;
            width: 140px;
            background-size: 140px 45px;
            background-repeat: no-repeat;
            padding-bottom: 10px;
        }
    </style>
<?php }
add_action( 'login_enqueue_scripts', 'wpb_login_logo' );

function wpb_login_logo_url() {
    return home_url();
}

add_filter( 'login_headerurl', 'wpb_login_logo_url' );
 
function wpb_login_logo_url_title() {
    return 'Smart Global Holdings';
}

add_filter( 'login_headertitle', 'wpb_login_logo_url_title' );

/**
 * Function for Custom Comment Template
 */

if(!function_exists('custom_comments_template')):
    function custom_comments_template($comment, $args, $depth) {
?>
   <li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
        <div>
            <div class="avatar">
                <?php echo get_avatar($comment, $size='80', $default='http://0.gravatar.com/avatar/36c2a25e62935705c5565ec465c59a70?s=32&d=mm&r=g' ); ?>
            </div>

            <div class="comment-block">
                <div class="comment-meta">
                    <div>
                        <p><strong><?php comment_author(); ?></strong></p>
                        <p class="date"><?php printf(esc_html__('%1$s at %2$s' , 'ct'), get_comment_date(),  get_comment_time()); ?></p>
                    </div>

                    <div>
                        <?php comment_reply_link(array_merge($args, array('depth' => $depth, 'max_depth' => 2))); ?>
                    </div>
                </div>

                <div class="comment-text">
                    <?php comment_text(); ?>
                </div>
            </div>
        </div>
   </li>
<?php }
endif;

/**
 * Function for Adding Placeholders to Comment Form Fields
 */

// Placeholder Name, Email, URL

 function placeholder_author_email_url_form_fields($fields) {
    $replace_author = __('Your Name', 'yourdomain');
    $replace_email =  __('Your Email', 'yourdomain');
    $replace_url =    __('Your Website', 'yourdomain');
    
    $fields['author'] = '<p class="comment-form-author">' . '<label for="author">' . __( 'Name', 'yourdomain' ) . '</label> ' . ( $req ? '<span class="required">*</span>' : '' ) .
                    '<input id="author" name="author" type="text" placeholder="'.$replace_author.'" value="' . esc_attr( $commenter['comment_author'] ) . '" size="20"' . $aria_req . ' /></p>';
                    
    $fields['email'] = '<p class="comment-form-email"><label for="email">' . __( 'Email', 'yourdomain' ) . '</label> ' .
    ( $req ? '<span class="required">*</span>' : '' ) .
    '<input id="email" name="email" type="text" placeholder="'.$replace_email.'" value="' . esc_attr(  $commenter['comment_author_email'] ) .
    '" size="30"' . $aria_req . ' /></p>';
    
    $fields['url'] = '<p class="comment-form-url"><label for="url">' . __( 'Website', 'yourdomain' ) . '</label>' .
    '<input id="url" name="url" type="text" placeholder="'.$replace_url.'" value="' . esc_attr( $commenter['comment_author_url'] ) .
    '" size="30" /></p>';
    
    return $fields;
}
add_filter('comment_form_default_fields','placeholder_author_email_url_form_fields');

// Comment Field

 function placeholder_comment_form_field($fields) {
    $replace_comment = __('Your Comment', 'yourdomain');
     
    $fields['comment_field'] = '<p class="comment-form-comment"><label for="comment">' . _x( 'Comment', 'noun' ) .
    '</label><textarea id="comment" name="comment" cols="45" rows="8" placeholder="'.$replace_comment.'" aria-required="true"></textarea></p>';
    
    return $fields;
 }
add_filter( 'comment_form_defaults', 'placeholder_comment_form_field' );
