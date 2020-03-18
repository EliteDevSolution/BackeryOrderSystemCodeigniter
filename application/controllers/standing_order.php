<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Standing_order extends CI_Controller {

	public function check_login()
	{
		if(!UID)
			redirect("login");
	} 

	public function ajax_get_itemlist($priceband)
	{
		$itemlst = $this->standing_order_m->get_items($priceband);
		$rethtml = '';
		$index = -1;
        if(!empty($itemlst))
        { 
          	foreach ($itemlst as $key => $value) { 
            	$index++;
            	if($index == 0) { 
                     $rethtml .= "<optgroup label=".$value->groname.">";     
                } else if($itemlst[$index]->groid != @$itemlst[$index - 1]->groid)
                { 
                      $rethtml .= "<optgroup label=".$value->groname.">";
                }
                    if($value->gst == '1') {
                      	$rethtml .= "<option value=".$value->proid." groupname=".$value->groname." realprice='".$value->userband."' proname='".$value->proname."' price=".$value->userband*1.1." gst=".$value->gst.">".$value->proname."</option>";
                      } else  { 
                         $rethtml .= "<option value=".$value->proid." groupname=".$value->groname." realprice='".$value->userband."' proname='".$value->proname."' price=".$value->userband." gst=".$value->gst.">".$value->proname."</option>";
                     }
             }
   		  }
         echo $rethtml;
     }

    public function save_data()
    {
		$customer_id = $this->input->post('customer_id');
		$savedatalst = json_decode($this->input->post('send-data'), true);
		$res = $this->standing_order_m->save_data($customer_id, $savedatalst);  			
		if($res) echo "ok";
    } 

    public function ajax_get_order_data($userid)
    {
		$orderlst = $this->standing_order_m->get_stand_order($userid);
		$returnHtml = "";
		if(!empty($orderlst) && $orderlst)
		{
			foreach ($orderlst as $key => $value) {
            $returnHtml .= "<tr proid='".$value->proid."' realprice='".$value->realprice."' price='".$value->price."'>";
            $returnHtml .= "<td>".$value->proname."</td>";
            $returnHtml .= "<td><input min=0 type='number' index='1' value='".$value->mon."' style='width: 50px;' onchange=javascript:sumcalculator('table-content',1,7);></td></td>";
            $returnHtml .= "<td><input min=0 type='number' index='1' value='".$value->tue."' style='width: 50px;' onchange=javascript:sumcalculator('table-content',1,7);></td></td>";
            $returnHtml .= "<td><input min=0 type='number' index='1' value='".$value->wed."' style='width: 50px;' onchange=javascript:sumcalculator('table-content',1,7);></td></td>";
            $returnHtml .= "<td><input min=0 type='number' index='1' value='".$value->thu."' style='width: 50px;' onchange=javascript:sumcalculator('table-content',1,7);></td></td>";
            $returnHtml .= "<td><input min=0 type='number' index='1' value='".$value->fri."' style='width: 50px;' onchange=javascript:sumcalculator('table-content',1,7);></td></td>";
            $returnHtml .= "<td><input min=0 type='number' index='1' value='".$value->sat."' style='width: 50px;' onchange=javascript:sumcalculator('table-content',1,7);></td></td>";
            $returnHtml .= "<td><input min=0 type='number' index='1' value='".$value->sun."' style='width: 50px;' onchange=javascript:sumcalculator('table-content',1,7);></td></td>";
            $returnHtml .= "<td></td><td></td>";
            $returnHtml .= "<td><button onclick='javascript:removeRow(this)' class='btn btn-danger btn-small'><i class='btn-icon-only icon-trash'></i></button></td></tr>";  
			}
		}	
		echo $returnHtml;
    }


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

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */