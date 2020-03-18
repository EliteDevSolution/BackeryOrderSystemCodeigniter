<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Order extends CI_Controller {

	public function check_login()
	{
		if(!UID)
			redirect("login");
	} 

	public function index()
	{
		$this->check_login();
		$userlst = $this->standing_order_m->get_customer();
		$viewdata = array('userlst' => $userlst);
		$data = array('title' => 'Order - Bakery Order System', 'page' => 'order');
		$this->load->view('header', $data);
		$this->load->view('order/add', $viewdata);
		$this->load->view('footer');
	}

	public function edit($orderid, $customer_id,$day,$mon,$year)
	{
		$this->check_login();
		$orderdate = "$day/$mon/$year";
		$viewdata = array();
		$viewdata['orderid']  = $orderid;
		$orderinfo =$this->orderlist_m->get_order_info($orderid);
		$orderflag = $this->order_m->ispreviousdate($orderdate);
		if($orderinfo[0]->state == 'COMPLETE' || $orderflag) redirect("/orderlist"); // The order status is completed or today is 1 or 2 days before the order date.
		$viewdata['orderdate'] = $orderdate;
		$userlst = $this->standing_order_m->get_customer($customer_id);
		$viewdata['userlst'] = $userlst;
		$data = array('title' => 'Order Edit- Bakery Order System', 'page' => 'order');
		$this->load->view('header', $data);
		$this->load->view('order/add', $viewdata);
		$this->load->view('footer');
	}

	public function add_cart()
	{
		$cartid = $this->input->post('cartid');
		$customer_id = $this->input->post('customer_id');
		$cartlst = json_decode($this->input->post('cartlst'), true);
		$cartitemlst = json_decode($this->input->post('cartitemlst'), true);
		$res = $this->order_m->save_cart($customer_id, $cartlst, $cartitemlst,$cartid);
		if($res) echo "ok";
	}

	public function place_order()
	{
		if($this->input->post('orderid'))
		{
			 $orderid  = $this->input->post('orderid');
			 $customer_id = $this->input->post('customer_id');
			 $orderinfo = $this->orderlist_m->get_order_info($orderid);
			 if($orderinfo[0]->state == 'COMPLETE') 
			 {
			 	echo 'complete';
			 	exit;
			 }
			 $orderlst = json_decode($this->input->post('orderlst'), true);
			 $orderitemlst = json_decode($this->input->post('orderitemlst'), true);
			 $res = $this->order_m->plcae_ordering_update($customer_id, $orderlst, $orderitemlst, $orderid);
			 if($res) echo $res;				
		} else
		{
			 $customer_id = $this->input->post('customer_id');
			 $orderlst = json_decode($this->input->post('orderlst'), true);
			 $orderitemlst = json_decode($this->input->post('orderitemlst'), true);
			 $res = $this->order_m->plcae_ordering($customer_id, $orderlst, $orderitemlst);
			 if($res) echo $res;			
		}
	} 

	public function get_order_data($orderid)
	{
		$userid = $this->input->post('userid');
		$orderdate = $this->input->post('orderdate');
		$lastdayflag = $this->order_m->ispreviousdate($orderdate); //first flag
		$holidaylst = $this->session->userdata('holidaylst');
		$holiday_reason = '';	//holiday flag
		foreach ($holidaylst as $key => $value) {
			if($this->order_m->isholiday($orderdate, $value->firstdate, $value->lastdate) && $value->customer_id == $userid)
			{
				$holiday_reason = $value->title;break;
			}
		}
		 if(!empty($holiday_reason))
		{
			$return_data = ['orderid'=>0, 'htmldata'=>'','state' => $holiday_reason];
			echo json_encode($return_data);exit;
		} 
		
		$inserthtml = '';
		$neworderid = $orderid;
		$res = [];
		if($orderid != 0)
		{
			$res = $this->order_m->get_order_items($orderid);
		} else
		{
			$res = $this->order_m->get_order_items_event($userid, $orderdate);
			if(empty($res))
			{
				if($this->order_m->islastdate($orderdate))
				{
					$return_data = ['orderid'=>$neworderid, 'htmldata'=>$inserthtml,'state' => 'orderday_true'];
					echo json_encode($return_data);exit;	
				}
				$neworderid = $this->order_m->standingorder_to_order($userid, $orderdate);
				$res = $this->order_m->get_order_items($neworderid);
			} else
			{
				$neworderid = $res[0]->orderid;

			}
		}
		foreach ($res as $key => $value) {
				$proid = $value->productid;
				$price = $value->price;
				$realprice = $value->realprice;
				$groname = $value->groupname;
				$proname = $value->productname;
				$tax = $value->tax;
				$curval = $value->qty;
				$inserthtml.= "<tr proid='$proid' price='$price' realprice='$realprice'>
	                                <td groupname style='display:none;'>$groname</td>
	                                <td proname>$proname</td>
	                                <td>$$realprice</td>
	                                <td>$tax</td>
	                                <td><input min='0' type='number' value='$curval' style='width: 50px;' 
	                                onchange=javascript:ordercalculator('table-content',4,5);/></td>
	                                <td></td>
	                                <td><button onclick='javascript:removeOrderRow(this)' class='btn btn-danger btn-small'><i class='btn-icon-only icon-trash'> </i></button></td></tr>";		

		}
		$orderinfo = $this->orderlist_m->get_order_info($neworderid);
		if($orderid != 0)
		{
			if($lastdayflag)
			{
				$return_data = ['orderid'=>$neworderid, 'htmldata'=>$inserthtml,'state' => 'lastday_true'];
				echo json_encode($return_data);exit;
			}
		} else
		{
			if($this->order_m->islastdate($orderdate))
			{
				$return_data = ['orderid'=>$neworderid, 'htmldata'=>$inserthtml,'state' => 'orderday_true'];
				echo json_encode($return_data);exit;	
			}
		}
		$return_data = ['orderid'=>$neworderid,'htmldata'=>$inserthtml,'state' => $orderinfo[0]->state];
		echo json_encode($return_data);
	}

	public function cronjob()
	{
		if($this->input->get('hash') == '82340fbd7caa2334a21a5f40e5d4c0f6fccd21c')
		{
			$this->order_m->cron_standingorder_to_order();
		} 
	}

	public function get_cart_data($cartid)
	{
		$res = $this->order_m->get_cart_items($cartid);
		$inserthtml = '';
		foreach ($res as $key => $value) {
			$proid = $value->productid;
			$price = $value->price;
			$realprice = $value->realprice;
			$groname = $value->groupname;
			$proname = $value->productname;
			$tax = $value->tax;
			$curval = $value->qty;
			$inserthtml.= "<tr proid='$proid' price='$price' realprice='$realprice'>
								<td groupname style='display:none;'>$groname</td>
                                <td proname>$proname</td>
                                <td>$$realprice</td>
                                <td>$tax</td>
                                <td><input min='0' type='number' value='$curval' style='width: 50px;' 
                                onchange=javascript:ordercalculator('table-content',4,5);/></td>
                                <td></td>
                                <td><button onclick='javascript:removeOrderRow(this)' class='btn btn-danger btn-small'><i class='btn-icon-only icon-trash'> </i></button></td></tr>";		

		}
		echo $inserthtml;
	}

	public function remove_cart($cartid)
	{
		$this->order_m->remove_cart_data($cartid);
	}

	public function reset_cart($orderid)
	{
		$orderinfo =$this->orderlist_m->get_order_info($orderid);
		if($orderinfo[0]->state == 'COMPLETE') 
		{
			echo 'no';exit;
		}
		$this->orderlist_m->delete_order($orderid);
		echo 'ok'; 
	}

	public function ajax_get_order_data($userid)
	{
		$return_data = [];
		$cartlst = $this->order_m->get_cardlist($userid);
		$inserthtml = '<option value=0 selected>New Cart</option>';
		foreach ($cartlst as $key => $value) {
			$inserthtml .= "<option value='".$value->id."'>".$value->name."</option>";
		}
		$return_data['cartlst'] = $inserthtml;
  		echo json_encode($return_data);
	}
	
}	
