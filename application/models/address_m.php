<?php

class Address_m extends CI_Model {

    public $tablename = 'address';
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    
    function get_address()
    {
        $query = $this->db->from('address')->get();
        $data = array();

        foreach (@$query->result() as $row)
        {
            $data[] = $row;
        }
        if(count($data))
            return $data;
        return false;
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

    function add_address($name, $price)
    {
        if($this->is_exist('address', $name))
            return false;
        $data = array('address' => $name, 'price' => $price);
        $this->db->insert('address', $data);
        return $this->db->affected_rows();
    }

    function edit_address($id, $name, $price)
    {
        $data = array('address' => $name, 'price' => $price);
        $this->db->where('id', $id);
        $this->db->update('address', $data); 
        return true;
    }

    function delete_address($id)
    {
        $this->db->delete('address', array('id' => $id));
        return $this->db->affected_rows();
    }


    function getOneAddress($id)
    {
        $query = $this->db->get_where('address', array('id' => $id));
        return $query->result();
    }

}
