<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Catalogs_model
 *
 * @author csaba
 */
class Catalogs_model extends CI_Model{
    
    public function __construct(){
        parent::__construct();
    
        $this->load->database();   
    }
    
    public function get_list(){
            $this->db->select('c.id, c.catalognumber, c.name, bo.name books_name');
            $this->db->from('catalogs c');
            $this->db->join('books bo', 'bo.id = c.books_id', 'inner');
            $this->db->order_by('bo.name','ASC');
            $this->db->order_by('c.name','ASC');
            
            return $this->db->get()->result();
        }
        
    public function get_one($id){
        $this->db->select('c.id, c.catalognumber, c.books_id, c.name,c.description,c.active');
        $this->db->from('catalogs c');
        $this->db->where('id',$id);
        $this->db->where('active',1);
        
        return $this->db->get()->row();
    }
        
     public function insert($books_id, $catalognumber, $name, $active, $description){
        $record = [
            'books_id' =>  $books_id, 
            'catalognumber'       =>  $catalognumber, 
            'name'       =>  $name, 
            'active'     =>  $active, 
            'description'    =>  $description
        ];
        
        $this->db->insert('catalogs', $record);
        return $this->db->insert_id();
    }
    
    public function delete($id){
        $this->db->where('id',$id);
        $this->db->where('active',1);
       return $this->db->delete('catalogs');
    }
    
    public function update($id, $name, $description, $active){
        $record = [
            'name' => $name,
            'description' => $description,
            'active' => $active
        ];
        
        $this->db->where('id', $id);
        return $this->db->update('catalogs',$record);
    }
    
    public function get_record_by_catalognumber_books_id($catalognumber, $books_id){
        $this->db->select('*');
        $this->db->from('catalogs');
        $this->db->where('catalognumber', $catalognumber);
        $this->db->where('books_id', $books_id);
        
        return $this->db->get()->result();
    }
}
