<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sumery extends CI_Controller {

	public function check_login()
	{
		if(!UID || USERROLE == 0)
			redirect("login");
	} 

	public function get_order_sumery()
	{
		$userid = $this->input->post('userid');
		$date_range = $this->input->post('date_range');
		$priceband = $this->input->post('priceband');
		$res = $this->sumery_m->get_sumery_data($userid, $date_range,$priceband);
		$sendHtml = '';
		$sumtotal = 0;
		
		foreach ($res as $key => $value) 
		{
			$sendHtml.= "<tr>";
			$sendHtml.= "<td>".strval($key+1)."</td>";
			$sendHtml.= "<td>".$value->date."</td>";
			$sendHtml.= "<td>".$value->name."</td>";
			$sendHtml.= "<td>$".$value->price."</td>";
			$sendHtml.= "<td>".$value->qty."</td>";
			$sendHtml.= "<td>$".$value->total."</td>";
			$sendHtml.= "</tr>";
			$sumtotal += $value->total;
		}
		
		$return_data = ['htmldata'=>$sendHtml, 'sumtotal'=>$sumtotal];
		echo json_encode($return_data);
	}
	
	public function get_order_sumery_print()
	{
		$orderdate = $this->input->post('orderdate');
		$res = $this->sumery_m->get_sumery_all_data($orderdate);
		$sendHtml = '';
		$sumtotal = 0;
		if(count($res) == 0)
		{
			$sendHtml = "<tr><td colspan='5' style='text-align:center'>Ordering data not existe.</td></tr>";
			$sumtotal = '0.00';
		} else
		{
			foreach ($res as $key => $value) 
			{
				$sendHtml.= "<tr>";
				$sendHtml.= "<td>".strval($key+1)."</td>";
				$sendHtml.= "<td>".$value->name."</td>";
				$sendHtml.= "<td>$".$value->price."</td>";
				$sendHtml.= "<td>".$value->qty."</td>";
				$sendHtml.= "<td>$".$value->total."</td>";
				$sendHtml.= "</tr>";
				$sumtotal += $value->total;
			}
		}
		$cuslst = $this->sumery_m->get_customer_list();
		$cushtml = "";
		foreach ($cuslst as $key => $row) {
			$name = $row->name;
			$cushtml .= "<table class='table'><thead><th>No.</th><th>$name</th><th> Price </th><th> Quantity </th><th> Total </th></thead><tbody id='table-content'>";
			$orderinfolst = $this->sumery_m->get_order_by_customer($row->id, $orderdate);
			$cussum = 0;
			if(count($orderinfolst) == 0)
			{
				$cushtml .= "<tr style='font-size:13px;'><td colspan='5' style='text-align:center'>No orders today.</td></tr>";
				$cussum = '0.00';
			} else
			{
				foreach ($orderinfolst as $key => $value) {
					$cushtml.= "<tr style='font-size:13px;'>";
					$cushtml.= "<td>".strval($key+1)."</td>";
					$cushtml.= "<td>".$value->name."</td>";
					$cushtml.= "<td>$".$value->price."</td>";
					$cushtml.= "<td>".$value->qty."</td>";
					$cushtml.= "<td>$".$value->total."</td>";
					$cushtml.= "</tr>";
					$cussum += $value->total;
				}
			}
			$cushtml .= "</tbody><tfoot><tr align='right'><td colspan='5' style='text-align: right'><b style='font-size:15px;'><i class='icon-shopping-cart' aria-hidden='true'></i> Total: $<b id='total-sum'>$cussum</b></td></tr></tfoot></table>";
		}
		$return_data = ['htmldata'=>$sendHtml, 'sumtotal'=>$sumtotal,'cushtml' => $cushtml];
		echo json_encode($return_data);	
	}

	public function index()
	{
		$this->check_login();
		$data = array('title' => 'Sumery - Bakery Order System', 'page' => 'sumery');
		$userlst = $this->standing_order_m->get_customer();
		$viewdata = array('userlst' => $userlst);
		$this->load->view('header', $data);
		$this->load->view('sumery/list', $viewdata);
		$this->load->view('footer');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */