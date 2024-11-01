<?php

/*
Plugin Name: Stylinity Deals Widget
Author: Katherine Eisenbrand
Version: 1
*/

class stylinity_deals_widget extends WP_Widget {
		
	// constructor
	function __construct() {
		// Give widget name here
		parent::__construct(
			'stylinity_deals_widget', 
			__('Stylinight Deals Widget', 'stylinity_text_domain'), 
			array('description' => __('Widget that displays coupons for your favorite brands', 'stylinity_text_domain'),)
		);
	}

	// front-end widget display
	public function widget($args, $instance) {
		$title = apply_filters('widget_title', $instance['title']);
		echo $args['before_widget'];
		if (!empty($title)) {
			echo $args['before_title'].$title. $args['after_title'];
		}
		$widgetId=uniqid();
	
		$useLooksLocal = "false";
		if ($instance['useLooks']!="" & $instance['useLooks']!="false")
		{
			$useLooksLocal ="true";
		}
		$hidebuttonsLocal = "false";
		if ($instance['hidebuttonsLocal']=="1" )
		{
			$hidebuttonsLocal ="true";
		}
		
		
		echo ("<div id=\"" . $widgetId . "\"></div style=\"width: ".$instance['width']."\"><script>dealParams=null; dealParams = {\"username\": \"" . $instance['username'] .  "\",\"chainIds\":\"".$instance['hiddenBrands'] ."\",\"hideButtons\":\"".hidebuttonsLocal."\",\"speed\":\"". $instance['speed']."\",\"width\":\"".$instance['width']."\",\"useLooks\":\"".$useLooksLocal."\" };stylinitycreateDealsWidget(dealParams);dealParams=null;</script>");
		echo $args['after_widget'];
	}

	
	// back-end widget form
	public function form($instance) {
		if (isset($instance['title'])) {
			$title = $instance['title'];
		} else {
			$title = __('My favorite brands:', 'stylinity_text_domain');
		}
		if (isset($instance['username'])) {
			$username = $instance['username'];
		} else {
			$username = __('', 'stylinity_text_domain');
		}
		if (isset($instance['width'])) {
			$width = $instance['width'];
		} else {
			$width = __('', 'stylinity_text_domain');
		}
		if (isset($instance['hiddenBrands'])) {
			$hiddenBrands = $instance['hiddenBrands'];
		} else {
			$hiddenBrands = __('', 'stylinity_text_domain');
		}
		if (isset($instance['speed'])) {
			$speed = $instance['speed'];
		} else {
			$speed = __('1000', 'stylinity_text_domain');
		}
		if (isset($instance['hidebuttons'])) {
			$hidebuttons = $instance['hidebuttons'];
		} else {
			$hidebuttons = __(0, 'stylinity_text_domain');
		}
		
		if (isset($instance['brands'])) {
			$brands = $instance['brands'];
		} else {
			$brands = __('', 'stylinity_text_domain');
		}
		if (isset($instance['useLooks'])) {
			$useLooks = $instance['useLooks'];
		} else {
			$useLooks = __(0, 'stylinity_text_domain');
		}
		if (isset($instance['theme'])) {
			$theme = $instance['theme'];
		} else {
			$theme = __('', 'stylinity_text_domain');
		}
		if (isset($instance['brands_id'])) {
			$brands_id = $instance['brands_id'];
		} else {
			$brands_id = __('', 'stylinity_text_domain');
		}
		

		?>
		<style>
			.chosen-select {
				width: 100% !important;
			}
		</style>
	    <input class="hideBrand" type="hidden" name="<?php echo $this ->get_field_name( 'hiddenBrands' ); ?>" id="<?php echo $this->get_field_id( 'hiddenBrands' ); ?>"   value="<?php echo esc_attr( $hiddenBrands ); ?>" /> 
		<?php 	if (isset($instance['hiddenBrands'])) { ?>
		<input class="hideBrand2" type="hidden"   value="<?php echo esc_attr( $hiddenBrands ); ?>" /> 
		<?php 	}  ?>
		<p>
			<label for = "<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Widget title:' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this ->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>"> 
		</p>
		<p>
			<label for = "<?php echo $this->get_field_id( 'username' ); ?>"><?php _e( 'Username:' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'username' ); ?>" name="<?php echo $this ->get_field_name( 'username' ); ?>" type="text" value="<?php echo esc_attr( $username ); ?>"> 
		</p>
		<p>
			<label for = "<?php echo $this->get_field_id( 'theme' ); ?>"><?php _e( 'Theme:' ); ?></label>
			<select class="widefat" id="<?php echo $this->get_field_id( 'theme' ); ?>" name="<?php echo $this ->get_field_name( 'theme' ); ?>" type="text" >
				<option value=""  <?php if ( $instance['theme'] == "" ) echo 'selected="selected"'; ?>>Chic</option><option value="2"  <?php if ( $instance['theme'] == "2" ) echo 'selected="selected"'; ?>>Plain Jane</option>
			</select>			
		</p>
		<p>
			<label for = "<?php echo $this->get_field_id( 'width' ); ?>"><?php _e( 'Width:' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'width' ); ?>" name="<?php echo $this ->get_field_name( 'width' ); ?>" type="text" value="<?php echo esc_attr( $width ); ?>"> 
		</p>
		<p>
			<label for = "<?php echo $this->get_field_id( 'speed' ); ?>"><?php _e( 'Speed (ms):' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'speed' ); ?>" name="<?php echo $this ->get_field_name( 'speed' ); ?>" type="text" value="<?php echo esc_attr( $speed ); ?>"> 
		</p>
		<p>
			<label for = "<?php echo $this->get_field_id('hidebuttons'); ?>"><?php _e('Hide Buttons'); ?></label>
			<input type="checkbox" id="<?php echo $this->get_field_id( 'hidebuttons' ); ?>" name="<?php echo $this ->get_field_name( 'hidebuttons' ); ?>" value="1" <?php if ( $instance['hidebuttons'] == "1" ) echo 'checked'; ?> />
		</p>
		<p>
			<label for = "<?php echo $this->get_field_id( 'brands' ); ?>"><?php _e( 'Brands:' ); ?></label>
			<select multiple class="chosen-select" id="<?php echo $this->get_field_id( 'brands' ); ?>" style="width:95%" value="<?php echo esc_attr( $brands ); ?>"  multiple="true" onchange="jQuery('.hideBrand').val(jQuery(this).val());" ></select>
		</p>
		<p>
			<label for = "<?php echo $this->get_field_id('useLooks'); ?>"><?php _e('Use my looks'); ?></label>
			<input type="checkbox" id="<?php echo $this->get_field_id( 'useLooks' ); ?>" name="<?php echo $this ->get_field_name( 'useLooks' ); ?>" value="1" <?php if ( $instance['useLooks'] == "1" ) echo 'checked'; ?>/>
		</p>

	
		
		<?php
	}
	

	public function update($new_instance, $old_instance) {
		$instance = $old_instance;
		
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['speed'] = strip_tags($new_instance['speed']);
		$instance['hidebuttons'] = strip_tags($new_instance['hidebuttons']);
		$instance['username'] = strip_tags($new_instance['username']);
		$instance['theme'] = strip_tags($new_instance['theme']);
		$instance['width'] = strip_tags($new_instance['width']);
		$instance['brands'] = strip_tags($new_instance['brands']);
		$instance['hiddenBrands'] = strip_tags($new_instance['hiddenBrands']);
		$instance['brands_id'] = strip_tags($new_instance['brands_id']);
		$instance['useLooks'] = strip_tags($new_instance['useLooks']);
		return $instance;
	}
}

function stylinity_widget_deals_js() {
	wp_enqueue_script('jquery');
	wp_enqueue_script( 'StylinityDealsWidgetFrontEnd', 'https://stylinitycdn.blob.core.windows.net/scripts/StylinityDealsWidgetFrontEnd.js');
	wp_register_script('StylinityDealsWidgetFrontEnd', 'https://stylinitycdn.blob.core.windows.net/scripts/StylinityDealsWidgetFrontEnd.js');
	
}
add_action( 'wp_enqueue_scripts', 'stylinity_widget_deals_js' );

function stylinity_admin_deals_js() {
	wp_enqueue_script ('jquery');
	wp_enqueue_style( 'selectize-style', 'https://stylinitycdn.blob.core.windows.net/scripts/selectize.css' );
	wp_enqueue_script('selectize-js', 'https://stylinitycdn.blob.core.windows.net/scripts/selectize.min.js',"",false,false);
	wp_register_script( "StylinityDealsWidget", 'https://stylinitycdn.blob.core.windows.net/scripts/StylinityDealsWidget.js', array('jquery') );
	wp_localize_script( 'StylinityDealsWidget', 'myAjax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' )));        
	wp_enqueue_script( 'StylinityDealsWidget', 'https://stylinitycdn.blob.core.windows.net/scripts/StylinityDealsWidget.js', array('jquery', 'jquery-ui-autocomplete'), false, false);

}
add_action( 'admin_enqueue_scripts', 'stylinity_admin_deals_js' );

function stylinity_load_deals_widget() {
	register_widget('stylinity_deals_widget');
}
// Register and load widget
add_action('widgets_init', 'stylinity_load_deals_widget');
?>
