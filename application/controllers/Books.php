<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Books
 *
 * @author csaba
 */
class Books extends CI_Controller{
    //put your code here
    public function __construct(){
        parent::__construct();
        
        $this->load->model('books_model','bo_model');
    }
    
    public function list(){
        $view_params = [
            'title' => 'Könyvek listája',
            'records' => $this->bo_model->get_list()
        ];
        
        $this->load->view('books/list',$view_params);
    }
    public function insert(){}
    public function update(){}
    public function delete(){}
}
