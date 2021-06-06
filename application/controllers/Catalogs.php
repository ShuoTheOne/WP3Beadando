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
    
    public function index($catalogs_id = NULL) //listázás
    {
        $this->load->helper('url'); // központilag betölteni, hiszen ez az if ágon kívül is kell
        if($catalogs_id == NULL)
        {
        $view_params = [
          'title'   => 'Katalógusok listája',
          'records' => $this->c_model->get_list()
        ];
        
        $this->load->view('catalogs/list', $view_params);
        }
        else{ //részletes nézet
            if(!is_numeric($catalogs_id)){
                show_error('Nem helyes paraméterérték');
            }
            
            $record = $this->c_model->get_one($catalogs_id);
            
            if($record == NULL || empty($record)) {
                show_error('Az id-vel nem létezik aktív rekord');
            }
            
            $view_params = [
                'title' => 'Részletes rekordatatok',
                'record' => $record
            ];
 
            $this->load->view('catalogs/show',$view_params);     
        } 
    }
     public function check_books_catalog($param_1, $param_2){
        
        $records = $this->c_model->get_record_by_catalognumber_books_id($param_1, $param_2);
        
        if($records == null || empty($records)){
            return TRUE;
        }
        else{
            $this->form_validation->set_message('check_books_catalog', 'A könyv kódja nem egyedi a katalógusban!');
            return FALSE;
        }
    }
    public function insert(){
        $this->load->library('form_validation');
        
        $this->form_validation->set_rules('catalognumber', 'Katalógus kódja', 'required|callback_check_books_catalog['.$this->input->post('books_id').']');
        $this->form_validation->set_rules('name', 'Katalógus neve', 'required');
        $this->form_validation->set_rules('books_id', 'Könyvének helye', 'required');     
        $this->form_validation->set_rules('active', 'Katalógus státusza', 'required');     
        
        
        if($this->form_validation->run() === TRUE){
            if($this->c_model->insert(
                    $this->input->post('books_id'),
                    $this->input->post('catalognumber'),
                    $this->input->post('name'),   
                    $this->input->post('active'),
                    empty($this->input->post('description')) ? NULL : $this->input->post('description'),
            )){
                redirect(base_url('catalogs/list'));
            }
                    
        }
        else{
            $this->load->helper('form');

            $this->load->model('books_model');
            $list = $this->books_model->get_list();
            $books = [];
            foreach($list as &$item){
                $books[$item->id] = $item->name;
            }

            $view_params = [
                'status' => [ 1 => 'Active', 
                                0 => 'Inactive'], 
                'books' => $books
            ];
            $this->load->view('catalogs/insert', $view_params);      
        }
    }
    public function update($catalogs_id = NULL){
        $this->load->helper('url');
        if($catalogs_id == NULL){
            redriect(base_url('catalogs/list'));
        }
        if(!is_numeric($catalogs_id)){
            redirect(base_url('catalogs/list'));
        }
        
        $record = $this->c_model->get_one($catalogs_id);
        
        if($record == NULL || empty($record)){
            redirect(base_url('catalogs/list'));
        }
        
        $this->load->library('form_validation');
        $this->form_validation->set_rules('catalogs_name','Katalógus neve', 'required|min_length[2]');
        $this->form_validation->set_rules('catalogs_active','Katalógus státusza', 'required');
        
        if($this->form_validation->run() == TRUE){
            $name = $this->input->post('catalogs_name');
            $description = !empty($this->input->post('catalogs_description')) ? $this->input->post('catalogs_description') : NULL;
            $active=$this->input->post('catalogs_active');
            
            if($this->c_model->update($catalogs_id,$name,$description,$active)){
                redirect(base_url('catalogs/list'));
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
          $this->load->view('catalogs/edit', $view_params);
        }
        
   
    }
    public function delete($catalogs_id = NULL) {
        $this->load->helper('url'); // mindig töltsük be a helpert, ha pl. redirectelünk
        if($catalogs_id==NULL){
            redirect(base_url('catalogs/list'));
        }
        
        if(!is_numeric($catalogs_id)){
            redirect(base_url('catalogs/list'));
        }
        
        $record=$this->c_model->get_one($catalogs_id);
        if($record == NULl || empty($record)){
            redirect(base_url('catalogs/list'));
        }
        
      if(  $this->c_model->delete($catalogs_id)){
          redirect(base_url('catalogs/list'));
      }
      else{
          show_error('A törlés sikertelen!');
      }
        
    }
    
    
    
}
