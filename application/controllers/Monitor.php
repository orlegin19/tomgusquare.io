<?php


if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Monitor extends CI_Controller {

 function __construct() {
        parent::__construct();
        $this->load->model('Kitchen_Model','kitchen');
        $this->load->model('Cogs_Model','cogs');
    }

        public function index(){
            $data['page_title'] = 'Monitor';
            $data['page_name'] = 'order_list';
            $this->load->view('monitor/index',$data);
        }

        function load_orders(){
        $resp = $this->kitchen->load_orders();
        if($resp)
        echo $resp;
        }

}
