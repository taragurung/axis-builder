<?php
/**
 * Cells Shortcode
 *
 * Note: Main AB_Shortcode_Cells is extended for different class for ease.
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
 * AB_Shortcode_Cells Class
 */
class AB_Shortcode_Cells extends AB_Shortcode {

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
		$this->id        = 'axisbuilder_cell_one_full';
		$this->title     = __( '1/1', 'axisbuilder' );
		$this->tooltip   = __( 'Creates a single column with full width', 'axisbuilder' );
		$this->shortcode = array(
			'sort'        => 13,
			'type'        => 'layout',
			'name'        => 'ab_cell_one_full',
			'icon'        => 'icon-one-full',
			'image'       => AB()->plugin_url() . '/assets/images/layouts/columns/one-full.png', // Fallback if icon is missing :)
			'target'      => 'axisbuilder-section-drop',
			'tinymce'     => array( 'disable' => true ),
			'drag-level'  => 2,
			'drop-level'  => 1,
			'html-render' => false,
			'invisible'   => true
		);
	}

	/**
	 * Editor Elements.
	 *
	 * This method defines the visual appearance of an element on the Builder canvas.
	 */
	public function editor_element( $params ) {
		extract( $params );

		$size = array(
			'ab_cell_one_full'     => '1/1',
			'ab_cell_one_half'     => '1/2',
			'ab_cell_one_third'    => '1/3',
			'ab_cell_two_third'    => '2/3',
			'ab_cell_one_fourth'   => '1/4',
			'ab_cell_three_fourth' => '3/4',
			'ab_cell_one_fifth'    => '1/5',
			'ab_cell_two_fifth'    => '2/5',
			'ab_cell_three_fifth'  => '3/5',
			'ab_cell_four_fifth'   => '4/5',
		);

		$data['width']             = $this->shortcode['name'];
		$data['modal-title']       = $this->title;
		$data['modal-action']      = $this->shortcode['name'];
		$data['dragdrop-level']    = $this->shortcode['drag-level'];
		$data['shortcode-handler'] = $this->shortcode['name'];
		$data['shortcode-allowed'] = $this->shortcode['name'];

		$output = '<div class="axisbuilder-layout-column axisbuilder-layout-cell popup-animation axisbuilder-no-visual-updates axisbuilder-drag ' . $this->shortcode['name'] . '"' . axisbuilder_html_data_string( $data ) . '>';
			$output .= '<div class="axisbuilder-sorthandle">';
				$output .= '<span class="axisbuilder-column-size">' . $size[ $this->shortcode['name'] ] . '</span>';
				if ( isset( $this->shortcode['popup_editor'] ) ) {
					$output .= '<a class="axisbuilder-edit edit-element-icon" href="#edit" title="' . __( 'Edit Cell', 'axisbuilder' ) . '">' . __( 'Edit Cell', 'axisbuilder' ) . '</a>';
				}
				$output .= '<a class="axisbuilder-trash trash-element-icon" href="#trash" title="' . __( 'Delete Cell', 'axisbuilder' ) . '">' . __( 'Delete Cell', 'axisbuilder' ) . '</a>';
				$output .= '<a class="axisbuilder-clone clone-element-icon" href="#clone" title="' . __( 'Clone Cell',  'axisbuilder' ) . '">' . __( 'Clone Cell',  'axisbuilder' ) . '</a>';
			$output .= '</div>';
			$output .= '<div class="axisbuilder-inner-shortcode axisbuilder-connect-sort axisbuilder-drop" data-dragdrop-level="' . $this->shortcode['drop-level'] . '">';
				$output .= '<span class="axisbuilder-fake-cellborder"></span>';
				$output .= '<textarea data-name="text-shortcode" rows="4" cols="20">' . ab_create_shortcode_data( $this->shortcode['name'], $content, $args ) . '</textarea>';
				if ( $content ) {
					$content = do_shortcode_builder( $content );
					$output .= $content;
				}
			$output .= '</div>';
		$output .= '</div>';

		return $output;
	}
}

/**
 * AB_Shortcode_Columns_One_Half Class
 */
class AB_Shortcode_Cells_One_Half extends AB_Shortcode_Cells {

	/**
	 * Configuration for builder shortcode button.
	 */
	public function shortcode_button() {
		$this->id        = 'axisbuilder_cell_one_half';
		$this->title     = __( '1/2', 'axisbuilder' );
		$this->tooltip   = __( 'Creates a single column with 50&percnt; width', 'axisbuilder' );
		$this->shortcode = array(
			'sort'        => 14,
			'type'        => 'layout',
			'name'        => 'ab_cell_one_half',
			'icon'        => 'icon-one-half',
			'image'       => AB()->plugin_url() . '/assets/images/layouts/columns/one-half.png', // Fallback if icon is missing :)
			'target'      => 'axisbuilder-section-drop',
			'tinymce'     => array( 'disable' => true ),
			'drag-level'  => 2,
			'drop-level'  => 1,
			'html-render' => false,
			'invisible'   => true
		);
	}
}

/**
 * AB_Shortcode_Columns_One_Third Class
 */
class AB_Shortcode_Cells_One_Third extends AB_Shortcode_Cells {

	/**
	 * Configuration for builder shortcode button.
	 */
	public function shortcode_button() {
		$this->id        = 'axisbuilder_cell_one_third';
		$this->title     = __( '1/3', 'axisbuilder' );
		$this->tooltip   = __( 'Creates a single column with 33&percnt; width', 'axisbuilder' );
		$this->shortcode = array(
			'sort'        => 15,
			'type'        => 'layout',
			'name'        => 'ab_cell_one_third',
			'icon'        => 'icon-one-third',
			'image'       => AB()->plugin_url() . '/assets/images/layouts/columns/one-third.png', // Fallback if icon is missing :)
			'target'      => 'axisbuilder-section-drop',
			'tinymce'     => array( 'disable' => true ),
			'drag-level'  => 2,
			'drop-level'  => 1,
			'html-render' => false,
			'invisible'   => true
		);
	}
}

/**
 * AB_Shortcode_Columns_Two_Third Class
 */
class AB_Shortcode_Cells_Two_Third extends AB_Shortcode_Cells {

	/**
	 * Configuration for builder shortcode button.
	 */
	public function shortcode_button() {
		$this->id        = 'axisbuilder_cell_two_third';
		$this->title     = __( '2/3', 'axisbuilder' );
		$this->tooltip   = __( 'Creates a single column with 67&percnt; width', 'axisbuilder' );
		$this->shortcode = array(
			'sort'        => 16,
			'type'        => 'layout',
			'name'        => 'ab_cell_two_third',
			'icon'        => 'icon-two-third',
			'image'       => AB()->plugin_url() . '/assets/images/layouts/columns/two-third.png', // Fallback if icon is missing :)
			'target'      => 'axisbuilder-section-drop',
			'tinymce'     => array( 'disable' => true ),
			'drag-level'  => 2,
			'drop-level'  => 1,
			'html-render' => false,
			'invisible'   => true
		);
	}
}

/**
 * AB_Shortcode_Columns_One_Fourth Class
 */
class AB_Shortcode_Cells_One_Fourth extends AB_Shortcode_Cells {

	/**
	 * Configuration for builder shortcode button.
	 */
	public function shortcode_button() {
		$this->id        = 'axisbuilder_cell_one_fourth';
		$this->title     = __( '1/4', 'axisbuilder' );
		$this->tooltip   = __( 'Creates a single column with 25&percnt; width', 'axisbuilder' );
		$this->shortcode = array(
			'sort'        => 17,
			'type'        => 'layout',
			'name'        => 'ab_cell_one_fourth',
			'icon'        => 'icon-one-fourth',
			'image'       => AB()->plugin_url() . '/assets/images/layouts/columns/one-fourth.png', // Fallback if icon is missing :)
			'target'      => 'axisbuilder-section-drop',
			'tinymce'     => array( 'disable' => true ),
			'drag-level'  => 2,
			'drop-level'  => 1,
			'html-render' => false,
			'invisible'   => true
		);
	}
}

/**
 * AB_Shortcode_Columns_Three_Fourth Class
 */
class AB_Shortcode_Cells_Three_Fourth extends AB_Shortcode_Cells {

	/**
	 * Configuration for builder shortcode button.
	 */
	public function shortcode_button() {
		$this->id        = 'axisbuilder_cell_three_fourth';
		$this->title     = __( '3/4', 'axisbuilder' );
		$this->tooltip   = __( 'Creates a single column with 75&percnt; width', 'axisbuilder' );
		$this->shortcode = array(
			'sort'        => 18,
			'type'        => 'layout',
			'name'        => 'ab_cell_three_fourth',
			'icon'        => 'icon-three-fourth',
			'image'       => AB()->plugin_url() . '/assets/images/layouts/columns/three-fourth.png', // Fallback if icon is missing :)
			'target'      => 'axisbuilder-section-drop',
			'tinymce'     => array( 'disable' => true ),
			'drag-level'  => 2,
			'drop-level'  => 2,
			'html-render' => false,
			'invisible'   => true
		);
	}
}

/**
 * AB_Shortcode_Columns_One_Fifth Class
 */
class AB_Shortcode_Cells_One_Fifth extends AB_Shortcode_Cells {

	/**
	 * Configuration for builder shortcode button.
	 */
	public function shortcode_button() {
		$this->id        = 'axisbuilder_cell_one_fifth';
		$this->title     = __( '1/5', 'axisbuilder' );
		$this->tooltip   = __( 'Creates a single column with 20&percnt; width', 'axisbuilder' );
		$this->shortcode = array(
			'sort'        => 19,
			'type'        => 'layout',
			'name'        => 'ab_cell_one_fifth',
			'icon'        => 'icon-one-fifth',
			'image'       => AB()->plugin_url() . '/assets/images/layouts/columns/one-fifth.png', // Fallback if icon is missing :)
			'target'      => 'axisbuilder-section-drop',
			'tinymce'     => array( 'disable' => true ),
			'drag-level'  => 2,
			'drop-level'  => 1,
			'html-render' => false,
			'invisible'   => true
		);
	}
}

/**
 * AB_Shortcode_Columns_Two_Fifth Class
 */
class AB_Shortcode_Cells_Two_Fifth extends AB_Shortcode_Cells {

	/**
	 * Configuration for builder shortcode button.
	 */
	public function shortcode_button() {
		$this->id        = 'axisbuilder_cell_two_fifth';
		$this->title     = __( '2/5', 'axisbuilder' );
		$this->tooltip   = __( 'Creates a single column with 40&percnt; width', 'axisbuilder' );
		$this->shortcode = array(
			'sort'        => 20,
			'type'        => 'layout',
			'name'        => 'ab_cell_two_fifth',
			'icon'        => 'icon-two-fifth',
			'image'       => AB()->plugin_url() . '/assets/images/layouts/columns/two-fifth.png', // Fallback if icon is missing :)
			'target'      => 'axisbuilder-section-drop',
			'tinymce'     => array( 'disable' => true ),
			'drag-level'  => 2,
			'drop-level'  => 1,
			'html-render' => false,
			'invisible'   => true
		);
	}
}

/**
 * AB_Shortcode_Columns_Three_Fifth Class
 */
class AB_Shortcode_Cells_Three_Fifth extends AB_Shortcode_Cells {

	/**
	 * Configuration for builder shortcode button.
	 */
	public function shortcode_button() {
		$this->id        = 'axisbuilder_cell_three_fifth';
		$this->title     = __( '3/5', 'axisbuilder' );
		$this->tooltip   = __( 'Creates a single column with 60&percnt; width', 'axisbuilder' );
		$this->shortcode = array(
			'sort'        => 21,
			'type'        => 'layout',
			'name'        => 'ab_cell_three_fifth',
			'icon'        => 'icon-three-fifth',
			'image'       => AB()->plugin_url() . '/assets/images/layouts/columns/three-fifth.png', // Fallback if icon is missing :)
			'target'      => 'axisbuilder-section-drop',
			'tinymce'     => array( 'disable' => true ),
			'drag-level'  => 2,
			'drop-level'  => 1,
			'html-render' => false,
			'invisible'   => true
		);
	}
}

/**
 * AB_Shortcode_Columns_Four_Fifth Class
 */
class AB_Shortcode_Cells_Four_Fifth extends AB_Shortcode_Cells {

	/**
	 * Configuration for builder shortcode button.
	 */
	public function shortcode_button() {
		$this->id        = 'axisbuilder_cell_four_fifth';
		$this->title     = __( '4/5', 'axisbuilder' );
		$this->tooltip   = __( 'Creates a single column with 80&percnt; width', 'axisbuilder' );
		$this->shortcode = array(
			'sort'        => 22,
			'type'        => 'layout',
			'name'        => 'ab_cell_four_fifth',
			'icon'        => 'icon-four-fifth',
			'image'       => AB()->plugin_url() . '/assets/images/layouts/columns/four-fifth.png', // Fallback if icon is missing :)
			'target'      => 'axisbuilder-section-drop',
			'tinymce'     => array( 'disable' => true ),
			'drag-level'  => 2,
			'drop-level'  => 1,
			'html-render' => false,
			'invisible'   => true
		);
	}
}
