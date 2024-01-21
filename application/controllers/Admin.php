<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Admin extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('Admin_Model','admin');
        $this->load->model('Cogs_Model','cogs');
        if(!isset($_SESSION['system']))
        $sess = $this->cogs->system_session();

        if(!isset($_SESSION['user_id']))
        redirect(base_url('login'));


        if(isset($_SESSION['type'])){
            if($_SESSION['type'] == 4)
            redirect(base_url('delivery'));
            if($_SESSION['type'] == 5)
            redirect(base_url('order'));
       }
    }

    public function index(){
        $data['page_name'] = 'dashboard';
        $data['page_title'] = 'Dashboard';
        $this->load->view('index',$data);
    }

    function users(){
        $data['page_name'] = 'users/user_list';
        $data['page_title'] = 'Users';
        $this->load->view('index',$data);
    }

    function user_list(){
        $resp = $this->admin->user_list();
        if($resp){
            echo $resp;
        }
    }
    function block_confirm_page($id='',$action='block'){
        if(!empty($id)){
            $data['id']= $id;
            $data['action']= $action;
            $this->load->view('users/block_confirm_page',$data);
        }
    }
    function change_user_status(){
        $resp = $this->admin->change_user_status();
        if($resp)
        echo $resp;
    }

    function manage_user($id = '',$my_account = ''){
        $data['id'] = $id;
        $data['my_account'] = $my_account;

        $this->load->view('users/manage_user',$data);
    }

    function save_user(){
        $resp = $this->admin->save_user();
        if($resp)
        echo $resp;
    }

    function user_delete(){
        $resp = $this->admin->user_delete();
        if($resp)
        echo $resp;
    }
    function check_email(){
        extract($_POST);
        $id_where = '';
        if($id > 0)
        $id_where = " and id != ".$id." ";
        $qry = $this->db->query('SELECT * FROM users where email = "'.$email.'" and delete_flag = 0 '.$id_where)->num_rows();
        if($qry)
        echo $qry;
    }

    function sales_report(){
        $data['page_name'] ='reports/sales_report';
        $data['page_title'] = 'Sales Report';
        
        $this->load->view('index',$data);
    }

    function load_sales_report(){
        $resp = $this->admin->load_sales_report();
        if($resp)
        echo $resp;
    }
    
    function load_dash_data(){
        $resp = $this->admin->load_dash_data();
        if($resp)
        echo $resp;
    }

    function des_chart_data(){
        $resp = $this->admin->des_chart_data();
        if($resp)
        echo $resp;
    }

    function order_chart(){
        $resp = $this->admin->order_chart();
        if($resp)
        echo $resp;
    }

    function load_alerts(){
        $resp = $this->admin->load_alerts();
        if($resp)
        echo $resp;
    }
    function read_alert(){
        $resp = $this->admin->read_alert();
        if($resp)
        echo $resp;
    }
    function alert_allread(){
        $resp = $this->admin->alert_allread();
        if($resp)
        echo $resp;
    }
    function load_messages(){
        $resp=$this->admin->load_messages();
        if($resp)
        echo $resp;
    }
    function view_convo($uid='',$view = ''){
        $data['user_id'] = $uid;
        $data['view'] = $view;
        $this->load->view('view_convo',$data);
    }
    function read_msg(){
        $resp=$this->admin->read_msg();
        if($resp)
        echo $resp;
    }
    function load_convo_messages(){
        $resp = $this->admin->load_convo_messages();
        if($resp)
        echo $resp;
    }
    function message_send(){
        $resp = $this->admin->message_send();
        if($resp)
        echo $resp;
    }
    function view_all_convo(){
        $data['page_title'] = 'All message conversation';
        $data['page_name'] = 'view_all_convo';
        $this->load->view('index',$data);
    }
    function load_convo_list(){
        $resp= $this->admin->load_convo_list();
        if($resp)
        echo $resp;
    }
    function delivery_list(){
        $data['page_title'] = 'Orders to Deliver';
        $data['page_name'] = 'to_deliver';
        $this->load->view('index',$data);
    }
    function move_order(){
        $resp=$this->admin->move_order();
        if($resp)
            echo $resp;
    }
    function load_del_list(){
        $resp= $this->admin->load_del_list();
        if($resp)
        echo $resp;
    }

    function delete_del(){
        $resp = $this->admin->delete_del();
        if($resp)
        echo $resp;
    }
    function update_d(){
        $resp = $this->admin->update_d();
        if($resp)
        echo $resp;
    }
    
}