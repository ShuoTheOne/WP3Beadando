<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Catalogs
 *
 * @author csaba
 */
class Catalogs extends CI_Controller{
    //put your code here
    public function __construct(){
        parent::__construct();
        
         //$this->load->helper('url');
        $this->load->model('catalogs_model','c_model');
    }
    
    public function list(){
        $view_params = [
            'title' => 'Katalógusok listája',
            'records' => $this->c_model->get_list()
        ];
        
        $this->load->view('catalogs/list',$view_params);
    }
    public function insert(){}
    public function update(){}
    public function delete(){}
}
