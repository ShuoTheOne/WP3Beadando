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
        
        if( !$this->ion_auth->logged_in()){
            redirect(base_url('auth'));
        }
        
         //$this->load->helper('url');
        $this->load->model('books_model','bo_model');
    }
    
    public function index($books_id = NULL) //listázás
    {
        $this->load->helper('url'); // központilag betölteni, hiszen ez az if ágon kívül is kell
        if($books_id == NULL)
        {
        $errors=[];
        if($this->session->has_userdata('errors')){
            $errors=$this->session->userdata['errors'];
            $this->session->unset_userdata('errors');
        }
        $view_params = [
          'title'   => 'Könyvek listája',
          'records' => $this->bo_model->get_list(),
          'errors'  => $errors
        ];
        
        $this->load->view('books/list', $view_params);
        }
        else{ //részletes nézet
            if(!is_numeric($books_id)){
                show_error('Nem helyes paraméterérték');
            }
            
            $record = $this->bo_model->get_one($books_id);
            
            if($record == NULL || empty($record)) {
                show_error('Az id-vel nem létezik aktív rekord');
            }
            
            $view_params = [
                'title' => 'Részletes rekordatatok',
                'record' => $record
            ];
 
            $this->load->view('books/show',$view_params);     
        } 
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
        if(!$this->ion_auth->in_group(['admin','szerzo'],false,false)){
            redirect(base_url());
        }
        
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
    public function update($books_id = NULL){
        $this->load->helper('url');
        if($books_id == NULL){
            redriect(base_url('books/list'));
        }
        if(!is_numeric($books_id)){
            redirect(base_url('books/list'));
        }
        
        $record = $this->bo_model->get_one($books_id);
        
        if($record == NULL || empty($record)){
            redirect(base_url('books/list'));
        }
        
        $this->load->library('form_validation');
        $this->form_validation->set_rules('books_name','Katalógus neve', 'required|min_length[2]');
        $this->form_validation->set_rules('books_active','Katalógus státusza', 'required');
        
        if($this->form_validation->run() == TRUE){
            $name = $this->input->post('books_name');
            $description = !empty($this->input->post('books_description')) ? $this->input->post('books_description') : NULL;
            $active=$this->input->post('books_active');
            
            if($this->bo_model->update($books_id,$name,$description,$active)){
                redirect(base_url('books/list'));
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
          $this->load->view('books/edit', $view_params);
        }
        
   
    }
     public function delete($books_id = NULL) {
        if(!$this->ion_auth->is_admin()){
            $errors=[
                'Nincs jogosultságod a könyvek törlésére! Ezt csak admin teheti meg!'
            ];
            $this->session->set_userdata(['$errors'=>$errors]);
            redirect(base_url('books/list'));
        }
         
        $this->load->helper('url'); // mindig töltsük be a helpert, ha pl. redirectelünk
        if($books_id==NULL){
            redirect(base_url('books/list'));
        }
        
        if(!is_numeric($books_id)){
            redirect(base_url('books/list'));
        }
        
        $record=$this->bo_model->get_one($books_id);
        if($record == NULl || empty($record)){
            redirect(base_url('books/list'));
        }
        
      if(  $this->bo_model->delete($books_id)){
          redirect(base_url('books/list'));
      }
      else{
          show_error('A törlés sikertelen!');
      }
        
    }
    
    
    
}
