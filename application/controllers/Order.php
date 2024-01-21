<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order extends CI_Controller {
    

	 function __construct() {
        parent::__construct();
        $this->load->model('Order_Model','order');
        $this->load->model('Cogs_Model','cogs');
        if(!isset($_SESSION['system']))
        $sess = $this->cogs->system_session();
        if(!isset($_SESSION['user_id']))
        redirect(base_url('login'));
       
    }

    public function index(){
        $data['page_name'] = 'home';
        $data['page_title'] = 'Home';
        $this->load->view('ordering/index',$data);
    }

    function p_load(){
        $resp = $this->order->p_load();
        if($resp)
            echo $resp;
    }
     function manage_user($id = '',$my_account = ''){
        $data['id'] = $id;
        $data['my_account'] = $my_account;

        $this->load->view('users/manage_user',$data);
    }

    function load_pg(){
        $resp = $this->order->load_pg();
        if($resp){
            echo $resp;
        }
    }
    function get_prod_details(){
        $data['id'] = $_POST['id'];
        $this->load->view('ordering/order_desc',$data);
    }

    function save_to_cart(){
        $resp = $this->order->save_to_cart();
        if($resp)
        echo $resp;
    }

    function cart_list(){
        $data['page_name'] = 'cart_list';
        $data['page_title'] = 'My Cart';
        $this->load->view('ordering/index',$data);
    }

    function load_cart_list(){
        $resp = $this->order->load_cart_list();
        if($resp)
        echo $resp;
    }
    function remove_from_cart(){
        $resp= $this->order->remove_from_cart();
        if($resp)
        echo $resp;
    }

    function cart_change_qty(){
        $resp = $this->order->cart_change_qty();
        if($resp == 1){
            echo $resp;
        }
    }

    function place_order(){
        $resp = $this->order->place_order();
        if($resp)
        echo $resp;
    }
    function my_order(){
        $data['page_name'] = 'my_order';
        $data['page_title'] = 'my order';

        $this->load->view('ordering/index',$data);
    }

    function load_orders(){
        $resp = $this->order->load_orders();
        if($resp)
        echo $resp;
    }
    function order_details(){
        $resp = $this->order->order_details();
        if($resp)
        echo $resp;
    }

    function message_send(){
        $resp = $this->order->message_send();
        if($resp)
        echo $resp;
    }

    function load_messages(){
        $resp = $this->order->load_messages();
        if($resp)
        echo $resp;
    }
    function count_unread_msg(){
        $resp = $this->order->count_unread_msg();
        if($resp)
        echo $resp;
    }
    function update_msg_to_read(){
        $resp= $this->order->update_msg_to_read();
        if($resp)
        echo $resp;
    }
}