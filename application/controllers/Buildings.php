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
        
        if( !$this->ion_auth->logged_in('auth')){
            redirect(base_url());
        }
        
        // $this->load->helper('url');
        $this->load->model('buildings_model','b_model');
    }
    
    public function index($buildings_id = NULL) //listázás
    {
        $this->load->helper('url'); // központilag betölteni, hiszen ez az if ágon kívül is kell
        if($buildings_id == NULL)
        {
        $view_params = [
          'title'   => 'Épületek listája',
          'records' => $this->b_model->get_list()
        ];
        
        $this->load->view('buildings/list', $view_params);
        }
        else{ //részletes nézet
            if(!is_numeric($buildings_id)){
                show_error('Nem helyes paraméterérték');
            }
            
            $record = $this->b_model->get_one($buildings_id);
            
            if($record == NULL || empty($record)) {
                show_error('Az id-vel nem létezik aktív rekord');
            }
            
            $view_params = [
                'title' => 'Részletes rekordatatok',
                'record' => $record
            ];
 
            $this->load->view('buildings/show',$view_params);     
        } 
    }
    
    public function check_library_building($param_1, $param_2){
        
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
        if(!$this->ion_auth->in_group(['admin','epitesz'],false,false)){
            redirect(base_url());
        }
        
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
     public function update($buildings_id = NULL){
        $this->load->helper('url');
        if($buildings_id == NULL){
            redriect(base_url('buildings/list'));
        }
        if(!is_numeric($buildings_id)){
            redirect(base_url('buildings/list'));
        }
        
        $record = $this->b_model->get_one($buildings_id);
        
        if($record == NULL || empty($record)){
            redirect(base_url('buildings/list'));
        }
        
        $this->load->library('form_validation');
        $this->form_validation->set_rules('buildings_name','Épület neve', 'required|min_length[2]');
        $this->form_validation->set_rules('buildings_active','Épület státusza', 'required');
        
        if($this->form_validation->run() == TRUE){
            $name = $this->input->post('buildings_name');
            $description = !empty($this->input->post('buildings_description')) ? $this->input->post('buildings_description') : NULL;
            $active=$this->input->post('buildings_active');
            
            if($this->b_model->update($buildings_id,$name,$description,$active)){
                redirect(base_url('buildings/list'));
            }
            else{
                show_error('Sikertelen frissítés!');
            }
         }
        else{
             $view_params = [
              'record' => $record,
              'status'=> [1=>'Active', 0=>'Inactive']
          ];
        
          $this->load->helper('form');
          $this->load->view('buildings/edit', $view_params);
        }
        
   
    }
        public function delete($buildings_id = NULL) {
        if(!$this->ion_auth->is_admin()){
            redirect(base_url());
        }
            
        $this->load->helper('url'); // mindig töltsük be a helpert, ha pl. redirectelünk
        if($buildings_id==NULL){
            redirect(base_url('buildings/list'));
        }
        
        if(!is_numeric($buildings_id)){
            redirect(base_url('buildings/list'));
        }
        
        $record=$this->b_model->get_one($buildings_id);
        if($record == NULl || empty($record)){
            redirect(base_url('buildings/list'));
        }
        
      if(  $this->b_model->delete($buildings_id)){
          redirect(base_url('buildings/list'));
      }
      else{
          show_error('A törlés sikertelen!');
      }
        
    }
    
    
    
}
