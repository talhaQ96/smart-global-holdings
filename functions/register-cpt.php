<?php

function ct_register_sidebars() {

// Register main navigation area
	register_nav_menus(array(
		'primary_1' => 'Header Left',
		'primary_2' => 'Header Right',
		'mobile_menu' => 'Mobile Menu',
		'footer' => 'Footer',
	));

// Register widget areas
	register_sidebar(
		array(
			'name'          => 'Header Widget',
			'id'            => 'header-widget',
			'description'   => 'Add widgets here.',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<label>',
			'after_title'   => '</label>',
		)
	);
	
	register_sidebar(
		array(
			'name'          => 'Footer Column 1',
			'id'            => 'footer-1',
			'description'   => 'Add widgets here.',
			'before_widget' => '<nav id="%1$s" class="widget %2$s">',
			'after_widget'  => '</nav>',
			'before_title'  => '<label class="footer-title">',
			'after_title'   => '</label>',
		)
	);
	register_sidebar(
		array(
			'name'          => 'Footer Column 2',
			'id'            => 'footer-2',
			'description'   => 'Add widgets here.',
			'before_widget' => '<nav id="%1$s" class="widget %2$s">',
			'after_widget'  => '</nav>',
			'before_title'  => '<label class="footer-title">',
			'after_title'   => '</label>',
		)
	);
	register_sidebar(
		array(
			'name'          => 'Footer Column 3',
			'id'            => 'footer-3',
			'description'   => 'Add widgets here.',
			'before_widget' => '<nav id="%1$s" class="widget %2$s">',
			'after_widget'  => '</nav>',
			'before_title'  => '<label class="footer-title">',
			'after_title'   => '</label>',
		)
	);
	register_sidebar(
		array(
			'name'          => 'Footer Column 4',
			'id'            => 'footer-4',
			'description'   => 'Add widgets here',
			'before_widget' => '<nav id="%1$s" class="widget %2$s">',
			'after_widget'  => '</nav>',
			'before_title'  => '<label class="footer-title">',
			'after_title'   => '</label>',
		)
	);
	register_sidebar(
		array(
			'name'          => 'Footer Column 5',
			'id'            => 'footer-5',
			'description'   => 'Add widgets here',
			'before_widget' => '<nav id="%1$s" class="widget %2$s">',
			'after_widget'  => '</nav>',
			'before_title'  => '<label class="footer-title">',
			'after_title'   => '</label>',
		)
	);
}
add_action( 'init', 'ct_register_sidebars' );


