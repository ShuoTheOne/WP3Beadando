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
        
        // $this->load->helper('url');
        $this->load->model('buildings_model','b_model');
    }
    
    public function list(){
        
        $view_params = [
            'title' => 'Épületek listája',
            'records' => $this->b_model->get_list()
        ];
        
        $this->load->view('buildings/list',$view_params);
        
    }
    
    public function check_library_building($param_1, $param_2){
        //$param_3 = $this->input->post('campus_id');
        //var_dump($param_3);
        
        $records = $this->b_model->get_record_by_kod_library_id($param_1, $param_2);
        
        if($records == null || empty($records)){
            return TRUE;
        }
        else{
            $this->form_validation->set_message('check_library_building', 'Az épület kódja nem egyedi a könyvtár helyén!');
            return FALSE;
        }
    }
    public function insert(){
        $this->load->library('form_validation');
        
        $this->form_validation->set_rules('kod', 'Épület kódja', 'required|callback_check_library_building['.$this->input->post('library_id').']');
        $this->form_validation->set_rules('name', 'Épület neve', 'required');
        $this->form_validation->set_rules('library_id', 'Épület helye', 'required');     
        $this->form_validation->set_rules('active', 'Épület státusza', 'required');     
        
        
        if($this->form_validation->run() === TRUE){
            if($this->b_model->insert(
                    $this->input->post('library_id'),
                    $this->input->post('kod'),
                    $this->input->post('name'),   
                    $this->input->post('active'),
                    empty($this->input->post('description')) ? NULL : $this->input->post('description'),
            )){
                redirect(base_url('buildings/list'));
            }
                    
        }
        else{
            $this->load->helper('form');

            $this->load->model('library_model');
            $list = $this->library_model->get_list();
            $libraries = [];
            foreach($list as &$item){
                $libraries[$item->id] = $item->name;
            }

            $view_params = [
                'status' => [ 1 => 'Active', 
                                0 => 'Inactive'], 
                'libraries' => $libraries
            ];
            $this->load->view('buildings/insert', $view_params);      
        }
    }
    public function update(){}
    public function delete(){}
    
    
    
}
