<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Library
 *
 * @author csaba
 */
class Library extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        
        $this->load->model('library_model');
    }
    
    public function list($library_id = NULL) //listázás
    {
        $this->load->helper('url'); // központilag betölteni, hiszen ez az if ágon kívül is kell
        if($library_id == NULL)
        {
        $view_params = [
          'title'   => 'Könyvtárak listája',
          'records' => $this->library_model->get_list()
        ];
        
        $this->load->view('library/list', $view_params);
        }
        else{ //részletes nézet
            if(!is_numeric($library_id)){
                show_error('Nem helyes paraméterérték');
            }
            
            $record = $this->library_model->get_one($library_id);
            
            if($record == NULL || empty($record)) {
                show_error('Az id-vel nem létezik aktív rekord');
            }
            
            $view_params = [
                'title' => 'Részletes rekordatatok',
                'record' => $record
            ];
 
            $this->load->view('library/show',$view_params);     
        } 
    }
    
    public function insert() {
        
        $this->load->library('form_validation'); //this->form_validation létrejön
        $this->form_validation->set_rules('library_name','Könyvtár neve', 'required|min_length[2]');
        
        
        if($this->form_validation->run() == TRUE){
            $name=$this->input->post('library_name');
            $description = !empty($this->input->post('library_description')) ? $this->input->post('library_description') : NULL;
            
            $id=$this->library_model->insert($name,$description);
            if($id){
                $this->load->helper('url');
                redirect(base_url('library/list/'.$id));
            }
            else{
                show_error('Hiba a beszúrás során');
            }
            
        }
        else{
            $this->load->helper('form');
            $this->load->view('library/add');
        }
        
        }
    
    public function update(){
        echo 'update';     
    }
    
    public function delete($library_id = NULL) {
        $this->load->helper('url'); // mindig töltsük be a helpert, ha pl. redirectelünk
        if($library_id==NULL){
            redirect(base_url('library/list'));
        }
        
        if(!is_numeric($library_id)){
            redirect(base_url('library/list'));
        }
        
        $record=$this->library_model->get_one($library_id);
        if($record == NULl || empty($record)){
            redirect(base_url('library/list'));
        }
        
      if(  $this->library_model->delete($library_id)){
          redirect(base_url('library/list'));
      }
      else{
          show_error('A törlés sikertelen!');
      }
        
    }
}
