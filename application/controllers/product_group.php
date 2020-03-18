<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Product_group extends CI_Controller {

	public function check_login()
	{
		if(!UID || USERROLE == 0)
			redirect("login");
	} 

	public function add()
	{
		$this->check_login();
		$viewdata = array();		
		if($this->input->post("group_name"))
		{
			$group_name = $this->input->post("group_name");
			$res = $this->product_group_m->add_group($group_name);
			if(!$res) 
				$viewdata['error'] = "Product group already exist.";
			else
				redirect("/product_group");
		}

		$data = array('title' => 'Add Group - Bakery Order System', 'page' => 'product_group');
		$this->load->view('header', $data);
		$this->load->view('product_group/add', $viewdata);
		$this->load->view('footer');
	}

	function delete($id)
	{
		$this->check_login();
		$this->product_group_m->delete_group($id);
		redirect("/product_group");
	}

	public function edit($id)
	{
		$this->check_login();
		if($this->input->post("group_name"))
		{
			$group_name = $this->input->post("group_name");
			$res = $this->product_group_m->edit_group($id, $group_name);
			if(!$res) 
				$error = "Address already exist.";
			else
				redirect("/product_group");
		}
		
		$data = array('title' => 'Edit Group - Bakery Order System', 'page' => 'product_group');
		$this->load->view('header', $data);

		$groupLst = $this->product_group_m->getOneGroup($id);
		$viewdata = array('data'  => $groupLst[0]);
		if(!empty($error))
			$viewdata['error'] = "Product group already exist.";
		$this->load->view('product_group/edit',$viewdata);
		$this->load->view('footer');
	}

	public function index()
	{
		$this->check_login();
		$grouplst = $this->product_group_m->get_group();
		$viewdata = array('group' => $grouplst);
		$data = array('title' => 'Product Group - Bakery Order System', 'page' => 'product_group');
		$this->load->view('header', $data);
		$this->load->view('product_group/list',$viewdata);
		$this->load->view('footer');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */