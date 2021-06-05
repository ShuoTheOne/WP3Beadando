<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Books_model
 *
 * @author csaba
 */
class Books_model extends CI_Model{
    
    public function __construct(){
        parent::__construct();
    
        $this->load->database();
    }
    
    public function get_list(){
            $this->db->select('bo.id','bo.booknumber','bo.name','b.name buildings_name');
            $this->db->from('books bo');
            $this->db->join('buildings b', 'b.id = bo.buildings_id', 'inner');
            $this->db-> order_by('b.name','ASC');
            $this->db->order_by('bo.name','ASC');
            
            return $this->db->get()->result();
        }
}
