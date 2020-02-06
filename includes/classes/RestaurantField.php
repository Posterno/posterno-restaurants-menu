<?php
/**
 * Handles the restaurant field display within the submission form.
 *
 * @package     posterno-restaurants-menu
 * @copyright   Copyright (c) 2020, Sematico LTD
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0.0
 */

namespace PNO\Form\Element\Input;

use PNO\Form\Element;
use Posterno\Restaurants\Plugin;

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

/**
 * Defines the Restaurant field type for the forms.
 */
class Restaurant extends Element\Input {

	/**
	 * Initialize the editor.
	 *
	 * @param string $name field configuration.
	 * @param string $value field configuration.
	 * @param string $indent field configuration.
	 */
	public function __construct( $name, $value = null, $indent = null ) {
		parent::__construct( $name, $value = null, $indent = null );
	}

	/**
	 * Render the field.
	 *
	 * @return string
	 */
	public function render( $depth = 0, $indent = null, $inner = false ) {

		ob_start();

		Plugin::instance()->templates
			->set_template_data(
				array(
					'field' => $this,
				)
			)
			->get_template_part( 'restaurant-field-input' );

		return ob_get_clean();

	}

	/**
	 * Get form element object type
	 *
	 * @return string
	 */
	public function getType() {
		return 'restaurant';
	}

}
