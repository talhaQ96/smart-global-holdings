<?php


/**
 * Enqueue scripts and styles.
 */
function ct_scripts() {
	/**
	 * Custom enqueuing for scripts
	 *
	 *  Handle => array (
	 *      path (/ct-theme/assets/js/ is the path used),
	 *      version (if empty will use filemtime),
	 *      require all prior scripts (true, false (only require jQuery), define script handles that are required)
	 *  )
	 */
	$scripts = array(
		'main' => array( 'main.js', '', false ),
	);

// For all pages.
	$cache = filemtime( assets_directory() . '/css/core.css' );
	wp_enqueue_style( 'ct-main', assets_uri() . '/css/core.css', false, $cache, 'all' );
	wp_enqueue_style( 'ct-print', assets_uri() . '/css/print.css', false, $cache, 'all' );
	wp_enqueue_style( 'ct-fonts', assets_uri() . '/css/fonts.css', false, $cache, 'all' );
	wp_enqueue_style( 'ct-fontawesome', assets_uri() . '/css/fontawesome.css', false, $cache, 'all' );

// Assets for front page.
	if (is_front_page()) {
		$cache = filemtime( assets_directory() . '/css/templates/home.css' );
		wp_enqueue_style( 'ct-home', assets_uri() . '/css/templates/home.css', false, $cache, 'all' );
	}

// Assets for LEADERSHIP page.
	if (is_page('leadership')) {
		$cache = filemtime( assets_directory() . '/css/templates/leadership.css' );
		wp_enqueue_style( 'ct-leadership', assets_uri() . '/css/templates/leadership.css', false, $cache, 'all' );
	}

// Assets for ABOUT page.
	if (is_page('about')) {
		$cache = filemtime( assets_directory() . '/css/templates/leadership.css' );
		wp_enqueue_script('doughnut-chart', assets_uri() . '/js/chart.js', '', '', true);
	}

//Assets for default page template.
	if (basename(get_page_template()) === 'page.php' && ! is_front_page()) {
		$cache          = filemtime(assets_directory() . '/css/templates/page.css');
		$cache_comments = filemtime(assets_directory() . '/css/templates/comments.css');
		wp_enqueue_style('ct-page', assets_uri() . '/css/templates/page.css', false, $cache, 'all' );
		wp_enqueue_style('ct-comments', assets_uri() . '/css/templates/comments.css', false, $cache_sidebar, 'all');
	}

// Assets for single post templates.
	if (is_single()){
		$cache = filemtime(assets_directory() . '/css/templates/single.css');
		wp_enqueue_style('ct-single', assets_uri() . '/css/templates/single.css', false, $cache, 'all');
	}

// Assets for archive templates.
	if (is_post_type_archive() || is_archive() || is_home() || is_search()) {
		$cache = filemtime( assets_directory() . '/css/templates/archive.css' );
		wp_enqueue_style( 'ct-archive', assets_uri() . '/css/templates/archive.css', false, $cache, 'all' );
	}

// Assets for any WooCommerce page template
	if (is_realy_woocommerce_page()){
	}

	ct_enqueue_scripts( $scripts );
}
add_action( 'wp_enqueue_scripts', 'ct_scripts' );