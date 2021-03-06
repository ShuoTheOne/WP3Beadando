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
            $this->db->select('bo.id, bo.booknumber, bo.name, b.name buildings_name');
            $this->db->from('books bo');
            $this->db->join('buildings b', 'b.id = bo.buildings_id', 'inner');
            $this->db-> order_by('b.name','ASC');
            $this->db->order_by('bo.name','ASC');
            
            return $this->db->get()->result();
        }
        
    public function get_one($id){
        $this->db->select('bo.id, bo.booknumber, bo.buildings_id, bo.name,bo.description,bo.active');
        $this->db->from('books bo');
        $this->db->where('id',$id);
        $this->db->where('active',1);
        
        return $this->db->get()->row();
    }
        
         public function insert($buildings_id, $booknumber, $name, $active, $description){
        $record = [
            'buildings_id' =>  $buildings_id, 
            'booknumber'       =>  $booknumber, 
            'name'       =>  $name, 
            'active'     =>  $active, 
            'description'    =>  $description
        ];
        
        $this->db->insert('books', $record);
        return $this->db->insert_id();
    }
    
    public function delete($id){
        $this->db->where('id',$id);
        $this->db->where('active',1);
       return $this->db->delete('books');
    }
    
    public function update($id, $name, $description, $active){
        $record = [
            'name' => $name,
            'description' => $description,
            'active' => $active
        ];
        
        $this->db->where('id', $id);
        return $this->db->update('books',$record);
    }
    
    public function get_record_by_booknumber_buildings_id($booknumber, $buildings_id){
        $this->db->select('*');
        $this->db->from('books');
        $this->db->where('booknumber', $booknumber);
        $this->db->where('buildings_id', $buildings_id);
        
        return $this->db->get()->result();
    }
}
