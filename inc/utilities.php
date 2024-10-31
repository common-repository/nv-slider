<?php

add_filter( 'widget_text', 'do_shortcode' );


/**
 * @desc	Update wordpress default messages
 */
function updated_messages( $msg ){
	global $post, $post_ID;
	
	$text_domain = PLUGIN_DOMAIN;
	
	$msg['nv-slider'] = array(
		0 => '', //unused. Messages start at index 1.
		1 => __('Slider updated.', $text_domain),
		2 => __('Custom field updated.'),
		3 => __('Custom field deleted.'),
		4 => __('Slider updated.'),
		/* translators: %s: date and time of the revision */
		5 => isset($_GET['revision']) ? sprintf( __('Slider data restored to revision from %s'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
		6 => sprintf( __('New slider created.'), esc_url( get_permalink($post_ID) ) ),
		7 => __('Slider saved.'),
		8 => __('Slider submitted.', $text_domain),
		9 => sprintf( __('Product Page scheduled for: <strong>%1$s</strong>.', $text_domain),
			// translators: Publish box date format, see http://php.net/date
			date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ) ),
		10 => __('Slider draft updated.', $text_domain )
	);
	
	return $msg;
}
add_filter( 'post_updated_messages', 'updated_messages' );


function post_type_title( $title ){
	if( 'nv-slider' == get_post_type() ){
		return 'Enter slider title here';
	} else {
		return $title;
	}
}
add_filter( 'enter_title_here', 'post_type_title' );


function nv_slider_edit_movie_columns( $columns ) {

	$columns = array(
		'cb' 		=> '<input type="checkbox" />',
		'thumbnail' => __( 'Thumbnail' ),
		'title' 	=> __( 'Title' ),
		'date' 		=> __( 'Date' )
	);

	return $columns;
}
add_filter( 'manage_edit-nv-slider_columns', 'nv_slider_edit_movie_columns' ) ;


function nv_slider_manage_movie_columns( $column, $post_id ) {
	global $post;

	switch( $column ) {

		/* If displaying the 'duration' column. */
		case 'thumbnail' :

			echo get_the_post_thumbnail( $post_id, array(80, 80) );

		break;

		/* Just break out of the switch statement for everything else. */
		default :
		break;
	}
}
add_action( 'manage_nv-slider_posts_custom_column', 'nv_slider_manage_movie_columns', 10, 2 );