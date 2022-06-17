<?php

/**
 * |-------------------------------------------------|
 * |-------------------------------------------------|
 * |  Any disabling/enabling hooks goes at the top   |
 * |-------------------------------------------------|
 * |-------------------------------------------------|
 */
add_filter( 'facetwp_facet_dropdown_show_counts', '__return_false' ); // disable the FacetWP show count


/**
 * Disable non-admin users seeing the admin toolbar.
 */
function ct_remove_admin_bar() {
	if ( !current_user_can( 'administrator' ) && !is_admin() ) {
		show_admin_bar( false );
	}
}
add_action( 'after_setup_theme', 'ct_remove_admin_bar' );


/**
 * Remove dots from excerpt more
 * @param  string $more contains the existing more string
 * @return string       return no more string
 */
function ct_excerpt_more( $more ) {
	return '';
}
add_filter( 'excerpt_more', 'ct_excerpt_more' );


/**
 * Limit excerpt to end of sentence instead of word
 * @param  string $excerpt the excerpt
 * @return string          the modified excerpt output
 */
function ct_custom_excerpt_length( $excerpt ) {
	return neat_trim( $excerpt, 30, 'words', 'sentence' );
}
add_filter( 'get_the_excerpt', 'ct_custom_excerpt_length' );


/**
 * Add our custom palette to ACF fields using JS
 * @return string echos the script
 */
function ct_custom_color_picker() { 

	$color_palette = ct_colors();
	if ( !$color_palette )
		return;
	
	?>
	<script type="text/javascript">
		(function( $ ) {
			acf.add_filter( 'color_picker_args', function( args, $field ){

				// add the hexadecimal codes here for the colors you want to appear as swatches
				args.palettes = <?php echo $color_palette; ?>;

				// return colors
				return args;

			});
		})(jQuery);
	</script>
	<?php
}
add_action( 'acf/input/admin_footer', 'ct_custom_color_picker' );


/**
 * CT fix for customizer error due to custom nav walker needed
 * @param array  $items An array of menu item post objects.
 * @param object $menu  The menu object.
 * @param array  $args  An array of arguments used to retrieve menu item objects.
 * @return array        An array with the description left blank.
 */
function ct_fix_for_customizer_error( $items, $menu, $args ) {
	foreach ( $items as $key => $item ) {
		$items[$key]->description = '';
	}

	return $items;
}
add_filter( 'wp_get_nav_menu_items', 'ct_fix_for_customizer_error', 10, 3 );


/**
 * Disable Gutenberg's core styling overwriting the theme styles
 * @param  array $settings contains settings for the gutenberg editor
 * @return array           the modfied array 
 */
function remove_guten_wrapper_styles( $settings ) {
	unset( $settings['styles'][0] );
	return $settings;
}
add_filter( 'block_editor_settings' , 'remove_guten_wrapper_styles' );


/**
 * This function is for adding custom admin styles to fix any issues
 * @return string			the styles
 */
function ct_custom_admin_styles() {
	
	$styles = '
		<style type="text/css">
			.column-collection-featured {
				width: 100px !important;
				text-align: center !important;
			}
			.column-collection-color {
				width: 110px !important;
				text-align: center !important;
			}
			#posts-filter .wp-list-table tr,
			#posts-filter .wp-list-table th {
				vertical-align: middle !important;
			}
			#posts-filter .wp-list-table tr *,
			#posts-filter .wp-list-table th * {
				vertical-align: middle !important;
			}
			#posts-filter .wp-list-table thead th a span {
				float: none !important;
				display: inline-block !important;
				vertical-align: middle !important;
			}
			.editor-styles-wrapper h1,
			.editor-styles-wrapper h2,
			.editor-styles-wrapper h3,
			.editor-styles-wrapper h4,
			.editor-styles-wrapper h5,
			.editor-styles-wrapper h6,
			.editor-styles-wrapper p,
			.wp-block-cover-image .block-editor-block-list__block,
			.wp-block-cover .block-editor-block-list__block {
				color: inherit !important;
			}
			.editor-styles-wrapper p {
				font-size: inherit;
			}
			.components-popover.block-editor-block-list__block-popover .components-popover__content .block-editor-block-contextual-toolbar,
			.components-popover.block-editor-block-list__block-popover .components-popover__content .block-editor-block-list__breadcrumb,
			body .editor-styles-wrapper .block-editor-block-list__block {
				margin-top: 0 !important;
				margin-bottom: 0 !important;
			}
			body .block-editor-block-list__layout .block-editor-block-list__block:before {
				top: 0 !important;
				bottom: 0 !important;
			}
			body .editor-styles-wrapper {
				font-family: "Inter", "Archivo Narrow", sans-serif;
			}
			svg.components-panel__icon {
				width: 100px;
			}
			.block-editor__typewriter .components-button svg {
				fill: black;
			}
			#edittag {
				max-width: 90%;
				margin: 0 auto;
			}
		</style>
	';
	if ( get_current_screen()->id === 'edit-collaborators' ) {
		$styles .= '
			<style type="text/css">
				.form-field.term-description-wrap {
					display: none;
				}
				body {
					background: #ffffff;
				}
				.acf-field .medium-editor-element {
					box-shadow: none;
				}
				.form-field input, .form-field textarea, .form-field select, .acf-field .medium-editor-element {
					border: 1px solid #ddd !important;
					width: 100% !important;
				}
			</style>
		';
	}
	echo $styles;
}
add_action( 'admin_head', 'ct_custom_admin_styles' );


/**
 * This function is for add/removing supported SVG attributes
 * & it requires the safe-svg plugin for it to work.
 * 
 * @param  array $attributes contains all the attributes which are supported
 * @return array           attributes we want to be permitted in an SVG
 */
function ct_fix_svg_upload( $attributes ) {

	// Remove Width and height from the inline SVGs
	$attributes = array_diff( $attributes, array( 'width', 'height' ) );

	return $attributes;
}
add_filter( 'svg_allowed_attributes', 'ct_fix_svg_upload' );


/**
 * Only trigger hook if autoptimize is enabled because it's need for the final
 * HTML rendered filter so it can be modified.
 */
if ( function_exists( 'is_plugin_active' ) && is_plugin_active( 'autoptimize/autoptimize.php' ) ) {
	
	/**
	 * Function to make SVGs be loaded inline instead of as <img>.
	 * 
	 * @param  string $content HTML content of the page
	 * @return string          SVG <img> replaced with the inline SVGs
	 */
	function ct_svg_inliner( $content ) {
		// Save resources and only do it if SVG <img> are found.
		if ( preg_match( '/<img[^>]* src=\"([^\"]*[.svg] )\"[^>]*>/', $content ) ) {
			$post      = new DOMDocument();

			$post->loadHTML( mb_convert_encoding( $content, 'HTML-ENTITIES', 'UTF-8' ) );
			$img_list = $post->getElementsByTagName( 'img' );

			$i = $img_list->length - 1;
			while ( $i > -1 ) {
				$img     = $img_list->item( $i );
				$src_url = parse_url( $img->getAttribute( 'src' ), PHP_URL_PATH );
				$src_ext = pathinfo( $src_url, PATHINFO_EXTENSION );
				if ( 'svg' !== $src_ext ) { $i--; continue; }

				// no x-site monkey business
				$svg_host  = parse_url( $img->getAttribute( 'src' ), PHP_URL_HOST );
				$this_host = parse_url( get_site_url(), PHP_URL_HOST );
				if ( $this_host !== $svg_host ) { $i--; continue; }

				$svg_local_path = WP_CONTENT_DIR . substr(
					parse_url( $src_url, PHP_URL_PATH ),
					strpos( parse_url( $src_url, PHP_URL_PATH ), 'wp-content/', 1 ) + 10
				);

				if ( ! file_exists( $svg_local_path ) ) { $i--; continue; }
				$clean_svg = file_get_contents( $svg_local_path );
				if ( ! $clean_svg ) { $i--; continue; }
				$svg = new DOMDocument();
				$svg->loadXML( mb_convert_encoding( $clean_svg, 'HTML-ENTITIES', 'UTF-8' ) );

				// Create a container element for the SVG
				$containerDiv = $post->createElement( 'div' );
				$containerDiv->setAttribute( 'class', 'inline-svg' );

				// Replace the <img> with the container div
				$img->parentNode->replaceChild( $containerDiv, $img );
				
				// Add SVG to the container div
				$containerDiv = $containerDiv->appendChild(
					$post->importNode(
						$svg->getElementsByTagName( 'svg' )->item( 0 ),
						true
					)
				);

				// inc loop counter
				$i--;
			};

			return $post->saveHTML();
		} else {
			return $content;
		}
	}
	//add_filter( 'autoptimize_html_after_minify', 'ct_svg_inliner', 1, 1 );
}


/**
 * Add missing dimensions to <img> which are loading SVG images.
 * 
 * @param  [array] $image          Array of image data, or boolean false if no image is available.
 *                                 	  [string] Image source URL.
 *                                 	  [int] Image width in pixels.
 *                                 	  [int] Image height in pixels.
 *                                 	  [bool] Whether the image is a resized image.
 * @param  [int]   $attachment_id  Image attachment ID.
 * @param  [array] $size           Requested image size. Can be any registered image size name, or an array of width and height values in pixels (in that order).
 * @param  [bool]  $icon           Whether the image should fall back to a mime type icon.
 * 
 * @return [array]                 Modified $image with the dimensions to add support for SVGs.
 */
function ct_add_missing_svg_dimensions( $image, $attachment_id, $size, $icon ) {
    if ( is_array( $image ) && preg_match( '/\.svg$/i', $image[0] ) && $image[1] <= 1 ) {
        if ( is_array( $size ) ) {
            $image[1] = $size[0];
            $image[2] = $size[1];
        } elseif ( ( $xml = simplexml_load_file( $image[0] ) ) !== false ) {
            $attr = $xml->attributes();
            $viewbox = explode( ' ', $attr->viewBox );
            $image[1] = isset( $attr->width ) && preg_match( '/\d+/', $attr->width, $value ) ? ( int ) $value[0] : ( count( $viewbox ) == 4 ? ( int ) $viewbox[2] : null );
            $image[2] = isset( $attr->height ) && preg_match( '/\d+/', $attr->height, $value ) ? ( int ) $value[0] : ( count( $viewbox ) == 4 ? ( int ) $viewbox[3] : null );
        } else {
            $image[1] = $image[2] = null;
        }
    }
    return $image;
} 
add_filter( 'wp_get_attachment_image_src', 'ct_add_missing_svg_dimensions', 10, 4 );


