<?php


if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Delivery extends CI_Controller {
    
 function __construct() {
        parent::__construct();
        $this->load->model('Delivery_Model','delivery');
        $this->load->model('Cogs_Model','cogs');
        if(!isset($_SESSION['system']))
        $sess = $this->cogs->system_session();
        if(!isset($_SESSION['user_id']))
        redirect(base_url('login'));

        
    }

    public function index(){
        $data['page_title'] = 'Delivery';
        $data['page_name'] = 'home';
        $this->load->view('delivery/index',$data);
    }
    function load_orders(){
        $resp = $this->delivery->load_orders();
        if($resp)
        echo $resp;
    }
    function mark_delivered(){
        $resp = $this->delivery->mark_delivered();
        if($resp){
            echo $resp;
        }
    }

}