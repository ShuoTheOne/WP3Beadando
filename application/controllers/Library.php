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
            echo 'insert';
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
