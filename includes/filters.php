<?php
/**
 * Register filters for this addon.
 *
 * @package     posterno-restaurants-menu
 * @copyright   Copyright (c) 2020, Sematico, LTD
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0.0
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

/**
 * Register a new field type.
 */
add_filter(
	'pno_registered_field_types',
	function( $types ) {

		$types['restaurant'] = esc_html__( 'Restaurant menu' );

		return $types;

	}
);
