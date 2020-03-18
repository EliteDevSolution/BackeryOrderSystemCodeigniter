<?php

class Order_m extends CI_Model {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    
    public function add_reservation($data, $date=NULL)
    {
        $data['reservation_date'] = $date;
        $query = $this->db->insert('reservation', $data);
//        return $query->affected_rows();
    }

    public function save_cart($customer_id, $cartlst, $cartitemlst,$cartid)
    {
        $insercartlst = ['name'=>$cartlst[0],'customer_id'=>$cartlst[1]];
        if($cartid == '0')
        {
            $this->db->insert('cart', $insercartlst);
            $cartid = $this->db->insert_id();
            foreach ($cartitemlst as $key => $value) 
            {
                $insertcartdata = ['cartid'=>$cartid, 'productid'=>$value[0], 'price'=>$value[1], 'tax'=>$value[2], 
                'realprice'=>$value[3], 'qty'=>$value[4]];    
                $this->db->insert('cart_data', $insertcartdata);
            }    
        } else
        {
            $this->db->where('id', $cartid);
            $this->db->update('cart', $insercartlst);
            $this->db->delete('cart_data', array('cartid' => $cartid));
            foreach ($cartitemlst as $key => $value) 
            {
                $insertcartdata = ['cartid'=>$cartid, 'productid'=>$value[0], 'price'=>$value[1], 'tax'=>$value[2], 
                'realprice'=>$value[3], 'qty'=>$value[4]];    
                $this->db->insert('cart_data', $insertcartdata);
            }    
        }
        return true;
    }

    public function plcae_ordering($customer_id, $orderlst, $orderitemlst)
    {
        $inserorderlst = ['customer_id'=>$orderlst[0], 'date'=>$orderlst[1]];
        $this->db->insert('order', $inserorderlst);
        $orderid = $this->db->insert_id();
        foreach ($orderitemlst as $key => $value) 
        {
            $insertorderdata = ['orderid'=>$orderid, 'productid'=>$value[0], 'price'=>$value[1], 'tax'=>$value[2], 
            'realprice'=>$value[3], 'qty'=>$value[4]];    
            $this->db->insert('order_item', $insertorderdata);
        }  
        return $orderid;
    }


    public function plcae_ordering_update($customer_id, $orderlst, $orderitemlst, $orderid)
    {
        $updateorderlst = ['customer_id'=>$orderlst[0], 'date'=>$orderlst[1]];
        $this->db->where('id', $orderid);
        $this->db->update('order', $updateorderlst);
        $this->db->delete('order_item',['orderid'=>$orderid]);
        foreach ($orderitemlst as $key => $value) 
        {
            $insertorderdata = ['orderid'=>$orderid, 'productid'=>$value[0], 'price'=>$value[1], 'tax'=>$value[2], 
            'realprice'=>$value[3], 'qty'=>$value[4]];    
            $this->db->insert('order_item', $insertorderdata);
        }  
        return $orderid;
    }

    public function get_cart_items($cartid)
    {
        $query = $this->db->query("SELECT T1.productid, T3.name groupname,T1.price, T1.realprice, CONCAT(T2.name,', $',T1.price) productname, T1.tax, T1.qty FROM cart_data AS T1 LEFT JOIN product AS T2 ON(T2.id = T1.productid) LEFT JOIN product_group T3 ON(T3.id = T2.groupid) WHERE T1.cartid = $cartid");
        return @$query->result();
    }

    public function get_order_items($orderid)
    {
        $query = $this->db->query("SELECT T1.productid, T3.name groupname,T1.price, T1.realprice, T2.name productname, T1.tax, T1.qty, T1.qty*T1.price total FROM order_item AS T1 LEFT JOIN product AS T2 ON(T2.id = T1.productid) LEFT JOIN product_group T3 ON(T3.id = T2.groupid) WHERE T1.orderid = $orderid");
        return @$query->result();
    }

    public function get_order_items_event($userid, $orderdate)
    {
        $query = $this->db->query("SELECT T1.productid,T1.orderid, T3.name groupname,T1.price, T1.realprice, T2.name productname, T1.tax, T1.qty, T1.qty*T1.price total FROM order_item AS T1 LEFT JOIN product AS T2 ON(T2.id = T1.productid) LEFT JOIN product_group T3 ON(T3.id = T2.groupid) LEFT JOIN `order` AS T4 ON(T1.orderid=T4.id) WHERE T4.date = '$orderdate' and T4.customer_id = '$userid'");
        return @$query->result();   
    }

    public function get_standingorder_to_order($userid, $orderdate)
    {
        $weekday = $this->getweekday($orderdate);
        $strQuery = "SELECT 
                      T1.product_id productid,
                      T3.name groupname,
                      T1.price,
                      T1.real_price realprice,
                      T2.name productname,
                      CONCAT('$',TRUNCATE(T1.price-T1.real_price,2),' (',TRUNCATE((T1.price-T1.real_price)/T1.real_price,1),'%)') tax,
                      T1.$weekday qty,
                      T1.$weekday*T1.price total
                    FROM
                      standorders AS T1 
                      LEFT JOIN product AS T2 
                        ON (T2.id = T1.product_id) 
                      LEFT JOIN product_group T3 
                        ON (T3.id = T2.groupid) 
                    WHERE T1.customer_id = $userid";
        $query = $this->db->query($strQuery);
        return @$query->result();            
    }

    
    public function standingorder_to_order($userid, $orderdate)
    {
        $weekday = $this->getweekday($orderdate);
        ///Insert Order
        if(empty($this->db->query("Select * From standorders where customer_id = $userid")->result()))
            return 0;
        $this->db->insert('order', ['customer_id'=>$userid, 'date'=>$orderdate]);
        $newid = $this->db->insert_id();    
        $strQuery = "INSERT INTO order_item (orderid,productid,price,tax,realprice,qty)
                    SELECT 
                      $newid orderid,    
                      T1.product_id productid,
                      T1.price,
                      CONCAT('$',TRUNCATE(T1.price-T1.real_price,2),' (',TRUNCATE((T1.price-T1.real_price)/T1.real_price,1),'%)') tax,
                      T1.real_price realprice,
                      T1.$weekday qty
                    FROM
                      standorders AS T1 
                      LEFT JOIN product AS T2 
                        ON (T2.id = T1.product_id) 
                    WHERE T1.customer_id = $userid";
        $this->db->query($strQuery);
        return $newid;
    }

    public function cron_standingorder_to_order()
    {
        date_default_timezone_set('Australia/Canberra');
        $today = date('d/m/Y');
        $date = str_replace('/', '-', $today);
        $orderdate = date('d/m/Y', strtotime('+2 day', strtotime($date)));
        $holidaylst = $this->getholiday(); 
        $customerlst = $this->db->query("SELECT * FROM customer WHERE role=0 ORDER BY id")->result();
        foreach ($customerlst as $key => $value) {
            $userid = $value->id;
            $flag = false;
            foreach ($holidaylst as $key => $value) {
                if($this->isholiday($orderdate, $value->firstdate, $value->lastdate) && $userid == $value->customer_id)
                {
                    $flag = true;
                    break;
                }
            }
            if($flag) continue;
            $res = $this->db->query("Select * From `order` where customer_id = $userid and date='$orderdate'")->result();
            if(count($res) == 0)
            {
                $this->standingorder_to_order($userid, $today);
            }            
        }
    }

    public function getholiday()
    {
        return $this->db->get('holiday')->result();
    }

    public function getcustomer()
    {
        return $this->db->get('holiday')->result();
    }

    public function getweekday($dateval)
    {
        $days = array('sun', 'mon', 'tue', 'wed','thu','fri', 'sat');
        $date = str_replace('/', '-', $dateval );
        $newDate = date("Y-m-d", strtotime($date));
        $day = date('w',strtotime($newDate));
        return $days[$day];
    }

    public function isholiday($orderdate, $firstdate, $lastdate)
    {
        $today= $orderdate;
        $firstdate = $firstdate;
        $lastdate = $lastdate;
        $date = str_replace('/', '-', $today );
        $firstdate = str_replace('/', '-', $firstdate );
        $lastdate = str_replace('/', '-', $lastdate );
        $newDate = date("Y-m-d", strtotime($date));
        $firstdate = date('Y-m-d', strtotime($firstdate));
        $lastdate = date('Y-m-d', strtotime($lastdate));
        if ($newDate >= $firstdate && $newDate <= $lastdate)
        {
          return true;
        }else{
          return false;
        }
    }

    public function ispreviousdate($orderdate)
    {
        $today = date('d/m/Y');
        $date = str_replace('/', '-', $orderdate);
        $first_date = date('d/m/Y', strtotime('-1 day', strtotime($date)));
        $second_date =  date('d/m/Y', strtotime('-2 day', strtotime($date)));
        if($today == $first_date || $today == $second_date || $today == $orderdate)
            return true;
        else
            return false;
    }

    public function islastdate($orderdate)
    {
        $today = date('d/m/Y');
        $date = str_replace('/', '-', $today);
        $start_date = date('d/m/Y', strtotime('+2 day', strtotime($date)));
        $date = str_replace('/', '-', $orderdate);
        $orderdate= date('d/m/Y', strtotime($date));
        if($orderdate <= $start_date)
        {
            return true;
        } else
        {
            return false;
        }
    } 

    public function remove_cart_data($cartid)
    {
        $this->db->delete('cart', array('id' => $cartid));
        $this->db->delete('cart_data', array('cartid' => $cartid));
        return $this->db->affected_rows();
    }

    public function remove_cart_all()
    {
        $this->db->query('TRUNCATE cart');
        $this->db->query('TRUNCATE cart_data');
    }

    public function get_cardlist($userid)
    {
        $query = $this->db->query("Select * from cart where customer_id = $userid order by id");
        return @$query->result();

    }

}
