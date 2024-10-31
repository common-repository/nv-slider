<?php

add_action( 'add_meta_boxes', 'nv_slider_metaboxes' );
add_action( 'save_post', 'nv_slider_save_posts', 1, 2 );

/*
 * @desc	Add Testimonials metaboxes
 */
function nv_slider_metaboxes() {
	add_meta_box(
		'nv-slider-meta',							// Unique ID
		esc_html__( 'Slider Info', PLUGIN_DOMAIN ),	// Title
		'nv_slider_metabox',						// callback function nv_slider_metabox()				
		'nv-slider', 								// 'post', 'page', 'link', or 'custom_post_type'						
		'normal', 									// 'normal', 'advanced', or 'side'
		'default'  									// 'high', 'core', 'default' or 'low'								
	);
}


/*
 * @desc	Display the post metabox forms
 */
function nv_slider_metabox( $object, $box )
{ 
	global $post;

	echo '<input type="hidden" name="titan_tracks_nonce" id="titan_tracks_nonce" value="' .wp_create_nonce( plugin_basename(__FILE__) ) . '" />';

	$custom_url = get_post_meta( $post->ID, 'nv_slider_custom_url', true );
	?>
	<p><em>Add custom slider url here.</em></p>
	<p>
		<label for="nv_slider_custom_url"><strong><?php _e( 'Custom url', PLUGIN_DOMAIN ) ?>:</strong></label>
		<input type="text" id="nv_slider_custom_url" name="nv_slider_custom_url" value="<?php echo $custom_url; ?>" class="widefat" />
	</p>
	<?php
}


/*
 * @desc	Save the metabox data
 */
function nv_slider_save_posts( $post_id, $post ) 
{
	global $short_name, $meta_box;;
	
	// verify nonce
	$titan_tracks = isset( $_POST['titan_tracks_nonce'] ) ? $_POST['titan_tracks_nonce'] : '';
	if ( !wp_verify_nonce( $titan_tracks, plugin_basename(__FILE__) )) {
		return $post->ID;
	}
	
	// check autosave
    if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE )
        return $post_id;

	if ( !current_user_can( 'edit_post', $post->ID ))
		return $post->ID;
		
	$ttl_meta['nv_slider_custom_url'] = $_POST['nv_slider_custom_url'];
	
	foreach ( $ttl_meta as $key => $value ) 
	{
		if( $post->post_type == 'revision' )
			return;
		
		$value = implode(',', (array)$value);
		if( get_post_meta($post->ID, $key, FALSE) ) {
			// If the custom field already has a value
			update_post_meta( $post->ID, $key, $value );
		} else {	
			// If the custom field doesn't have a value
			add_post_meta( $post->ID, $key, $value );
		}
		
		if( !$value )
			delete_post_meta( $post->ID, $key );
	}
}
?>