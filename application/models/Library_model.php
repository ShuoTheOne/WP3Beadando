<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Library_model
 *
 * @author csaba
 */
class Library_model extends CI_Model{
    public function __construct(){
        parent::__construct();
    
        $this->load->database();
        //innen $this->db     
    }
    
    public function get_list()
    {
       // SELECT id,name FROM `libraries` WHERE active = 1 ORDER BY name ASC
        
       $this->db->select('l.id,l.name');
       $this->db->from('libraries l');
       $this->db->where('l.active',1);
       $this->db->order_by('l.name','ASC');
       
       return $this->db->get()->result();
    }
    
    
    public function get_one($id){
        $this->db->select('l.id,l.name,l.description,l.active');
        $this->db->from('libraries l');
        $this->db->where('id',$id);
        $this->db->where('active',1);
        
        return $this->db->get()->row();
    }
    
    public function delete($id){
        $this->db->where('id',$id);
        $this->db->where('active',1);
       return $this->db->delete('libraries');
    }
}
