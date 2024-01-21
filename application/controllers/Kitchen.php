<?php


if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Kitchen extends CI_Controller {
    
 function __construct() {
        parent::__construct();
        $this->load->model('Kitchen_Model','kitchen');
        $this->load->model('Cogs_Model','cogs');
        if(!isset($_SESSION['system']))
        $sess = $this->cogs->system_session();
        if(!isset($_SESSION['user_id']))
        redirect(base_url('login'));

        if(isset($_SESSION['type']) && in_array($_SESSION['type'],array(5,4))){
            if($_SESSION['type'] == 5)
            redirect(base_url('order'));
       }
    }

        public function index(){
            $data['page_title'] = 'Kitchen';
            $data['page_name'] = 'order_list';
            $this->load->view('kitchen/index',$data);
        }

        function load_orders(){
        $resp = $this->kitchen->load_orders();
        if($resp)
        echo $resp;
        }

}
