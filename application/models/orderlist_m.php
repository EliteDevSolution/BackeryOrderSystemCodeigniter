<?php

class Orderlist_m extends CI_Model {

    public $tablename = 'customer';

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    
    function get_list()
    {
       $strwhere = '';
       $userid = UID;
       if(USERROLE == 0) $strwhere = "where T2.id = $userid ";
       $strQuery = "SELECT T1.id, T1.customer_id, T1.date orderdate, T2.name username, T2.email, T2.businessname,T2.priceband , T1.state FROM `order` AS T1 LEFT JOIN customer AS T2 ON(T1.`customer_id`= T2.`id`) $strwhere
            ORDER BY T1.date DESC"; 
       return @$this->db->query($strQuery)->result();     
    }

    function state_changed($orderid)
    {
        $this->db->where('id', $orderid);
        $this->db->update('order', ['state'=>'COMPLETE']); 
    }

    function delete_order($id)
    {   
        $this->db->delete('order', array('id' => $id));
        $this->db->delete('order_item', array('orderid' => $id));
    }

    function get_order_info($orderid)
    {
        return $this->db->query("SELECT T1.id orderid, T1.*,T2.* FROM `order` AS T1 LEFT JOIN customer AS T2 ON(T1.`customer_id` = T2.`id`) WHERE T1.id = $orderid")->result();
    }

    function get_order_list($orderid)
    {
        //return $this->db->where('orderid', $orderid)->get('order_item')->result();
    }

}
