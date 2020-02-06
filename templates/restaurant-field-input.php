<?php
/**
 * The template for displaying the input of the restaurant field on forms.
 *
 * This template can be overridden by copying it to yourtheme/posterno/restaurant/restaurant-field-input.php
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

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

?>

<div class="restaurants-menu-builder">

	<div class="alert alert-primary" role="alert">
		<?php esc_html_e( 'Your menu is currently empty.' ); ?>
	</div>

	<button type="button" class="btn btn-secondary btn-sm"><?php esc_html_e( 'Add menu group' ); ?></button>

</div>
