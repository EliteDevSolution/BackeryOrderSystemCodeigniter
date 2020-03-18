<?php

class Employee_m extends CI_Model {

    public $tablename = 'customer';

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    
    function get_employees()
    {
        $query = $this->db->from($this->tablename)->get();
        $data = array();

        foreach (@$query->result() as $row)
        {
            $data[] = $row;
        }
        if(count($data))
            return $data;
        return false;
    } 

    function is_exist($column0, $name, $column, $email)
    {
        $this->db->where($column0, $name);
        $this->db->or_where($column, $email);
        $this->db->from($this->tablename);
        $cnt = $this->db->count_all_results();
        if($cnt > 0)
            return true;
        else
            return false;
    }    

    function addEmployee($insertdata, $name, $email)
    {
        if($this->is_exist('name',$name, 'email', $email))
            return false;
        $this->db->insert($this->tablename, $insertdata);
        return $this->db->affected_rows();
    } 

    function deleteEmployee($employee_id)
    {
        $this->db->delete('customer', array('id' => $employee_id));
        return $this->db->affected_rows();
    }

    function editEmployee($id,$updatedata)
    {
        $this->db->where('id', $id);
        $this->db->update($this->tablename, $updatedata); 
    }

    function getEmployee($employee_id)
    {
        $query = $this->db->get_where($this->tablename, array('id' => $employee_id));
        return $query->result();
    }

    function getDepartments()
    {
        $query = $this->db->from('department')->get();
        $data = array();

        foreach ($query->result() as $row)
        {
            $data[] = $row;
            // $row->customer_id
            // $row->customer_username
            // $data[0]->customer_id
        }
        if(count($data))
            return $data;
        return false;
    }   
}
