<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Orderlist extends CI_Controller {

	public function check_login()
	{
		if(!UID)
			redirect("login");
	} 
	
	public function view($orderid)
	{
		$data = array('title' => 'View Order - Bakery Order System ', 'page' => 'orderlist');
		$this->load->view('header', $data);
		$orderinfo =$this->orderlist_m->get_order_info($orderid);
		$orderlist = $this->order_m->get_order_items($orderid);
		$viewdata = array('orderinfo'  => $orderinfo[0], 'orderlist' => $orderlist);
		$this->load->view('orderlist/view',$viewdata);
		$this->load->view('footer');	
	}

	public function sumery_all()
	{
		$data = array('title' => 'Order Sumery- Bakery Order System ', 'page' => 'printsumery');
		$this->load->view('header', $data);
		$this->load->view('sumery_print/view');
		$this->load->view('footer');	
	}

	public function delete($orderid)
	{
		$orderinfo =$this->orderlist_m->get_order_info($orderid);
		if($orderinfo[0]->state == 'COMPLETE') redirect("/orderlist");
		$this->orderlist_m->delete_order($orderid);
		redirect("/orderlist");
	}

	public function state_change($orderid)
	{
		$orderlst = $this->orderlist_m->state_changed($orderid);
		echo "ok";	
	}

	public function index()
	{
		$this->check_login();
		$orderlst = $this->orderlist_m->get_list();
		$viewdata = array('orderlist' => $orderlst);
		$data = array('title' => 'Order History - Bakery Order System', 'page' => 'orderlist');
		$this->load->view('header', $data);
		$this->load->view('orderlist/list',$viewdata);
		$this->load->view('footer');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */