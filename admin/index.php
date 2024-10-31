<div class="wrap">
	<div id="icon-edit" class="icon32 icon32-posts-slide"></div>
	<h2><?php _e('NV Slider Settings', 'ryans'); ?></h2>
	
	<?php
		global $wpdb, $nv;

		
		$nv->message();
	?>
	
	<div class="slider_settings_container">
		<?php
			// fetch data from database for update purposes.
			$nv_slider = $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}nv_slider" );
		?>
		
		<div class="plugin-settings">
			<form method="post">				
				<table border="0" cellspacing="2" cellpadding="2">
					<tr>
						<td><label for="effect">Effect</label></td>
						<td>
							<?php
								$poh = array(
									'random'			=> 'Random',
									'sliceDown'			=> 'Slice Down',
									'sliceDownLeft'		=> 'Slice Down Left',
									'sliceUp'			=> 'Slice Up',
									'sliceUpLeft'		=> 'Slice Up Left',
									'sliceUpDown'		=> 'Slice Up Down',
									'sliceUpDownLeft'	=> 'Slice Up Down Left',
									'fold'				=> 'Fold',
									'fade'				=> 'Fade',
									'slideInRight'		=> 'Slide In Right',
									'slideInLeft'		=> 'Slide In Left'
								);
							?>
							<select name="effect" id="effect">
								<option value="">&mdash; Select One &mdash;</option>
								<?php
									foreach( $poh as $key => $value ) {
										echo '<option value="'.$key.'" '.(isset($_POST['effect']) ? (($_POST['effect']==$key) ? 'selected="selected"' : '') : (($key==$nv_slider[0]->effect) ? 'selected="selected"' : '')).'>'.$value.'</option>';
									}
								?>
							</select>
						</td>
					</tr>
					<tr>
						<td><label for="animSpeed">Animation Speed</label></td>
						<td><input type="text" name="animSpeed" id="animSpeed" value="<?php echo (isset($_POST['animSpeed']) ? $_POST['animSpeed'] : $nv_slider[0]->animSpeed) ?>" /> <small>default: 1000</small></td>
					</tr>
					<tr>
						<td><label for="pauseTime">Pause Time</label></td>
						<td><input type="text" name="pauseTime" id="pauseTime" value="<?php echo (isset($_POST['pauseTime']) ? $_POST['pauseTime'] : $nv_slider[0]->pauseTime) ?>" /> <small>default: 5000</small></td>
					</tr>
					<tr>
						<td><label for="startSlide">Start Slide</label></td>
						<td><input type="text" name="startSlide" id="startSlide" value="<?php echo (isset($_POST['startSlide']) ? $_POST['startSlide'] : $nv_slider[0]->startSlide) ?>" /> <small>default: 0</small></td>
					</tr>
					<tr>
						<td><label for="directionNav">Direction Nav</label></td>
						<td>
							<?php
								$poh = array(
									'true'	=> 'True',
									'false'	=> 'False'
								);
							?>
							<select name="directionNav" id="directionNav">
								<option value="">&mdash; Select One &mdash;</option>
								<?php
									foreach( $poh as $key => $value ) {
										echo '<option value="'.$key.'" '.(isset($_POST['directionNav']) ? (($_POST['directionNav']==$key) ? 'selected="selected"' : '') : (($key==$nv_slider[0]->directionNav) ? 'selected="selected"' : '')).'>'.$value.'</option>';
									}
								?>
							</select>
						</td>
					</tr>
					<tr>
						<td><label for="controlNav">Control Nav</label></td>
						<td>
							<?php
								$poh = array(
									'true'	=> 'True',
									'false'	=> 'False'
								);
							?>
							<select name="controlNav" id="controlNav">
								<option value="">&mdash; Select One &mdash;</option>
								<?php
									foreach( $poh as $key => $value ) {
										echo '<option value="'.$key.'" '.(isset($_POST['controlNav']) ? (($_POST['controlNav']==$key) ? 'selected="selected"' : '') : (($key==$nv_slider[0]->controlNav) ? 'selected="selected"' : '')).'>'.$value.'</option>';
									}
								?>
							</select>
						</td>
					</tr>
					<tr>
						<td><label for="keyboardNav">Keyboard Nav</label></td>
						<td>
							<?php
								$poh = array(
									'true'	=> 'True',
									'false'	=> 'False'
								);
							?>
							<select name="keyboardNav" id="keyboardNav">
								<option value="">&mdash; Select One &mdash;</option>
								<?php
									foreach( $poh as $key => $value ) {
										echo '<option value="'.$key.'" '.(isset($_POST['keyboardNav']) ? (($_POST['keyboardNav']==$key) ? 'selected="selected"' : '') : (($key==$nv_slider[0]->keyboardNav) ? 'selected="selected"' : '')).'>'.$value.'</option>';
									}
								?>
							</select>
						</td>
					</tr>
					<tr>
						<td><label for="pauseOnHover">Pause On Hover</label></td>
						<td>
							<?php
								$poh = array(
									'true'	=> 'True',
									'false'	=> 'False'
								);
							?>
							<select name="pauseOnHover" id="pauseOnHover">
								<option value="">&mdash; Select One &mdash;</option>
								<?php
									foreach( $poh as $key => $value ) {
										echo '<option value="'.$key.'" '.(isset($_POST['pauseOnHover']) ? (($_POST['pauseOnHover']==$key) ? 'selected="selected"' : '') : (($key==$nv_slider[0]->pauseOnHover) ? 'selected="selected"' : '')).'>'.$value.'</option>';
									}
								?>
							</select>
						</td>
					</tr>
				</table>
				
				<input type="hidden" name="task" value="nv_slider_settings" />
				<p class="submit"><input type="submit" name="submit" id="submit" class="button-primary" value="Save Changes" /></p>
			</form>
		</div>
		<div class="plugin-notices">
			<p>Thanks for using <strong>NV Slider</strong> plugin by <a href="http://www.sutanaryan.com" target="_blank" title="Visit author website">Ryan Sutana</a>.</p>
			
			<h3>How to use?</h3>
			<p>Simply grab this shortcode <code>[nv_slider]</code> paste it in your post or page and you're good to go.</p>

			<h3>Another great plugin from this author.</h3>
			<ul>
				<li><a href="http://www.sutanaryan.com/freebies/plugins/wp-rslogin/" target="_blank">WP RSLogin</a> { a full jquery ajax login and forgot password }</li>
				<li><a href="http://www.sutanaryan.com/freebies/plugins/wp-nv_slider/" target="_blank">WP Panoramio</a> { a very simple plugin that dipslay best photos worldwide }</li>
			</ul>
			
			<div class="donate-box">
				<h3>Donate</h3>
				<p>You enjoy using this plugin? You can show your appreciation and support for future development by donating.</p>
				<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
					<input type="hidden" name="cmd" value="_s-xclick">
					<input type="hidden" name="hosted_button_id" value="7T2WPUR2F2BVL">
					<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
					<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
				</form>
			</div>
			
		</div>

		<div class="clear"></div>
	</div>
	
</div>