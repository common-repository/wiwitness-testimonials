<?php

/*

	Plugin Name: Wiwitness Testimonials
	Plugin URI: http://www.wiwitness.com
	Description: Wiwitness is quite possibly the best way to display verifiable testimonials on your website. It keeps your in-site reputation high with your visitors. To get started: 1) Click the "Activate" link to the left of this description, 2) Sign up with <a href="http://www.wiwitness.com"  target="_blank">Wiwitness</a> and get Wiwitness widget keys, and 3) create and diplay testimonial widgets on your website using Wiwitness widget keys.

	Author: Wiwitness
	Version: 1.0.0
	Author URI: http://wordpress.wiwitness.com
	License: GPLv2 or later
	*/
/*
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
*/

function wiwi_create_shortcode( $atts, $content=null ) {
	extract(shortcode_atts(array('id'=>''), $atts));

	return 	'<div id="'.$id.'"></div>
		<script src="http://www.wiwitness.com/wjs/'.$id.'"></script>';

}


add_shortcode('wiwitness', 'wiwi_create_shortcode');

// widget

class WiwitnessWidget extends WP_Widget {
	
	function WiwitnessWidget() {
		$widget_options = array(
		'classname'		=>		'wiwitness-widget',
		'description' 	=>		'Widget which displays verifiable testimonials on your website.'
		);
		
		parent::WP_Widget('wiwitness-widget', 'Wiwitness Testimonials', $widget_options);
	}
	
	function widget($args, $atts) {
		extract($args, EXTR_SKIP);

		extract($atts);
		
		?>
		<?php echo $before_widget; ?>
		<?php echo '<div id="'.$atts['id'].'"></div>
		<script src="http://www.wiwitness.com/wjs/'.$atts['id'].'"></script>';?>
		<?php echo $after_widget; ?>
		<?php 
	}

	function update($new, $old) {
		return $new;
	}
	
	function form($instance) {

		$i = extract($instance);

		?>
		<p>	 It is very easy  to start displaying verifiable testimonials on your website.
         <ul> <li>Sign up with <a href="http://www.wiwitness.com"  target="_blank">Wiwitness</a> and get Wiwitness widget key</li></ul></p>

		<p><label for="<?php echo $this->get_field_id('id')?>">
		Wiwitness widget key
		<input id="<?php echo $this->get_field_id('id')?>" 
		name="<?php echo $this->get_field_name('id')?>"
		value="<?php echo $instance['id'];?>" size=10 />
		</label></p>
		<?php 
	}
}

function wiwitness_widget_init() {
	register_widget('WiwitnessWidget');
}
add_action('widgets_init', 'wiwitness_widget_init');
