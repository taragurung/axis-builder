<?php
/**
 * AxisBuilder HTML Helper
 *
 * @class       AB_HTML_Helper
 * @package     AxisBuilder/Classes
 * @category    Class
 * @author      AxisThemes
 * @since       1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * AB_HTML_Helper Class
 */
class AB_HTML_Helper {

	public static $meta_data     = array();
	public static $elementValues = array();
	public static $elementHidden = array();

	public static function render_meta_box( $meta_element ) {

		// Query the Meta-Data of the current post and check if a key is set, if not set the default value to the standard value, otherwise to the key value ;)
		if ( ! isset( self::$meta_data[$meta_element['current_post']] ) ) {
			self::$meta_data[$meta_element['current_post']] = get_post_custom( $meta_element['current_post'] );
		}

		if ( isset( self::$meta_data[$meta_element['current_post']][$meta_element['id']] ) ) {
			$meta_element['std'] = self::$meta_data[$meta_element['current_post']][$meta_element['id']][0];
		}

		return self::render_element( $meta_element );
	}

	public static function render_multiple_elements( $elements, $parent_class = false ) {
		$output = '';

		foreach ( $elements as $element ) {
			$output .= self::render_element( $element, $parent_class );
		}

		return $output;
	}

	/**
	 * Check AJAX request and modify ELement ID.
	 * @param  array $element Shortcode Element.
	 * @return array $element If AJAX request update ELement's ID.
	 */
	public static function ajax_modify_id( $element ) {
		if ( isset( $_POST['fetch'] ) ) {
			$prepend = isset( $_POST['instance'] ) ? $_POST['instance'] : 0;
			$element['ajax'] = true;

			// Prepend multiple times if multiple windows called ;)
			for ( $i = 0; $i < $prepend; $i++ ) {
				$element['id'] = "axisbuilderTB-" . $element['id'];
			}
		}

		return $element;
	}

	/**
	 *
	 */
	public static function check_dependencies( $element ) {
		$params = array( 'data_string' => '', 'class_string' => '' );

		if ( ! empty( $element['required'] ) ) {
			$data = array();

			// Store check depedencies ;)
			$data['check-element']  = empty( $element['required'][0] ) ? 'no-logical-check' : $element['required'][0];
			$data['check-operator'] = empty( $element['required'][1] ) ? 'no-logical-check' : $element['required'][1];
			$data['check-value']    = empty( $element['required'][2] ) ? 'no-logical-check' : $element['required'][2];

			// Crete a html data-string ;)
			$params['data_string'] = axisbuilder_html_data_string( $data );
			$visible = false;

			// Required element must not be hidden. Otherwise hide this one by default.
			if ( ! isset( self::$elementHidden[$data['check-element']] ) ) {

				if ( isset( self::$elementValues[$data['check-element']] ) ) {
					$first_value = self::$elementValues[$data['check-element']];
					$final_value = ( $data['check-value'] !== 'no-logical-check' ) ? $data['check-value'] : '';

					switch ( $data['check-operator'] ) {
						case 'equals':
							$visible = ( $first_value == $final_value ) ? true : false;
						break;

						case 'not':
							$visible = ( $first_value != $final_value ) ? true : false;
						break;

						case 'is_larger':
							$visible = ( $first_value > $final_value ) ? true : false;
						break;

						case 'is_smaller':
							$visible = ( $first_value < $final_value ) ? true : false;
						break;

						case 'contains':
							$visible = ( strpos( $first_value, $final_value ) !== false ) ? true : false;
						break;

						case 'doesnot_contain':
							$visible = ( strpos( $first_value, $final_value ) === false ) ? true : false;
						break;

						case 'is_empty_or':
							$visible = ( empty( $first_value) || ( $first_value == $final_value ) ) ? true : false;
						break;

						case 'not_empty_and':
							$visible = ( ! empty( $first_value) || ( $first_value != $final_value ) ) ? true : false;
						break;
					}
				}
			}

			if ( ! $visible ) {
				$params['class_string'] = 'axisbuilder-hidden';
			}
		}

		return $params;
	}

	public static function render_element( $element, $parent_class = false ) {
		$data   = array();
		$output = $target_string = '';

		// Merge default into element
		$default = array( 'id' => '', 'name' => '', 'label' => '', 'std' => '', 'class' => '', 'container_class' => '', 'desc' => '', 'required' => array(), 'target' => array(), 'shortcode_data' => array() );
		$element = array_merge( $default, $element );

		// Save the values into a unique array in case we need it for dependencies
		self::$elementValues[$element['id']] = $element['std'];

		// Create default data & class string and check the depedencies of an object
		extract( self::check_dependencies( $element ) );

		// Check if its an ajax request and prepend a string to ensure ID's are unique
		$element = self::ajax_modify_id( $element );

		// ID and Class string
		$id_string     = empty( $element['id'] ) ? '' : 'id="' . $element['id'] . '-form-container"';
		$class_string .= empty( $element['container_class'] ) ? ' ' : $element['container_class'];

		if ( ! empty( $target ) ) {
			$data['target-element']  = $element['target'][0];
			$data['target-property'] = $element['target'][1];
			$class_string  .= ' axisbuilder-attach-targetting';
			$target_string .= axisbuilder_html_data_string( $data );
		}

		if ( ! empty( $element['fetchTMPL'] ) ) {
			$class_string .= ' axisbuilder-attach-templating';
		}

		if ( empty( $element['nodescription'] ) ) {
			$output .= '<div ' . $id_string . ' class="axisbuilder-clearfix axisbuilder-form-element-container axisbuilder-element-' . $element['type'] . ' ' . $class_string . '" ' . $data_string . ' ' . $target_string . '>';
				if ( ! empty( $element['name'] ) || ! empty( $element['desc'] ) ) {
					$output .= '<div class="axisbuilder-name-description">';

					if ( ! empty( $element['name'] ) ) {
						$output .= '<strong>' . $element['name'] . '</strong>';
					}

					if ( ! empty( $element['desc'] ) ) {
						if ( ! empty( $element['type'] ) && $element['type'] !== 'checkbox' ) {
							$output .= '<span>' . $element['desc'] . '</span>';
						} else {
							$output .= '<label for="' . $element['id'] . '">' . $element['desc'] . '</label>';
						}
					}

					$output .= '</div>';
				}

				$output .= '<div class="axisbuilder-form-element ' . $element['class'] . '">';
					$output .= self::$element['type']( $element, $parent_class );

					if ( ! empty( $element['fetchTMPL'] ) ) {
						$output .= '<div class="template-container"></div>';
					}

				$output .= '</div>';
			$output .= '</div>';
		} else {
			$output .= self::$element['type']( $element, $parent_class );
		}

		return $output;
	}

	public static function input( $element ) {
		$output = '<input type="text" name="' . $element['id'] . '" id="' . $element['id'] . '" class="' . $element['class'] . '" value="' . nl2br( $element['std'] ) . '" />';
		return $output;
	}

	public static function checkbox( $element ) {
		$output = '<input type="checkbox" name="' . $element['id'] . '" id="' . $element['id'] . '" class="' . $element['class'] . '" value="' . $element['id'] . '" ' . checked( $element['std'], $element['id'], false ) . ' />';
		return $output;
	}

	public static function textarea( $element ) {
		$output = '<textarea rows="5" cols="20" name="' . $element['id'] . '" id="' . $element['id'] . '" class="' . $element['class'] . '">' . rtrim( $element['std'] ) . '</textarea>';
		return $output;
	}

	public static function select( $element ) {
		$select = __( 'Select', 'axisbuilder' );

		if ( $element['subtype'] == 'category' ) {
			$taxonomy = empty( $element['taxonomy'] ) ? '' : '&taxonomy="' . $element['taxonomy'];
			$entries  = get_categories( 'title_li=&orderby=name&hide_empty=0' . $taxonomy );
		} elseif ( ! is_array( $element['subtype'] ) ) {
			// Will do later on ;)
		} else {
			$entries = $element['subtype'];
		}

		// ID, Name and data string
		$id_string   = empty( $element['id'] ) ? '' : 'id="' . $element['id'] . '"';
		$name_string = empty( $element['name'] ) ? '' : 'name="' . $element['id'] . '"';
		$data_string = empty( $element['data'] ) ? '' : axisbuilder_html_data_string( $element['data'] );

		// Return if the entries are empty ;)
		if ( empty( $entries ) ) {
			return true;
		}

		// Multi Select option
		$multi = $multi_class = '';
		if ( isset( $element['multiple'] ) ) {
			$multi          = 'multiple="multiple" size="' . $element['multiple'] . '"';
			$multi_class    = ' axisbuilder-multiple-select';
			$element['std'] = explode( ',', $element['std'] );
		}

		// Real output is here ;)
		$output = '<select ' . $multi . ' class="' . $element['class'] . '" ' . $id_string . ' ' . $name_string . ' ' . $data_string . '>';

		// Check with first option ;)
		if ( isset( $element['with_first'] ) ) {
			$fake_val = $select;
			$output  .= '<option value="">' .$select . '</option>';
		}

		foreach ( $entries as $key => $value ) {

			if ( $element['subtype'] == 'category' ) {

			} else if ( ! is_array( $element['subtype'] ) ) {

			} else {
				$id    = $value;
				$title = $key;
			}

			if ( ! empty( $title ) || ( isset( $title ) && $title === 0 ) ) {

				if ( ! isset( $fake_val ) ) {
					$fake_val = $title;
				}

				$selected = '';

				if ( ( $element['std'] == $id ) || ( is_array( $element['std'] ) && in_array( $id, $element['std'] ) ) ) {
					$fake_val = $title;
					$selected = 'selected="selected"';
				}

				if ( strpos( $title, 'option_group' ) === 0 ) {
					$output .= '<optgroup label="' . $id . '">';
				} else if ( strpos( $title, 'close_option_group_' ) === 0 ) {
					$output .= '</optgroup>';
				} else {
					$output .= '<option ' . $selected . ' value="' . $id . '">' . $title . '</option>';
				}
			}
		}

		$output .= '</select>';

		return $output;
	}
}
