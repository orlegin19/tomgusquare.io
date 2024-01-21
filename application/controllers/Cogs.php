<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cogs extends CI_Controller {
    

     function __construct() {
        parent::__construct();
        $this->load->model('Cogs_Model','cogs');
        if(!isset($_SESSION['system']))
        $sess = $this->cogs->system_session();
        if(!isset($_SESSION['user_id']))
        redirect(base_url('login'));

       
        
    }

    public function index(){
        $data['page_title'] = 'System Settings';
        $data['page_name'] = 'cogs/settings';
        $this->load->view('index',$data);
    }
    function save_settings(){
        if(isset($_SESSION['type']) && in_array($_SESSION['type'],array(5,4,6))){
            if($_SESSION['type'] == 5)
            redirect(base_url('order'));
        }
        $save = $this->cogs->save_settings();
        if($save){
            echo $save;
        }
    }
    function save_user(){
        $resp = $this->cogs->save_user();
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
}