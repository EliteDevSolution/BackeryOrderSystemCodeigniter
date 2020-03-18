<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class user_l{

	public function __construct() {
		
	}
	public function login($user, $holidaylst)
	{
		// var_dump($user);
		$data = array(
			'uid' => $user[0]->id,
			'name' => $user[0]->name,
			'role' => $user[0]->role,
			'email' => $user[0]->email,
			'abn' => $user[0]->abn,
			'priceband' => $user[0]->priceband,
			'deliveryaddress' => $user[0]->deliveryaddress,
			'holidaylst' => $holidaylst
		);
		$CI = &get_instance();
		$CI->session->set_userdata($data);
	}
	public function logout()
	{
		$CI = &get_instance();
		$CI->session->sess_destroy();
	}
}
