<?php
/**
 * Separator Shortcode
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
 * AB_Shortcode_Separator Class
 */
class AB_Shortcode_Separator extends AB_Shortcode {

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
		$this->id        = 'axisbuilder_separator';
		$this->title     = __( 'Separator / Whitespace', 'axisbuilder' );
		$this->tooltip   = __( 'Creates a delimiter/whitespace to separate elements', 'axisbuilder' );
		$this->shortcode = array(
			'sort'    => 70,
			'type'    => 'content',
			'name'    => 'ab_separator',
			'icon'    => 'icon-separator',
			'image'   => AB()->plugin_url() . '/assets/images/content/separator.png', // Fallback if icon is missing :)
			'target'  => 'axisbuilder-target-insert',
			'tinyMCE' => array( 'disable' => true ),
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
