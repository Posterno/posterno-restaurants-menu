<?php
/**
 * Register actions for this addon.
 *
 * @package     posterno-restaurants-menu
 * @copyright   Copyright (c) 2020, Sematico, LTD
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0.0
 */

use Posterno\Restaurants\Plugin;

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

/**
 * Displays the content of the custom link within the dashboard.
 */
add_action(
	'pno_listings_dashboard_table_action_restaurant',
	function( $listing_id ) {

		Plugin::instance()->templates
			->set_template_data(
				array(
					'listing_id' => $listing_id,
				)
			)
			->get_template_part( 'dashboard-action-link' );

	}
);

/**
 * Displays the content of the "restaurant-menu" dashboard page.
 */
add_action(
	'pno_dashboard_tab_content_restaurant-menu',
	function() {

		Plugin::instance()->templates
			->get_template_part( 'restaurant-setup-page' );

	}
);
