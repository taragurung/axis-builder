<?php
/**
 * Icon Box Shortcode
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
 * AB_Shortcode_Iconbox Class
 */
class AB_Shortcode_Iconbox extends AB_Shortcode {

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
		$this->id        = 'axisbuilder_iconbox';
		$this->title     = __( 'Icon Box', 'axisbuilder' );
		$this->tooltip   = __( 'Creates a content box with icon', 'axisbuilder' );
		$this->shortcode = array(
			'sort'    => 140,
			'type'    => 'content',
			'name'    => 'ab_iconbox',
			'icon'    => 'icon-iconbox',
			'image'   => AB()->plugin_url() . '/assets/images/content/iconbox.png', // Fallback if icon is missing :)
			'target'  => 'axisbuilder-target-insert',
			'tinymce' => array( 'disable' => true ),
		);
	}
}
