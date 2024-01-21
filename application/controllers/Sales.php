<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sales extends CI_Controller {
    

	 function __construct() {
        parent::__construct();
        $this->load->model("Sales_Model",'sales');
        $this->load->model('Cogs_Model','cogs');
        if(!isset($_SESSION['system']))
        $sess = $this->cogs->system_session();
        if(!isset($_SESSION['user_id']))
        redirect(base_url('login'));

        if(isset($_SESSION['type']) && in_array($_SESSION['type'],array(6,5,4))){
            if($_SESSION['type'] == 5)
            redirect(base_url('order'));
       }
       
        
    }

    public function index(){
        $data['total_sales'] = $this->sales_model->get_total_sales();
        $data['total_amount'] = $this->sales_model->get_total_amount();
        $this->load->view('sales/report', $data);
    }

    function pos1(){
        $data['page_title'] = 'POS';
        $data['page_name'] = 'sales/pos1';
        $this->load->view('index1',$data);
    }

    function save_pos(){
        $resp = $this->sales->save_pos();
        if($resp){
            echo $resp;
        }else{
            echo false;
        }
    }
    function receipt($id = ''){
        $data['id'] = $id;
        $this->load->view('sales/receipt',$data);
    }
    function report($id = ''){
        $data['id'] = $id;
        $this->load->view('sales/report',$data);
    }

    function order_list(){
        $data['page_title'] = 'Order List';
        $data['page_name'] = 'sales/order_list';
        $this->load->view('index',$data);
    }

    function load_olist(){
        $resp = $this->sales->load_olist();
        if($resp)
            echo $resp;
    }

    function view_order($oid = '',$queue =''){
        $data['oid'] = $oid;
        $data['queue'] = $queue;
        $this->load->view('sales/view_order',$data);
    }

    function edit_order($oid='',$queue ='',$kitchen=0){
        $data['oid'] = $oid;
        $data['queue'] = $queue;
        $data['kitchen'] = $kitchen;
        $this->load->view('sales/edit_order',$data);
    }
    function edit_order1($oid='',$queue ='',$kitchen=0){
        $data['oid'] = $oid;
        $data['queue'] = $queue;
        $data['kitchen'] = $kitchen;
        $this->load->view('sales/edit_order1',$data);
    }

    function delete_order(){
        $resp = $this->sales->delete_order();
        if($resp)
        echo $resp;
    }

    function pay_saved(){
        $resp = $this->sales->pay_saved();
        if($resp)
        echo $resp;
    }

    function change_ostatus(){
        $resp = $this->sales->change_ostatus();
        if($resp)
        echo $resp;
    }
}