<?php

class Product_m extends CI_Model {

    public $tablename = 'product';

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    
    function get_product()
    {
        $query = $this->db->query("Select T1.id,T1.name proname,T2.name groupname, T1.pricea, T1.priceb, T1.pricec, T1.priced, T1.gst, T1.description,T2.id groupid from product AS T1 left join product_group AS T2 ON(T1.groupid = T2.id)");
        $data = array();
        foreach (@$query->result() as $row)
        {
            $data[] = $row;
        }
        if(count($data))
            return $data;
        return false;
    } 

   function is_exist($column0, $parentid, $column, $value)
    {
        $this->db->where($column0, $parentid);
        $this->db->where($column, $value);
        $this->db->from($this->tablename);
        $cnt = $this->db->count_all_results();
        if($cnt > 0)
            return true;
        else
            return false;
    } 

    function save_change_value($id, $name, $value)   
    {
        $this->db->where('id',$id);
        $this->db->update($this->tablename, [$name => $value]);
    }

    function add_product($insertdata, $parentid, $name)
    {
        if($this->is_exist('groupid',$parentid, 'name', $name))
            return false;
       $this->db->insert($this->tablename, $insertdata);
       return $this->db->affected_rows();
    }

    function edit_product($id, $updatedata)
    {
        $this->db->where('id', $id);
        $this->db->update($this->tablename, $updatedata); 
    }

    function delete_product($id)
    {
        $this->db->delete($this->tablename, array('id' => $id));
        return $this->db->affected_rows();
    }

    function getOneProduct($id)
    {
        $query = $this->db->get_where($this->tablename, array('id' => $id));
        return $query->result();
    }

}
