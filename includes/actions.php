<?php
/**
 * Register actions for this addon.
 *
 * @package     posterno-restaurants-menu
 * @copyright   Copyright (c) 2020, Sematico, LTD
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0.0
 */

use Posterno\Restaurants\Helper;
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

/**
 * Detect when the menus editor has been submitted and store it into the database.
 */
add_action(
	'init',
	function() {

		if ( ! isset( $_POST['name_of_nonce_field'] ) || ! wp_verify_nonce( $_POST['name_of_nonce_field'], 'name_of_my_action' ) || ! is_user_logged_in() ) {
			return;
		}

		$listing_id = isset( $_GET['listing_id'] ) && ! empty( $_GET['listing_id'] ) ? absint( $_GET['listing_id'] ) : false;

		if ( ! pno_is_user_owner_of_listing( get_current_user_id(), $listing_id ) ) {
			return;
		}

		$meta_key = Helper::get_restaurant_field_meta_key();

		if ( ! $meta_key ) {
			return;
		}

		$menus_to_save = [];

		$menu_groups = isset( $_POST['restaurant_menus'] ) && ! empty( $_POST['restaurant_menus'] ) ? json_decode( stripslashes( $_POST['restaurant_menus'] ), true ) : false;

		if ( ! empty( $menu_groups ) && is_array( $menu_groups ) ) {
			foreach ( $menu_groups as $menu ) {

				$group_name = isset( $menu['group_name'] ) ? sanitize_text_field( $menu['group_name'] ) : false;

				$menus_to_save[] = [
					'group_title' => $group_name,
				];

			}
		}

		if ( ! empty( $menus_to_save ) ) {
			carbon_set_post_meta( $listing_id, $meta_key, $menus_to_save );
		}

		$redirect = add_query_arg( [ 'listing_id' => $listing_id ], Helper::get_menu_setup_link( $listing_id ) );

		wp_safe_redirect( $redirect );
		exit;

	}
);
