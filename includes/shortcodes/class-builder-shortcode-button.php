<?php
/**
 * Button Shortcode
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
 * AB_Shortcode_Button Class
 */
class AB_Shortcode_Button extends AB_Shortcode {

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
		$this->id        = 'axisbuilder_button';
		$this->title     = __( 'Button', 'axisbuilder' );
		$this->tooltip   = __( 'Creates a colored button', 'axisbuilder' );
		$this->shortcode = array(
			'sort'    => 120,
			'type'    => 'content',
			'name'    => 'ab_button',
			'icon'    => 'icon-button',
			'image'   => AB()->plugin_url() . '/assets/images/content/button.png', // Fallback if icon is missing :)
			'target'  => 'axisbuilder-target-insert',
			'tinyMCE' => array( 'disable' => false ),
		);
	}

	/**
	* Popup Elements
	*
	* If this function is defined in a child class the element automatically gets an edit button, that, when pressed
	* opens a modal window that allows to edit the element properties
	*
	*/
	public function popup_elements(){
			$this->elements = array(

			array(
					'type' 	=> 'open_tab', 'nodescription' => true
				),

			array(
					'type' 	=> 'tab',
					'name'  => __('Content' , 'axisbuilder'),
					'nodescription' => true
				),

			array(	'name' 	=> __('Button Label', 'axisbuilder' ),
					'desc' 	=> __('This is the text that appears on your button.', 'axisbuilder' ),
			        'id' 	=> 'label',
			        'type' 	=> 'input',
			        'std' => __('Click me', 'axisbuilder' )),
			//array(
			//		'name' 	=> __('Button Link?', 'axisbuilder' ),
			//		'desc' 	=> __('Where should your button link to?', 'axisbuilder' ),
			//		'id' 	=> 'link',
			//		'type' 	=> 'linkpicker',
			//		'fetchTMPL'	=> true,
			//		'subtype' => array(
			//				__('Set Manually', 'axisbuilder' ) =>'manually',
			//				__('Single Entry', 'axisbuilder' ) =>'single',
			//				__('Taxonomy Overview Page',  'axisbuilder' )=>'taxonomy',
			//						  ),
			//		'std' 	=> ''),

			array(
					'name' 	=> __('Open Link in new Window?', 'axisbuilder' ),
					'desc' 	=> __('Select here if you want to open the linked page in a new window', 'axisbuilder' ),
					'id' 	=> 'link_target',
					'type' 	=> 'select',
					'std' 	=> '',
					'subtype' => axisbuilder_num_to_array()),


			array(
					'name' 	=> __('Button Size', 'axisbuilder' ),
					'desc' 	=> __('Choose the size of your button here', 'axisbuilder' ),
					'id' 	=> 'size',
					'type' 	=> 'select',
					'std' 	=> 'small',
					'subtype' => array(
						__('Small',   'axisbuilder' ) =>'small',
						__('Medium',  'axisbuilder' ) =>'medium',
						__('Large',   'axisbuilder' ) =>'large',
						__('X Large',   'axisbuilder' ) =>'x-large',
					)),

			array(
					'name' 	=> __('Button Position', 'axisbuilder' ),
					'desc' 	=> __('Choose the alignment of your button here', 'axisbuilder' ),
					'id' 	=> 'position',
					'type' 	=> 'select',
					'std' 	=> 'center',
					'subtype' => array(
						__('Align Left',   'axisbuilder' ) =>'left',
						__('Align Center',  'axisbuilder' ) =>'center',
						__('Align Right',   'axisbuilder' ) =>'right',
					)),
			array(
					'name' 	=> __('Button Icon', 'axisbuilder' ),
					'desc' 	=> __('Should an icon be displayed at the left side of the button', 'axisbuilder' ),
					'id' 	=> 'icon_select',
					'type' 	=> 'select',
					'std' 	=> 'yes',
					'subtype' => array(
						__('No Icon',  'axisbuilder' ) =>'no',
						__('Yes, display Icon to the left',  'axisbuilder' ) => 'yes' ,
						__('Yes, display Icon to the right',  'axisbuilder' ) =>'yes-right-icon',
						)),
			array(
					'name' 	=> __('Icon Visibility','axisbuilder' ),
					'desc' 	=> __('Check to only display icon on hover','axisbuilder' ),
					'id' 	=> 'icon_hover',
					'type' 	=> 'checkbox',
					'std' 	=> '',
					'required' => array('icon_select','not_empty_and','no')
					),
			//array(
			//		'name' 	=> __('Button Icon','axisbuilder' ),
			//		'desc' 	=> __('Select an icon for your Button below','axisbuilder' ),
			//		'id' 	=> 'icon',
			//		'type' 	=> 'iconfont',
			//		'std' 	=> '',
			//		'required' => array('icon_select','not_empty_and','no')
			//		),
			array(
					'type' 	=> 'close_div',
					'nodescription' => true
				),

			array(
					'type' 	=> 'tab',
					'name'	=> __('Colors','axisbuilder' ),
					'nodescription' => true
				),

			array(
					'name' 	=> __('Button Color', 'axisbuilder' ),
					'desc' 	=> __('Choose a color for your button here', 'axisbuilder' ),
					'id' 	=> 'color',
					'type' 	=> 'select',
					'std' 	=> 'theme-color',
					'subtype' => array(
						__('Translucent Buttons', 'axisbuilder' ) => array(
						__('Light Transparent', 'axisbuilder' )=>'light',
						__('Dark Transparent', 'axisbuilder' )=>'dark',
					),

						__('Colored Buttons', 'axisbuilder' ) => array(
						__('Theme Color', 'axisbuilder' )=>'theme-color',
						__('Theme Color Subtle', 'axisbuilder' )=>'theme-color-subtle',
						__('Blue', 'axisbuilder' )=>'blue',
						__('Red',  'axisbuilder' )=>'red',
						__('Green', 'axisbuilder' )=>'green',
						__('Orange', 'axisbuilder' )=>'orange',
						__('Aqua', 'axisbuilder' )=>'aqua',
						__('Teal', 'axisbuilder' )=>'teal',
						__('Purple', 'axisbuilder' )=>'purple',
						__('Pink', 'axisbuilder' )=>'pink',
						__('Silver', 'axisbuilder' )=>'silver',
						__('Grey', 'axisbuilder' )=>'grey',
						__('Black', 'axisbuilder' )=>'black',
						__('Custom Color', 'axisbuilder' )=>'custom',
						)),
						),


			array(
					'name' 	=> __('Custom Background Color', 'axisbuilder' ),
					'desc' 	=> __('Select a custom background color for your Button here', 'axisbuilder' ),
					'id' 	=> 'custom_bg',
					'type' 	=> 'colorpicker',
					'std' 	=> '#444444',
					'required' => array('color','equals','custom')
				),

			array(
					'name' 	=> __('Custom Font Color', 'axisbuilder' ),
					'desc' 	=> __('Select a custom font color for your Button here', 'axisbuilder' ),
					'id' 	=> 'custom_font',
					'type' 	=> 'colorpicker',
					'std' 	=> '#ffffff',
					'required' => array('color','equals','custom')
				),

			array(
					'type' 	=> 'close_div',
					'nodescription' => true
				),

			array(
					'type' 	=> 'close_div',
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
