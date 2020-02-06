<?php
/**
 * The template for displaying the output of the restaurant field on listings pages.
 *
 * This template can be overridden by copying it to yourtheme/posterno/fields-output/restaurant-field-output.php
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

$value = $data->value;

print_r( $value );

?>

<div class="row">
	<div class="col-sm-8">
		<h5 class="menu-title mb-2 font-weight-bold">Wild Mushroom Bucatini with Kale</h5>
		<p class="menu-detail m-0 text-black-50">Mushroom / Veggie / White Sources</p>
	</div>
	<div class="col-sm-4 menu-price-detail text-right">
		<h4 class="menu-price m-0 font-weight-bold">$10.5</h4>
	</div>
</div>
