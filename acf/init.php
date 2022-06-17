<?php

function ct_css_margin_control( $version ) {
	include_once( 'field-types/padding-margin-control.php' );
}
add_action( 'acf/include_field_types', 'ct_css_margin_control' );

// If using ACF that supports block types
if ( function_exists( 'acf_register_block_type' ) ) :

	// Reuseable global variable of color.
	define( 'CT_COLOR', '#FFFFFF' );
	define( 'CT_BG_COLOR', '#076aab' );

	/**
	 * Function to register ACF block type
	 *
	 * @link https://www.advancedcustomfields.com/resources/acf_register_block_type/
	 */
	function ct_register_acf_block_types() {
		$cache_button            = filemtime(assets_directory() . '/css/blocks/button.css');
		$cache_social            = filemtime(assets_directory() . '/css/blocks/social-accounts.css');
		$cache_card              = filemtime(assets_directory() . '/css/blocks/social-accounts.css');
		$cache_rss               = filemtime(assets_directory() . '/css/blocks/card.css');
		$cache_testimonial       = filemtime(assets_directory() . '/css/blocks/testimonial.css');
		$cache_testimonial_02       = filemtime(assets_directory() . '/css/blocks/testimonial-02.css');
		$cache_downloadable_list = filemtime(assets_directory() . '/css/blocks/downloadable-list.css');

		// Button Block
		acf_register_block_type(array(
			'name'				=> 'button',
			'title'				=> 'Button',
			'description'		=> 'Add CTA button to your website',
			'render_template'	=> 'acf/templates/button.php',
			'category'			=> 'coalition',
			'supports'			=> array(
			'anchor'			=> true,
			),
			'icon'				=> array(
				'src'				=> 'button',
				'foreground'		=> CT_COLOR,
				'background'		=> CT_BG_COLOR,
			),
			'keywords'			=> array('button', 'link'),
			'enqueue_style'		=> assets_uri() . '/css/blocks/button.css?ct-cache=' . $cache_button,
		));

		// Social Accounts
		acf_register_block_type(array(
			'name'				=> 'social-accounts',
			'title'				=> 'Social Accounts',
			'description'		=> 'Add social media links to your website',
			'render_template'	=> 'acf/templates/social-accounts.php',
			'category'			=> 'coalition',
			'supports'			=> array(
				'anchor'			=> true,
			),
			'icon'				=> array(
				'src'				=> 'share',
				'foreground'		=> CT_COLOR,
				'background'		=> CT_BG_COLOR,
			),
			'keywords'			=> array('social media'),
			'enqueue_style'		=> assets_uri() . '/css/blocks/social-accounts.css?ct-cache=' . $cache_social,
		));

		// Card Block
		acf_register_block_type(array(
			'name'				=> 'card',
			'title'				=> 'Card',
			'description'		=> 'Display content in using card layout',
			'render_template'	=> 'acf/templates/card.php',
			'category'			=> 'coalition',
			'supports'			=> array(
			'anchor'			=> true,
			),
			'icon'				=> array(
				'src'				=> 'index-card',
				'foreground'		=> CT_COLOR,
				'background'		=> CT_BG_COLOR,
			),
			'keywords'			=> array('card', 'cards', 'block'),
			'enqueue_style'		=> assets_uri() . '/css/blocks/card.css?ct-cache=' . $cache_card,
		));

		// RSS Feed Block
		acf_register_block_type(array(
			'name'				=> 'rss-feed',
			'title'				=> 'RSS Feeds',
			'description'		=> 'Display RSS Feed',
			'render_template'	=> 'acf/templates/rss-feed.php',
			'category'			=> 'coalition',
			'supports'			=> array(
				'anchor'			=> true,
			),
			'icon'				=> array(
				'src'				=> 'rss',
				'foreground'		=> CT_COLOR,
				'background'		=> CT_BG_COLOR,
			),
			'keywords'			=> array('rss feed'),
			'enqueue_style'		=> assets_uri() . '/css/blocks/rss-feed.css?ct-cache=' . $cache_rss,
		));

		// Tetimonial Block
		acf_register_block_type(array(
			'name'				=> 'testimonial',
			'title'				=> 'Testimonial',
			'description'		=> 'Add testimonial block with content on left and picture on right',
			'render_template'	=> 'acf/templates/testimonial.php',
			'category'			=> 'coalition',
			'supports'			=> array(
				'anchor'			=> true,
			),
			'icon'				=> array(
				'src'				=> 'testimonial',
				'foreground'		=> CT_COLOR,
				'background'		=> CT_BG_COLOR,
			),
			'keywords'			=> array('testimonial'),
			'enqueue_style'		=> assets_uri() . '/css/blocks/testimonial.css?ct-cache=' . $cache_testimonial,
		));

		// Tetimonial Block 02
		acf_register_block_type(array(
			'name'				=> 'testimonial-02',
			'title'				=> 'Testimonial 02',
			'description'		=> 'Add testimonial block with content on right and picture on left',
			'render_template'	=> 'acf/templates/testimonial-02.php',
			'category'			=> 'coalition',
			'supports'			=> array(
				'anchor'			=> true,
			),
			'icon'				=> array(
				'src'				=> 'testimonial',
				'foreground'		=> CT_COLOR,
				'background'		=> CT_BG_COLOR,
			),
			'keywords'			=> array('testimonial'),
			'enqueue_style'		=> assets_uri() . '/css/blocks/testimonial-02.css?ct-cache=' . $cache_testimonial_02,
		));

		// Downloadable List
		acf_register_block_type(array(
			'name'				=> 'downloadable-list',
			'title'				=> 'Downloadable List',
			'description'		=> 'Add downloadable content to your website',
			'render_template'	=> 'acf/templates/downloadable-list.php',
			'category'			=> 'coalition',
			'supports'			=> array(
				'anchor'			=> true,
			),
			'icon'				=> array(
				'src'				=> 'download',
				'foreground'		=> CT_COLOR,
				'background'		=> CT_BG_COLOR,
			),
			'keywords'			=> array('download', 'list', 'downloadable-list', 'downloadable-content', 'file' , 'downloadable-file', 'pdf', 'document'),
			'enqueue_style'		=> assets_uri() . '/css/blocks/downloadable-list.css?ct-cache=' . $cache_downloadable_list,
		));

		add_action('acf/init', 'my_acf_init_block_types');
		function my_acf_init_block_types() {
		
		    // Check function exists.
		    if( function_exists('acf_register_block_type') ) {
		
		        // register a testimonial block.
		        acf_register_block_type(array(
		            'name'              => 'testimonial',
		            'title'             => __('Testimonial'),
		            'description'       => __('A custom testimonial block.'),
		            'render_template'   => 'template-parts/blocks/testimonial/testimonial.php',
		            'category'          => 'formatting',
		            'icon'              => 'admin-comments',
		            'keywords'          => array( 'testimonial', 'quote' ),
		        ));
		    }
		}

	}
	add_action( 'acf/init', 'ct_register_acf_block_types' );

	/**
	 * Register gutenberg block and re-order it to make custom category first.
	 * 
	 * @param  array $categories contains all registered categories
	 * @return array             sorted categories
	 */
	function ct_block_category( $categories ) {

		$custom_block = array(
			'slug'	=> 'coalition',
			'icon'	=> 'wordpress',
			'title'	=> 'CT Custom Blocks',
		);

		$categories_sorted = array();
		$categories_sorted[0] = $custom_block;

		foreach ($categories as $category) {
			$categories_sorted[] = $category;
		}

		return $categories_sorted;

	}
	add_filter( 'block_categories', 'ct_block_category', 10, 1);

endif;

/**
	  ________                                     __  __  _
	 /_  __/ /_  ___  ____ ___  ___     ________  / /_/ /_(_)___  ____ ______
	  / / / __ \/ _ \/ __ `__ \/ _ \   / ___/ _ \/ __/ __/ / __ \/ __ `/ ___/
	 / / / / / /  __/ / / / / /  __/  (__  )  __/ /_/ /_/ / / / / /_/ (__  )
	/_/ /_/ /_/\___/_/ /_/ /_/\___/  /____/\___/\__/\__/_/_/ /_/\__, /____/
															   /____/
 */

if ( function_exists( 'acf_add_local_field_group' ) ) :

	/**
	 * Add quick link to site settings to the admin nav bar
	 *
	 * @param  object $wp_admin_bar contains the admin bar object.
	 */
	function ct_add_site_settings( $wp_admin_bar ) {
		$args = array(
			'id'    => 'ct-settings',
			'title' => '<i class="dashicons-before dashicons-sos" style="line-height: 20px;display: inline-block;"></i> CT Settings',
			'href'  => admin_url( 'admin.php?page=ct-settings' ),
			'meta'  => array(
				'html'     => '<style>#wp-admin-bar-ct-settings a{color:#FFFFFF!important;background:#006AAC!important}</style>',
			),
		);

		$wp_admin_bar->add_node( $args );
		$wp_admin_bar->remove_node( 'wp-logo' );
		$wp_admin_bar->remove_node( 'comments' );
		$wp_admin_bar->remove_node( 'customize' );
	}
	add_action( 'admin_bar_menu', 'ct_add_site_settings', 99 );

	/**
	 * Registering ACF options page
	 */
	function ct_settings() {

		// Check function exists.
		if ( function_exists( 'acf_add_options_page' ) ) {

			acf_add_options_page(
				array(
					'position'      => 1,
					'page_title'    => 'CT Settings',
					'menu_title'    => 'CT Settings',
					'menu_slug'     => 'ct-settings',
					'icon_url'      => 'dashicons-sos',
				)
			);
		}
	}
	add_action( 'acf/init', 'ct_settings' );


	/**
	 * Fixing admin area with CSS
	 */
	function ct_fix_admin_stuff() {
		echo '
		<style>
			.wp-block {
				max-width: 1170px;
			}
			.editor-post-title textarea {
				text-align: center;
			}
		</style>
		';
	}
	add_action( 'admin_head', 'ct_fix_admin_stuff' );

endif;
