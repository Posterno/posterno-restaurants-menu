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

<?php if ( isset( $_GET['action'] ) && $_GET['action'] === 'saved' ) : ?>

	<?php

		$data = array(
			'message' => esc_html__( 'Menu successfully updated.' ),
			'type'    => 'success',
		);

		posterno()->templates
			->set_template_data( $data )
			->get_template_part( 'message' );

		?>

<?php endif; ?>

<form method="POST" action="<?php echo esc_url( pno_get_full_page_url() ); ?>">
	<div class="card">
		<h5 class="card-header"><?php esc_html_e( 'Menus' ); ?></h5>
		<div class="card-body" x-data="<?php echo htmlspecialchars( wp_json_encode( Helper::get_menus_data_for_form( $listing_id ), ENT_QUOTES ) ); ?>">

			<p class="card-text"><?php esc_html_e( 'Create menus then add items.' ); ?></p>

			<div class="alert alert-primary" role="alert" x-show="items.length <= 0">
				<?php esc_html_e( 'Press the "Add menu" button to create your first menu.' ); ?>
			</div>

			<template x-for="item in Object.keys( items )" :key="item">

				<div class="form-group">
					<label class="font-weight-bold"><?php echo esc_html_e( 'Menu name' ); ?></label>
					<div class="input-group">
						<input type="text" class="form-control" x-model="items[item].group_name">
						<div class="input-group-append">
							<button class="btn btn-outline-secondary" type="button" @click="var newItems = items; delete newItems[item]; items = newItems.filter(function(e){return e});"><?php esc_html_e( 'Remove' ); ?></button>
						</div>
					</div>

					<small class="form-text text-muted">
						<?php echo esc_html_e( 'Example: lunch, dinner, etc.' ); ?>
					</small>
				</div>

			</template>

			<button type="button" class="btn btn-secondary btn-sm" x-on:click="items.push( { group_name: '' } )"><?php esc_html_e( 'Add menu' ); ?></button>

			<input type="hidden" name="restaurant_menus" x-bind:value="JSON.stringify(items,null,'\t')">

		</div>
		<div class="card-footer text-muted text-right">
			<input type="submit" class="btn btn-primary btn-sm text-decoration-none" value="<?php esc_html_e( 'Save menus' ); ?>">
		</div>
	</div>

	<?php wp_nonce_field( 'saving_restaurant_menus_list', 'save_restaurant_menus_nonce' ); ?>
</form>

