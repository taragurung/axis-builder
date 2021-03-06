<?php
/**
 * Animated Numbers Shortcode
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
 * AB_Shortcode_Animatednumbers Class
 */
class AB_Shortcode_Animatednumbers extends AB_Shortcode {

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
		$this->id        = 'axisbuilder_animatednumbers';
		$this->title     = __( 'Animated Numbers', 'axisbuilder' );
		$this->tooltip   = __( 'Display an Animated number with subtitle', 'axisbuilder' );
		$this->shortcode = array(
			'sort'    => 190,
			'type'    => 'content',
			'name'    => 'ab_animatednumbers',
			'icon'    => 'icon-animatednumbers',
			'image'   => AB()->plugin_url() . '/assets/images/content/animatednumbers.png', // Fallback if icon is missing :)
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
