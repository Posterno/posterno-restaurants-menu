<?php
/**
 * The template for displaying the restaurant setup page in the dashboard.
 *
 * This template can be overridden by copying it to yourtheme/posterno/restaurant/restaurant-setup-page.php
 *
 * HOWEVER, on occasion PNO will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @version 1.0.0
 * @package posterno-restaurants-menu
 */

use Posterno\Restaurants\Helper;

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

if ( ! is_user_logged_in() ) {
	return;
}

$user_id    = get_current_user_id();
$listing_id = isset( $_GET['listing_id'] ) ? absint( $_GET['listing_id'] ) : false;

if ( ! Helper::can_user_setup_food_menu( $user_id, $listing_id ) ) {
	return;
}

?>

<h2><?php esc_html_e( 'Setup restaurant menu' ); ?></h2>
<p><?php echo sprintf( esc_html__( 'You are setting up the food menu for the "%s" listing.' ), get_the_title( $listing_id ) ); ?></p>

<form>
	<div class="restaurants-menu-builder" x-data="<?php echo htmlspecialchars( wp_json_encode( Helper::get_data_for_form( $listing_id ), ENT_QUOTES ) ); ?>">

		<div class="alert alert-primary" role="alert" x-show="items.length <= 0">
			<?php esc_html_e( 'Your menu is currently empty.' ); ?>
		</div>

		<template x-for="item in items" :key="item">
			<div class="card mb-3">

				<div class="card-header" x-show="item.group_name.length > 0" x-text="item.group_name"></div>
				<div class="card-header" x-show="item.group_name === ''"><?php esc_html_e( 'Menu group' ); ?></div>

				<div class="card-body">

					<div class="form-group">
						<label><?php echo esc_html_e( 'Menu name' ); ?></label>
						<input type="text" class="form-control" x-model="item.group_name">

						<small class="form-text text-muted">
							<?php echo esc_html_e( 'Example: lunch, dinner, etc.' ); ?>
						</small>
					</div>

				</div>
			</div>
		</template>

		<button type="button" class="btn btn-secondary btn-sm" x-on:click="items.push( { group_name: '', food_items: [] } )"><?php esc_html_e( 'Add menu group' ); ?></button>

		<p x-text="JSON.stringify(items)"></p>

	</div>
</form>
