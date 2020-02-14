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
			array(
				'listing_id' => absint( $listing_id ),
			),
			trailingslashit( get_permalink( pno_get_dashboard_page_id() ) ) . 'restaurant-menu'
		);

	}

	/**
	 * Determine if a user can setup the food menu.
	 *
	 * @param string $user_id the id number.
	 * @param string $listing_id the id number.
	 * @return boolean
	 */
	public static function can_user_setup_food_menu( $user_id, $listing_id ) {

		if ( ! pno_user_has_submitted_listings( $user_id ) ) {
			return false;
		}

		if ( ! pno_is_user_owner_of_listing( $user_id, $listing_id ) ) {
			return false;
		}

		return true;

	}

	/**
	 * Get the metakey of the restaurant field.
	 *
	 * @return void
	 */
	public static function get_restaurant_field_meta_key() {

		$meta_key = false;

		$restaurant_field = wp_list_filter( pno_get_listings_fields(), array( 'type' => 'restaurant' ) );

		if ( is_array( $restaurant_field ) && ! empty( $restaurant_field ) && isset( $restaurant_field[0]['meta'] ) ) {
			$meta_key = $restaurant_field[0]['meta'];
		}

		return $meta_key;

	}

	/**
	 * Get the json data of menu groups for the form.
	 *
	 * @param string|int $listing_id the id number of the listing to verify.
	 * @return array
	 */
	public static function get_menus_data_for_form( $listing_id ) {

		$meta_key = self::get_restaurant_field_meta_key();

		$menus = carbon_get_post_meta( $listing_id, $meta_key );

		$data = array( 'items' => array() );

		if ( ! empty( $menus ) && is_array( $menus ) ) {
			foreach ( $menus as $menu ) {
				$data['items'][] = array(
					'group_name' => isset( $menu['group_title'] ) ? esc_html( $menu['group_title'] ) : false,
				);
			}
		}

		return $data;

	}

}
