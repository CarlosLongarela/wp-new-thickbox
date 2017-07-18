<?php
/**
 * WP New ThickBox Utils
 * This file is distributed under the same license as the WP New ThickBox package.
 * Carlos Longarela <carlos@longarela.eu>, 2017
 */

class WpNewThickboxUtils {

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

}
