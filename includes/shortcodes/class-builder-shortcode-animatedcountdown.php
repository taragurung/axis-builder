<?php
/**
 * Animated Countdown Shortcode
 *
 * @extends     AB_Shortcode
 * @package     AxisBuilder/Shortcodes
 * @category    Shortcodes
 * @author      AxisThemes
 * @since       1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * AB_Shortcode_Animatedcountdown Class
 */
class AB_Shortcode_Animatedcountdown extends AB_Shortcode {

	/**
	 * Class Constructor Method.
	 */
	public function __construct() {
		parent::__construct();
	}

	/**
	 * Configuration for builder shortcode button.
	 */
	public function shortcode_button() {
		$this->id        = 'axisbuilder_animatedcountdown';
		$this->title     = __( 'Animated Countdown', 'axisbuilder' );
		$this->tooltip   = __( 'Display an count down to a specific date', 'axisbuilder' );
		$this->shortcode = array(
			'sort'    => 210,
			'type'    => 'content',
			'name'    => 'ab_animatedcountdown',
			'icon'    => 'icon-animatedcountdown',
			'image'   => AB()->plugin_url() . '/assets/images/content/animatedcountdown.png', // Fallback if icon is missing :)
			'target'  => 'axisbuilder-target-insert',
			'tinyMCE' => array( 'disable' => true ),
		);
	}

			/**
			 * Popup Elements
			 *
			 * If this function is defined in a child class the element automatically gets an edit button, that, when pressed
			 * opens a modal window that allows to edit the element properties
			 *
			 */
			function popup_elements(){
				$this->elements = array(
					array(
							"type" 	=> "open_tab", 'nodescription' => true
						),

					array(
							"type" 	=> "tab",
							"name"  => __("Content" , 'axisbuilder'),
							'nodescription' => true
						),


				//	array(
				//			"name" 	=> __("Date",'axisbuilder' ),
				//			"desc" 	=> __("Pick a date in the future.",'axisbuilder' ),
				//			"id" 	=> "date",
				//			"type" 	=> "datepicker",
				//			"container_class" => 'ab_third ab_third_first',
				//			"std" 	=> ""),

					array(
							"name" 	=> __("Hour", 'axisbuilder' ),
							"desc" 	=> __("Pick the hour of the day", 'axisbuilder' ),
							"id" 	=> "hour",
							"type" 	=> "select",
							"std" 	=> "12",
							"container_class" => 'av_third',
							"subtype" => axisbuilder_num_to_array(0,23,1,array(),' h')),

					array(
							"name" 	=> __("Minute", 'axisbuilder' ),
							"desc" 	=> __("Pick the minute of the hour", 'axisbuilder' ),
							"id" 	=> "minute",
							"type" 	=> "select",
							"std" 	=> "0",
							"container_class" => 'av_third',
							"subtype" => axisbuilder_num_to_array(0,59,1,array(),' min')),


					array(
							"name" 	=> __("Smallest time unit", 'axisbuilder' ),
							"desc" 	=> __("The smallest unit that will be displayed", 'axisbuilder' ),
							"id" 	=> "min",
							"type" 	=> "select",
							"std" 	=> "1",
							"subtype" => $this->time_array),


					array(
							"name" 	=> __("Largest time unit", 'axisbuilder' ),
							"desc" 	=> __("The largest unit that will be displayed", 'axisbuilder' ),
							"id" 	=> "max",
							"type" 	=> "select",
							"std" 	=> "5",
							"subtype" => $this->time_array),




					array(
							"name" 	=> __("Text Alignment", 'axisbuilder' ),
							"desc" 	=> __("Choose here, how to align your text", 'axisbuilder' ),
							"id" 	=> "align",
							"type" 	=> "select",
							"std" 	=> "center",
							"subtype" => array(
												__('Center',  'axisbuilder' ) =>'av-align-center',
												__('Right',  'axisbuilder' ) =>'av-align-right',
												__('Left',  'axisbuilder' ) =>'av-align-left',
												)
							),

					array(	"name" 	=> __("Number Font Size", 'axisbuilder' ),
							"desc" 	=> __("Size of your numbers in Pixel", 'axisbuilder' ),
				            "id" 	=> "size",
				            "type" 	=> "select",
				            "subtype" => axisbuilder_num_to_array(20,90,1, array( __("Default Size", 'axisbuilder' )=>'')),
				            "std" => ""),

				   array(
							"type" 	=> "close_div",
							'nodescription' => true
						),

					array(
							"type" 	=> "tab",
							"name"	=> __("Colors",'axisbuilder' ),
							'nodescription' => true
						),

				   array(
							"name" 	=> __("Colors", 'axisbuilder' ),
							"desc" 	=> __("Choose the colors here", 'axisbuilder' ),
							"id" 	=> "style",
							"type" 	=> "select",
							"std" 	=> "center",
							"subtype" => array(
												__('Default',	'axisbuilder' ) 	=>'av-default-style',
												__('Theme colors',	'axisbuilder' ) 	=>'av-colored-style',
												__('Transparent Light', 'axisbuilder' ) 	=>'av-trans-light-style',
												__('Transparent Dark',  'axisbuilder' )  =>'av-trans-dark-style',
												)
							),
					array(
							"type" 	=> "close_div",
							'nodescription' => true
						),

					array(
							"type" 	=> "close_div",
							'nodescription' => true
						),
				);

			}

	/**
	 * Frontend Shortcode Handle.
	 * @param  array  $atts      Array of attributes.
	 * @param  string $content   Text within enclosing form of shortcode element.
	 * @param  string $shortcode The shortcode found, when == callback name.
	 * @param  string $meta      Meta data.
	 * @return string            Returns the modified html string.
	 */
	public function shortcode_handle( $atts, $content = '', $shortcode = '', $meta = '' ) {

	}
}
