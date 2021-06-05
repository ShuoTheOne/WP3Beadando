<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Buildings_model
 *
 * @author csaba
 */
class Buildings_model extends CI_Model{
    
    public function __construct(){
        parent::__construct();
    
        $this->load->database(); 
    }
    
    public function get_list(){
            $this->db->select('b.id','b.kod','b.name','l.name library_name');
            $this->db->from('buildings b');
            $this->db->join('libraries l', 'l.id = b.library_id', 'inner');
            $this->db-> order_by('l.name','ASC');
            $this->db->order_by('b.name','ASC');
            
            return $this->db->get()->result();
        }
}
