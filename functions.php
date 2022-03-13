<?php
/**
 * Coalition Technologies functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Coalition_Technologies
 */

/**
 * Optimization is automatically enabled.
 *
 * Read the below documentation for a guide on how to fully apply optimzation.
 * Nitro replica code is set up in the theme, it can be toggled off by setting DISABLE_NITRO to true.
 *
 * @link https://docs.google.com/document/d/1cse5ZFq7p5o487uY-CWG7wzK770ASUkQ5Leovl2Ngzc/edit?usp=sharing 
 */
define( 'DISABLE_NITRO', false );

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function ct_setup() {

// Add theme support for
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script'
		)
	);

	add_theme_support( 'title-tag' );
	add_theme_support( 'woocommerce' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'customize-selective-refresh-widgets' );


// Gutenberg presets
	
	// Font Sizes	
	add_theme_support(
		'editor-font-sizes', 
		array(
			array(
				'name'      => 'Extra Large',
				'shortName' => 'XL',
				'size'      => 20,
				'slug'      => 'extra-large'
			),
			array(
				'name'      => 'Large',
				'shortName' => 'L',
				'size'      => 18,
				'slug'      => 'large'
			),
		)
	);

	// Background Gradients
	add_theme_support(
		'editor-gradient-presets',
		array(
			array(
				'name'     => 'White to light gray',
				'gradient' => 'linear-gradient(0deg, rgba(242,242,242,1) 0%, rgba(255,255,255,1) 100%)',
				'slug'     => 'white-to-light-gray'
			),
			array(
				'name'     => 'Black to transparent',
				'gradient' => 'linear-gradient(0deg, rgba(0,0,0,1) 0%, rgba(255,255,255,0) 100%)',
				'slug'     => 'black-to-transparent',
			),
			array(
				'name'     => 'Low alpha black to transparent',
				'gradient' => 'linear-gradient(0deg, rgba(0,0,0,0.65) 0%, rgba(255,255,255,0) 100%)',
				'slug'     => 'low-alpha-black-to-transparent',
			),
		)
	);

	// Background Colors
	add_theme_support(
		'editor-color-palette', array(
			array(
				'name'	=> 'White',
				'slug'	=> 'white',
				'color'	=> '#FFFFFF',
			),
			array(
				'name'	=> 'Black',
				'slug'	=> 'black',
				'color'	=> '#000000',
			),
		)
	);


// Register custom image sizes
	add_image_size( 'ct-gallery', 330, 220, array( 'center', 'center' ) );
	add_image_size( 'ct-section-header', 1146, 380, array( 'center', 'center' ) );
	add_image_size( 'ct-thumb', 86, 86, false );
	add_image_size( 'ct-thumb-large',167, 167, false );
	add_image_size( 'ct-small', 280, 280, false );
	add_image_size( 'ct-medium', 370, 370, false );
	add_image_size( 'ct-xmedium', 960, 960, false );
	add_image_size( 'ct-large', 1280, 1280, false );

	add_image_size('team-member-thumb', 243, 243, false);

}
add_action( 'after_setup_theme', 'ct_setup' );


/**
 * File for requird plugins of the theme to function.
 */
require_once get_template_directory() . '/functions/plugins/required-plugins.php';

/**
 * File for enqueuing scripts and styles.
 */
require_once get_template_directory() . '/functions/enqueue.php';

/**
 * File for registring post types, taxonomies sidebars and menus.
 */
require_once get_template_directory() . '/functions/register-cpt.php';

/**
 * File for ACF theme settings.
 */
require get_template_directory() . '/acf/init.php';

/**
 * File for filter and action hooks.
 */
require get_template_directory() . '/functions/wp-hooks.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/functions/helper-functions.php';

/**
 * Custom shortcodes for the theme.
 */
require get_template_directory() . '/functions/shortcodes.php';

/**
 * Optimization for the site.
 */
require get_template_directory() . '/functions/optimization.php';

/**
 * Custom created functions for the theme
 */
require_once get_template_directory() . '/functions/custom-functions.php';

/**
 * Custom created Widgets for the theme
 */
require_once get_template_directory() . '/functions/widgets.php';

/**
 * WooCommerce integration.
 */
if ( class_exists( 'woocommerce' ) ) {

	require get_template_directory() . '/functions/woocommerce.php';

}

/**
 * Setup of the welcome panel.
 */
remove_action( 'welcome_panel', 'wp_welcome_panel' );

add_action( 'welcome_panel', function() { ?>
	<style>.welcome-panel{overflow:hidden;}.welcome-panel-close,[for="wp_welcome_panel-hide"]{display:none!important;}</style>
	<iframe src="https://ct-wp-widget.pages.dev/wp-widget" frameborder="0" width="100%" id="ct-sales"></iframe>
	<script type="text/javascript">var eventMethod=window.addEventListener?'addEventListener':'attachEvent',eventer=window[eventMethod],messageEvent=eventMethod=='attachEvent'?'onmessage':'message',widget=document.getElementById('ct-sales');eventer(messageEvent,function(e){if(isNaN(e.data))return;widget.style.height=e.data+'px'},!1);widget.addEventListener('load',function(){widget.contentWindow.postMessage('ct_host','*')});if(!document.getElementById('wp_welcome_panel-hide').checked){document.getElementById('wp_welcome_panel-hide').click()}</script>
<?php } );
