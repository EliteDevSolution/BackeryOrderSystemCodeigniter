<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Employee extends CI_Controller {

	public function check_login()
	{
		if(!UID)
			redirect("login");
		else if(USERROLE == 0)
			redirect("/");

	} 

	public function add()
	{
		$this->check_login();
		$viewdata = array();
		if($this->input->post("name") && $this->input->post("password") && $this->input->post("email"))
		{
			$name = $this->input->post("name");
			$password = $this->input->post("password");
			$bussname = $this->input->post("bussname");
			$email = $this->input->post("email");
			$abn = $this->input->post("abn");
			$priceband = $this->input->post("priceband");
			$address = $this->input->post("address");
			$role = $this->input->post("role");
			$insertdata = [
				'name'=>$name,
				'email'=>$email,
				'password'=>$password,
				'businessname'=>$bussname,
				'abn'=>$abn,
				'priceband'=>$priceband,
				'deliveryaddress'=>$address,
				'role'=>$role
			];
			$res = $this->employee_m->addEmployee($insertdata, $name, $email);
			if(!$res) 
				$viewdata['error'] = "User already exist.";
			else
			redirect("/employee");
		}

		$data = array('title' => 'Add User - Bakery Order System', 'page' => 'employee');
		$this->load->view('header', $data);
		if(!empty($insertdata)) $viewdata['data'] = $insertdata;
		$this->load->view('employee/add',$viewdata);
		$this->load->view('footer');
	}

	public function delete($employee_id)
	{
		$this->check_login();
		$this->employee_m->deleteEmployee($employee_id);
		redirect("/employee");
	}

	public function edit($id)
	{
		$this->check_login();
		$name = $this->input->post("name");
		$password = $this->input->post("password");
		$bussname = $this->input->post("bussname");
		$email = $this->input->post("email");
		$abn = $this->input->post("abn");
		$priceband = $this->input->post("priceband");
		$address = $this->input->post("address");
		$role = $this->input->post("role");
		if($name && $password && $email)
		{
			$editdata = [
				'name'=>$name,
				'email'=>$email,
				'password'=>$password,
				'businessname'=>$bussname,
				'abn'=>$abn,
				'priceband'=>$priceband,
				'deliveryaddress'=>$address,
				'role'=>$role
			];
			
			$this->employee_m->editEmployee($id, $editdata);
			redirect("/employee");
		}
		
		$data = array('title' => 'Edit User - Bakery Order System ', 'page' => 'employee');
		$this->load->view('header', $data);

		$employee = $this->employee_m->getEmployee($id);
		
		$viewdata = array('data'  => $employee[0]);
		$this->load->view('employee/edit',$viewdata);

		$this->load->view('footer');
	}

	public function index()
	{
		$this->check_login();
		$employees = $this->employee_m->get_employees();

		$viewdata = array('employees' => $employees);

		$data = array('title' => 'Userlist - Bakery Order System', 'page' => 'employee');
		$this->load->view('header', $data);
		$this->load->view('employee/list',$viewdata);
		$this->load->view('footer');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */