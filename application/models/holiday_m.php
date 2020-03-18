<?php

class Holiday_m extends CI_Model {

    public $tablename = 'holiday';
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    
    function get_holiday()
    {
        $query = $this->db->query("SELECT T1.id, T2.name,T2.email,T1.customer_id,T1.title, T1.firstdate, T1.lastdate FROM holiday AS T1 LEFT JOIN customer AS T2 ON(T1.customer_id = T2.id)");
        return @$query->result();
    } 

    function is_exist($column, $value)
    {
        $this->db->where($column, $value);
        $this->db->from($this->tablename);
        $cnt = $this->db->count_all_results();
        if($cnt > 0)
            return true;
        else
            return false;
    }

    function add_holiday($userid, $title, $date_range)
    {
        if($this->is_exist('title', $name))
            return false;
        $firstdate = trim(explode('-', $date_range)[0]);
        $lastdate = trim(explode('-', $date_range)[1]);
        $data = array('customer_id'=>$userid, 'title' => $title, 'firstdate' => $firstdate, 'lastdate' => $lastdate);
        $this->db->insert('holiday', $data);
        return $this->db->affected_rows();
    }

    function edit_holiday($id, $userid, $title, $date_range)
    {
        $firstdate = trim(explode('-', $date_range)[0]);
        $lastdate = trim(explode('-', $date_range)[1]);
        $data = array('customer_id'=>$userid,'title' => $title, 'firstdate' => $firstdate, 'lastdate' => $lastdate);
        $this->db->where('id', $id);
        $this->db->update('holiday', $data); 
        return true;
    }

    function delete_holiday($id)
    {
        $this->db->delete('holiday', array('id' => $id));
        return $this->db->affected_rows();
    }


    function getOneHoliday($id)
    {
        $query = $this->db->get_where('holiday', array('id' => $id));
        return $query->result();
    }

}
