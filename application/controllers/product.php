<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Product extends CI_Controller {

	public function check_login()
	{
		if(!UID || USERROLE == 0)
			redirect("login");
	} 

	public function add()
	{
		$this->check_login();
		$viewdata = array();
		$product_name = $this->input->post('product_name');
		$price_a = $this->input->post('price_a');
		$price_b = $this->input->post('price_b');
		$price_c = $this->input->post('price_c');
		$price_d = $this->input->post('price_d');
		$tax = $this->input->post('tax');
		$desc = $this->input->post('desc');
		$groupid = $this->input->post('group_name');
		if($product_name && $price_a &&  $price_b)
		{
			$insertdata = [
				'name'=>$product_name,
				'pricea'=>$price_a,
				'priceb'=>$price_b,
				'pricec'=>$price_c,
				'priced'=>$price_d,
				'gst'=>$tax,
				'description'=>$desc,
				'groupid'=>$groupid
			];
			$res = $this->product_m->add_product($insertdata, $groupid, $product_name);
			if(!$res) 
				$viewdata['error'] = "Product already exist.";
			else
				redirect("/product");
		}
		$data = array('title' => 'Add Product - Bakery Order System', 'page' => 'product');
		$grouplst = $this->product_group_m->get_group();
		$viewdata['grouplst'] = $grouplst;
		if(!empty($insertdata)) $viewdata['data'] = $insertdata;
		$this->load->view('header', $data);
		$this->load->view('product/add', $viewdata);
		$this->load->view('footer');
	}

	public function change_value()
	{
		$id = $this->input->post('sendid');
		$fieldname = $this->input->post('filedname');
		$value = $this->input->post('value');
		if(!empty($id) && !empty($fieldname) && !empty($value))
		{
			$this->product_m->save_change_value($id,$fieldname,$value);
		}
	}

	function delete($id)
	{
		$this->product_m->delete_product($id);
		redirect("/product");
	}

	public function edit($id)
	{
		$this->check_login();
		$product_name = $this->input->post('product_name');
		$price_a = $this->input->post('price_a');
		$price_b = $this->input->post('price_b');
		$price_c = $this->input->post('price_c');
		$price_d = $this->input->post('price_d');
		$tax = $this->input->post('tax');
		$desc = $this->input->post('desc');
		$groupid = $this->input->post('group_name');
		if($product_name && $price_a &&  $price_b)
		{
			$updatedata = [
				'name'=>$product_name,
				'pricea'=>$price_a,
				'priceb'=>$price_b,
				'pricec'=>$price_c,
				'priced'=>$price_d,
				'gst'=>$tax,
				'description'=>$desc,
				'groupid'=>$groupid
			];

			$this->product_m->edit_product($id, $updatedata);
			redirect("/product");
		}
		
		$data = array('title' => 'Edit Product - Bakery Order System', 'page' => 'product');
		$this->load->view('header', $data);

		$productLst = $this->product_m->getOneProduct($id);
		$grouplst = $this->product_group_m->get_group();
		$viewdata = array('data'  => $productLst[0]);
		$viewdata['grouplst'] = $grouplst;
		$this->load->view('product/edit',$viewdata);
		$this->load->view('footer');
	}

	public function index()
	{
		$this->check_login();
		$productlst = $this->product_m->get_product();
		$viewdata = array('product' => $productlst);
		$data = array('title' => 'Product - Bakery Order System', 'page' => 'product');
		$this->load->view('header', $data);
		$this->load->view('product/list',$viewdata);
		$this->load->view('footer');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */