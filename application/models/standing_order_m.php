<?php

class Standing_order_m extends CI_Model {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
   
    public function get_items($priceband)
    {
        $userband  =  $priceband;
        $query = $this->db->query("SELECT T1.id proid,T1.name proname, T2.id groid, T2.name groname, T1.price$userband userband, T1.gst FROM product AS T1 LEFT JOIN product_group AS T2 ON(T1.groupid = T2.id) order by T1.groupid");
        $data = array();
        foreach (@$query->result() as $row)
        {
            $data[] = $row;
        }
        if(count($data))
            return $data;
        return false;
    } 

    function save_data($customer_id,$datalist)
    {
        $this->db->query("DELETE FROM standorders WHERE customer_id='$customer_id'");
        foreach ($datalist as $key => $value) 
        {
            $insertquery = "INSERT INTO standorders VALUE('".$value[0]."',"."'".$value[1]."',"."'".$value[2]."',"."'".$value[3]."',"."'".$value[4]."',"."'".$value[5]."',"."'".$value[6]."',"."'".$value[7]."',"."'".$value[8]."',"."'".$value[9]."', '".$value[10]."')";
            $this->db->query($insertquery);
        }
        return true;
    }

    public function get_stand_order($userid)
    {
        $data = [];
        $query = $this->db->query("SELECT T3.id proid, T1.real_price realprice,T1.price, T4.name groupname,T3.name proname, T1.mon,T1.tue,T1.wed,T1.thu,T1.fri,T1.sat,T1.sun FROM standorders AS T1 LEFT JOIN customer AS T2 ON(T1.customer_id = T2.id) LEFT JOIN product AS T3 ON(T3.id=T1.product_id) LEFT JOIN product_group AS T4 ON(T4.id=T3.groupid) where T1.customer_id=$userid");
        foreach (@$query->result() as $row)
        {
            $data[] = $row;
        }
        if(count($data) > 0)
            return $data;
        return false;
    } 

    public function get_min_userid()
    {
        $this->db->select_min('id');
        $this->db->where('role','0');
        $query = $this->db->get('customer'); // Produces: SELECT MIN(age) as age FROM members
        return $query->result();
    }

    public function get_customer($customer_id = null)
    {
        $data = array();
        if(empty($customer_id)){
            if(USERROLE == 1)
            {
                $query = $this->db->query("SELECT id,LOWER(priceband) priceband,name,deliveryaddress FROM customer WHERE role=0 ORDER BY id");
                foreach (@$query->result() as $row)
                {
                    $data[] = $row;
                }   
            } else
            {
                $data[] = array('id'=>UID,'name'=>USERNAME,'priceband'=>strtolower(USERBAND),'deliveryaddress'=>USERADDRESS);
            }    
        } else
        {
            $query = $this->db->query("SELECT id,LOWER(priceband) priceband,name,deliveryaddress FROM customer WHERE id=$customer_id ORDER BY id");
            foreach (@$query->result() as $row)
            {
                $data[] = $row;
            }   
        }
        if(count($data))
            return $data;
        return false;
    }

}
