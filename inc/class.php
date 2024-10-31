<?php

$nv = new NV_Slider( $_POST );
class NV_Slider 
{
	var $_class = '';
	var $message = '';
	
	function __construct( $post )
	{
		if(!isset($_POST['task'])) { return false; }
		if(isset($post)) { $p = $this->addslashers( $post ); }
		
		switch($p['task']) {
			
			case "nv_slider_settings": $this->nv_slider_settings($p); break;
			
			default: break;
		}
	} 
	
	function nv_slider_settings($p) {
		global $wpdb;
		
		// get posted data
		$effect 		= $p['effect'];
		$animSpeed 		= $p['animSpeed'];
		$pauseTime 		= $p['pauseTime'];
		$startSlide 	= $p['startSlide'];
		$directionNav 	= $p['directionNav'];
		$controlNav 	= $p['controlNav'];
		$keyboardNav 	= $p['keyboardNav'];
		$pauseOnHover 	= $p['pauseOnHover'];

		
		//filtered inputted data
		if( $effect == "" ) {
			$this->_class = 'error';
			$this->message = 'Fields marked with (*) are requireds.';
		} else {
			
			//save data
			$wp_qry = $wpdb->update(
				"{$wpdb->prefix}nv_slider",
				array(
					'effect'		=> $effect,
					'animSpeed'		=> $animSpeed,
					'pauseTime'		=> $pauseTime,
					'startSlide'	=> $startSlide,
					'directionNav'	=> $directionNav,
					'controlNav'	=> $controlNav,
					'keyboardNav'	=> $keyboardNav,
					'pauseOnHover'	=> $pauseOnHover
				), 
				array( 'ID' => 1 )
			);
			
			if( $wp_qry ) {
				$this->_class = 'updated';
				$this->message = 'Settings successfully saved.';
			} else {
				$this->_class = 'error';
				$this->message = 'No changes has been made.';
			}
		}
	}
	
	function message()
	{
		if( $this->message != "") {
			echo '<div id="setting-error-settings_updated" class="'.$this->_class.'"><p>'.$this->message.'</p></div>';
		}

	}
	
	function addslashers($post)
	{
		foreach($post as $key => $value) {
			if( is_array($value) ) {
				$p[$key] = $value;
			} else {
				$p[$key] = addslashes($value);
			}
		}
		
		return $p;
	}

}

?>