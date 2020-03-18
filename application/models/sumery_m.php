<?php

class Sumery_m extends CI_Model {

    public $tablename = 'customer';

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    
    function get_sumery_data($userid, $date_range, $priceband)
    {
        $firstdate = trim(explode('-', $date_range)[0]);
        $lastdate = trim(explode('-', $date_range)[1]);
        $strQuery = "SELECT T1.date,T3.name, T2.price, SUM(T2.qty) qty, SUM(TRUNCATE(T2.qty*T2.price,2)) total 
                     FROM `order` AS T1 LEFT JOIN order_item AS T2 ON(T1.id = T2.orderid) 
                     LEFT JOIN product AS T3 ON (T2.productid = T3.id) WHERE T1.customer_id = $userid 
                    AND (DATE(STR_TO_DATE(T1.date,'%d/%m/%Y')) BETWEEN DATE(STR_TO_DATE('$firstdate','%d/%m/%Y'))
                    AND DATE(STR_TO_DATE('$lastdate','%d/%m/%Y'))) GROUP BY T2.productid ORDER BY T1.date DESC";
        return @$this->db->query($strQuery)->result();
    }

    function get_customer_list()
    {
        $this->db->where('role',0);
        return $this->db->get('customer')->result();
    }


    function get_sumery_all_data($orderdate)
    {
        $strQuery = "SELECT T1.date,T3.name, T2.price, SUM(T2.qty) qty, SUM(TRUNCATE(T2.qty*T2.price,2)) total 
                     FROM `order` AS T1 LEFT JOIN order_item AS T2 ON(T1.id = T2.orderid) 
                     LEFT JOIN product AS T3 ON (T2.productid = T3.id) WHERE T1.date = '$orderdate' 
                     GROUP BY T2.productid ORDER BY T1.date DESC";
        return @$this->db->query($strQuery)->result();   
    } 

    function get_order_by_customer($userid, $orderdate)
    {
        $strQuery = "SELECT T1.date,T3.name, T2.price, SUM(T2.qty) qty, SUM(TRUNCATE(T2.qty*T2.price,2)) total 
                     FROM `order` AS T1 LEFT JOIN order_item AS T2 ON(T1.id = T2.orderid) 
                     LEFT JOIN product AS T3 ON (T2.productid = T3.id) WHERE T1.date = '$orderdate' and T1.customer_id = $userid 
                     GROUP BY T2.productid ORDER BY T1.date DESC";
        return @$this->db->query($strQuery)->result();   
    }

}
