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
            $this->db->select('b.id, b.kod, b.name, l.name library_name');
            $this->db->from('buildings b');
            $this->db->join('libraries l', 'l.id = b.library_id', 'inner');
            $this->db-> order_by('l.name','ASC');
            $this->db->order_by('b.name','ASC');
            
            return $this->db->get()->result();
        }
        
    public function get_one($id){
        $this->db->select('b.id,b.kod, b.library_id, b.name,b.description,b.active');
        $this->db->from('buildings b');
        $this->db->where('id',$id);
        $this->db->where('active',1);
        
        return $this->db->get()->row();
    }
        
        
     public function insert($library_id, $kod, $name, $active, $description){
        $record = [
            'library_id' =>  $library_id, 
            'kod'       =>  $kod, 
            'name'       =>  $name, 
            'active'     =>  $active, 
            'description'    =>  $description
        ];
        
        $this->db->insert('buildings', $record);
        return $this->db->insert_id();
    }
    
    public function get_record_by_kod_library_id($kod, $library_id){
        $this->db->select('*');
        $this->db->from('buildings');
        $this->db->where('kod', $kod);
        $this->db->where('library_id', $library_id);
        
        return $this->db->get()->result();
    }
    
    public function delete($id){
        $this->db->where('id',$id);
        $this->db->where('active',1);
       return $this->db->delete('buildings');
    }
    
    public function update($id, $name, $description, $active){
        $record = [
            'name' => $name,
            'description' => $description,
            'active' => $active
        ];
        
        $this->db->where('id', $id);
        return $this->db->update('buildings',$record);
    }
}
