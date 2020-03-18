<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {


	public function check_login()
	{
		if(UID)
			redirect("/");
	} 

	public function index()
	{
		$this->check_login();

		$viewdata = array();
		//$this->output->enable_profiler(TRUE);
		if($this->input->post("username") && $this->input->post("password"))
		{
			$username = $this->input->post("username");
			$password = $this->input->post("password");
			if($user=$this->user_m->check_login($username, $password)) {
				$holidaylst = $this->holiday_m->get_holiday();
				$this->user_l->login($user, $holidaylst);

				redirect("/");
			}
			else {
				$viewdata["error"] = true;
			}
		}
		$data = array('title' => 'Login - Bakery Order System', 'page' => 'login');
		$this->load->view('header', $data);
		$this->load->view('login', $viewdata);
		$this->load->view('footer');
	}

	public function logout()
	{
		$this->user_l->logout();
		redirect("/");
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */