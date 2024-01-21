<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Popup extends CI_Controller {
    

	 function __construct() {
        parent::__construct();
        $this->load->model('Cogs_Model','cogs');
        if(!isset($_SESSION['system']))
        $sess = $this->cogs->system_session();
       
        
    }
    
    public function index(){
        header('Location:'.$_SERVER['HTTP_REFERER']);
    }
    
    function show_data($folder='',$page_name='',$action='',$id=''){
        $data['action'] = $action;
        $data['id'] = $id;
        $this->load->view($folder.'/'.$page_name,$data);
    }

}