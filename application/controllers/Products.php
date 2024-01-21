<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Products extends CI_Controller {
    

	 function __construct() {
        parent::__construct();
        $this->load->model('Product_model','product');
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
        header('Location:'.$_SERVER['HTTP_REFERER']);
    }
    
    function product_list(){
        $data['page_title'] = 'Menu List';
        $data['page_name'] = 'product/product_list';
        $this->load->view('index',$data);
    }
    function product_type(){
        $data['page_title'] = 'Menu Category';
        $data['page_name'] = 'product/product_type';
        $this->load->view('index',$data);
    }
    function save_pg(){
        $response = $this->product->save_pg();
        echo $response;
    }

    function get_pg(){
        $response = $this->product->get_pg();
        echo $response;
    }
    function delete_pg(){
        $resp = $this->product->delete_pg();
        if($resp)
        echo 1;
    }
    function remove(){
        $resp = $this->product->remove();
        if($resp)
        echo 1;
    }
    function save_product(){
        $resp = $this->product->save_product();
        echo $resp;
    }
    function get_products(){
        $resp = $this->product->get_products();
        echo $resp;
    }

    function load_pg(){
        $resp = $this->product->load_pg();
        echo $resp;
    }

    

}