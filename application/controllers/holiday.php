<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Holiday extends CI_Controller {

	public function check_login()
	{
		if(!UID || USERROLE == 0)
			redirect("login");
	} 

	public function add()
	{
		$this->check_login();
		$viewdata = array();		
		if($this->input->post("holiday_title"))
		{
			$address_name = $this->input->post("holiday_title");
			$date_range = $this->input->post("date_range");
			$customer_id = $this->input->post('userlist');
			$res = $this->holiday_m->add_holiday($customer_id,$address_name, $date_range);
			if(!$res) 
				$viewdata['error'] = "Holiday already exist.";
			else
				redirect("/holiday");
		}

		$data = array('title' => 'Add Holiday - Bakery Order System', 'page' => 'holiday');
		$this->load->view('header', $data);
		$userlst = $this->standing_order_m->get_customer();
		$viewdata['userlst'] = $userlst;

		$this->load->view('holiday/add',$viewdata);
		$this->load->view('footer');
	}

	function delete($id)
	{
		$this->check_login();
		$this->holiday_m->delete_holiday($id);
		redirect("/holiday");
	}

	public function edit($id)
	{
		$this->check_login();
		if($this->input->post("holiday_title"))
		{
			$address_name = $this->input->post("holiday_title");
			$date_range = $this->input->post("date_range");
			$customer_id = $this->input->post('userlist');
			$res = $this->holiday_m->edit_holiday($id, $customer_id, $address_name, $date_range);
			redirect("/holiday");
		}
		$data = array('title' => 'Edit Holiday - Bakery Order System', 'page' => 'holiday');
		$this->load->view('header', $data);
		$holiday = $this->holiday_m->getOneHoliday($id);
		$viewdata = array('data'  => $holiday[0]);
		$userlst = $this->standing_order_m->get_customer();
		$viewdata['userlst'] = $userlst;
		$this->load->view('holiday/edit', $viewdata);
		$this->load->view('footer');
	}

	public function index()
	{
		$this->check_login();
		$holidaylst = $this->holiday_m->get_holiday();
		$viewdata = array('holidaylist' => $holidaylst);
		$data = array('title' => 'Holiday - Bakery Order System', 'page' => 'holiday');
		$this->load->view('header', $data);
		$this->load->view('holiday/list',$viewdata);
		$this->load->view('footer');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */