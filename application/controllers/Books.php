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
        
         //$this->load->helper('url');
        $this->load->model('books_model','bo_model');
    }
    
    public function list(){
        $view_params = [
            'title' => 'Könyvek listája',
            'records' => $this->bo_model->get_list()
        ];
        
        $this->load->view('books/list',$view_params);
    }
    public function check_buildings_building($param_1, $param_2){
        
        $records = $this->bo_model->get_record_by_booknumber_buildings_id($param_1, $param_2);
        
        if($records == null || empty($records)){
            return TRUE;
        }
        else{
            $this->form_validation->set_message('check_buildings_building', 'A könyv kódja nem egyedi az épület helyén!');
            return FALSE;
        }
    }
    public function insert(){
        $this->load->library('form_validation');
        
        $this->form_validation->set_rules('booknumber', 'Könyv kódja', 'required|callback_check_buildings_building['.$this->input->post('buildings_id').']');
        $this->form_validation->set_rules('name', 'Könyv neve', 'required');
        $this->form_validation->set_rules('buildings_id', 'Könyv épülete', 'required');     
        $this->form_validation->set_rules('active', 'Könyv státusza', 'required');     
        
        
        if($this->form_validation->run() === TRUE){
            if($this->bo_model->insert(
                    $this->input->post('buildings_id'),
                    $this->input->post('booknumber'),
                    $this->input->post('name'),   
                    $this->input->post('active'),
                    empty($this->input->post('description')) ? NULL : $this->input->post('description'),
            )){
                redirect(base_url('books/list'));
            }
                    
        }
        else{
            $this->load->helper('form');

            $this->load->model('buildings_model');
            $list = $this->buildings_model->get_list();
            $buildings = [];
            foreach($list as &$item){
                $buildings[$item->id] = $item->name;
            }

            $view_params = [
                'status' => [ 1 => 'Active', 
                                0 => 'Inactive'], 
                'buildings' => $buildings
            ];
            $this->load->view('books/insert', $view_params);      
        }
    }
    public function update(){}
    public function delete(){}
    
    
    
}
