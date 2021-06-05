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
            $this->db->select('c.id','c.catalognumber','c.name','bo.name books_name');
            $this->db->from('catalogs c');
            $this->db->join('books bo', 'books.id = c.books_id', 'inner');
            $this->db-> order_by('bo.name','ASC');
            $this->db->order_by('c.name','ASC');
            
            return $this->db->get()->result();
        }
}
