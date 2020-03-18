<?php

class Product_group_m extends CI_Model {

    public $tablename = 'product_group';

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    
    function get_group()
    {
        $query = $this->db->from('product_group')->get();
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


    function add_group($name)
    {
        if($this->is_exist('name', $name))
            return false;
        $data = array('name' => $name);
        $this->db->insert('product_group', $data);
        return $this->db->affected_rows();
    }

    function edit_group($id, $name)
    {
        if($this->is_exist('name', $name))
            return false;
        $data = array('name' => $name);
        $this->db->where('id', $id);
        $this->db->update('product_group', $data); 
        return true;
    }

    function delete_group($id)
    {
        $this->db->delete('product_group', array('id' => $id));
        return $this->db->affected_rows();
    }


    function getOneGroup($id)
    {
        $query = $this->db->get_where('product_group', array('id' => $id));
        return $query->result();
    }

}
