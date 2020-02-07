<?php
/**
 * Helper methods for this addon.
 *
 * @package     posterno-restaurants-menu
 * @copyright   Copyright (c) 2020, Sematico LTD
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0.0
 */

namespace Posterno\Restaurants;

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

/**
 * Helper methods.
 */
class Helper {

	/**
	 * Get the link to setup the restaurant menu for a listing.
	 *
	 * @param string $listing_id the listing id number.
	 * @return string
	 */
	public static function get_menu_setup_link( $listing_id ) {

		return add_query_arg(
			[
				'listing_id' => absint( $listing_id ),
			],
			trailingslashit( get_permalink( pno_get_dashboard_page_id() ) ) . 'restaurant-menu'
		);

	}

}
