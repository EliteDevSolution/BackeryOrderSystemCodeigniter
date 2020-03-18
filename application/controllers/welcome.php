<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function check_login()
	{
		if(!UID)
			redirect("login");
	} 

	// public function index()
	// {
		
	// 	$this->check_login();
	// 	$today_stats = $this->report_m->today_stats();
	// 	$customer_pay_list = $this->report_m->get_customer_freq_list();
	// 	$customer_most_paid = $this->report_m->get_customer_most_paid();
	// 	$next_week_freq = $this->report_m->get_next_week_freq();
				
	// 	$data = array('title' => 'Bakery Order System', 'page' => 'dashboard');
	// 	$this->load->view('header', $data);

	// 	$viewdata = array(
	// 		'today_stats' => $today_stats,
	// 		'customer_pay_list' => $customer_pay_list,
	// 		'customer_most_paid' => $customer_most_paid,
	// 		'next_week_freq' => $next_week_freq
	// 	);
	// 	$this->load->view('welcome_message', $viewdata);
	// 	$this->load->view('footer', array("next_week_freq"=>$next_week_freq));
	// 	$this->session->set_userdata('show_guide',true);
	// }

	public function index()
	{
		$this->check_login();
		$userlst = $this->standing_order_m->get_customer();
		$orderlst = array();
		if(USERROLE == 0)
		{
			$orderlst = $this->standing_order_m->get_stand_order(UID);
		}
		else
		{
			$userdata = $this->standing_order_m->get_min_userid();
			$orderlst = $this->standing_order_m->get_stand_order($userdata[0]->id);
		}
		$viewdata = array('userlst' => $userlst, 'orderlst'=>$orderlst);
		$data = array('title' => 'S.Order - Bakery Order System', 'page' => 'standing_order');
		$this->load->view('header', $data);
		$this->load->view('standing_order/add', $viewdata);
		$this->load->view('footer');
	}
}

