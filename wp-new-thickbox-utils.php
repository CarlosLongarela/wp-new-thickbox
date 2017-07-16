<?php
/**
 * WP New ThickBox Utils
 * This file is distributed under the same license as the WP New ThickBox package.
 * Carlos Longarela <carlos@longarela.eu>, 2017
 */

class auto_thickbox_utils {

	/**
	* @since 1.0
	* @see /wp-includes/general-template.php
	*/
	function disabled( $disabled, $current = true, $echo = true ) {
		if ( function_exists( 'disabled' ) ) {
			return disabled( $disabled, $current, $echo );
		} elseif ( function_exists( '__checked_selected_helper' ) ) {
			return __checked_selected_helper( $disabled, $current, $echo, 'disabled' );
		}

		$result = $disabled === $current ? " disabled='disabled'" : '';
		if ( $echo ) {
			echo $result;
		}

		return $result;
	} // End of disabled( $disabled, $current = true, $echo = true ).

	/**
	* @see /wp-admin/includes/template.php or /wp-includes/general-template.php
	* @note '$current = true' and '$echo' is defined since WordPress 2.8
	*/
	// TODO: Check WP versions and options.
	function checked( $checked, $current = true, $echo = true ) {
		if ( version_compare( '2.8', get_bloginfo( 'version' ) ) > 0 ) {
			checked( $checked, $current );
		} else {
			return checked( $checked, $current, $echo );
		}
	} // End of function checked( $checked, $current = true, $echo = true ).

	// @note '$plugin' is defined since WordPress 2.8
	function plugins_url( $path, $plugin = '' ) {
		if ( ! $plugin ) {
			$plugin = __FILE__;
		}
		return version_compare( '2.8', get_bloginfo( 'version' ) ) > 0 ? plugins_url( 'wp-new-thickbox/' . $path ) : plugins_url( $path, $plugin );
	} // End of plugins_url( $path, $plugin = '' ).
}
