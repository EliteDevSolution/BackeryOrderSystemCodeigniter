<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class postControllerHook{

	function check_login()
	{
		$CI =& get_instance();

		// $CI->output->enable_profiler(TRUE);
		define('UID', $CI->session->userdata('uid'));
		define('USERNAME', $CI->session->userdata('name'));
		define('USERROLE', $CI->session->userdata('role'));
		define('USEREMAIL', $CI->session->userdata('email'));
		define('ABN', $CI->session->userdata('abn'));
		define('USERBAND', $CI->session->userdata('priceband'));
		define('USERADDRESS', $CI->session->userdata('deliveryaddress'));

	}
}

?>