<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Address extends CI_Controller {

	public function check_login()
	{
		if(!UID)
			redirect("login");
	} 

	public function add()
	{
		$viewdata = array();		
		if($this->input->post("address_name"))
		{
			$address_name = $this->input->post("address_name");
			$price = $this->input->post("price");			
			$res = $this->address_m->add_address($address_name, $price);
			if(!$res) 
				$viewdata['error'] = "Address already exist.";
			else
				redirect("/address");
		}

		$data = array('title' => 'Add Address - Bakery Order System', 'page' => 'address');
		$this->load->view('header', $data);
		$this->load->view('address/add',$viewdata);
		$this->load->view('footer');
	}

	function delete($id)
	{
		$this->address_m->delete_address($id);
		redirect("/address");
	}

	public function edit($id)
	{
		if($this->input->post("address_name"))
		{
			$address_name = $this->input->post("address_name");
			$price = $this->input->post("price");
			$res = $this->address_m->edit_address($id, $address_name, $price);
			redirect("/address");
		}
		
		$data = array('title' => 'Edit Address - Bakery Order System', 'page' => 'address');
		$this->load->view('header', $data);

		$address = $this->address_m->getOneAddress($id);
		
		$viewdata = array('data'  => $address[0]);
		$this->load->view('address/edit', $viewdata);
		$this->load->view('footer');
	}

	public function index()
	{
		$this->check_login();
		$addresslst = $this->address_m->get_address();
		$viewdata = array('address' => $addresslst);
		$data = array('title' => 'Address - Bakery Order System', 'page' => 'address');
		$this->load->view('header', $data);
		$this->load->view('address/list',$viewdata);
		$this->load->view('footer');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */