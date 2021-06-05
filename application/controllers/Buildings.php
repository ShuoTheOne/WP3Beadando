<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Buildings
 *
 * @author csaba
 */
class Buildings extends CI_Controller{
    //put your code here
    public function __construct(){
        parent::__construct();
        
        $this->load->model('buildings_model','b_model');
    }
    
    public function list(){
        
        $view_params = [
            'title' => 'Épületek listája',
            'records' => $this->b_model->get_list()
        ];
        
        $this->load->view('buildings/list',$view_params);
        
    }
    public function insert(){}
    public function update(){}
    public function delete(){}
    
    
    
}
