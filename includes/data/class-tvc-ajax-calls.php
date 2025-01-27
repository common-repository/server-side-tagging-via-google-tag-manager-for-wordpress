<?php

/**
 * TVC Ajax Calls Class.
 *
 * @package TVC Product Feed Manager/Data/Classes
 * @version 1.0.1
 */

if (!defined('ABSPATH')) {
	exit;
}

if (!class_exists('CONVSST_Ajax_Calls')):
	/**
	 * Feed Controller Class
	 */
	class CONVSST_Ajax_Calls
	{
		public function __construct()
		{
		}

		protected function safe_ajax_call($nonce, $registered_nonce_name)
		{
			// check the nonce.
			if (wp_verify_nonce($nonce, $registered_nonce_name) && is_admin()) {
				return true;
			} else {
				return false;
			}
			// only return results when the user is an admin with manage options.
			// if ( is_admin() ) {
			// 	return true;
			// } else {
			// 	return false;
			// }
		}
	}
	// end of CONVSST_Ajax_Calls class.
endif;