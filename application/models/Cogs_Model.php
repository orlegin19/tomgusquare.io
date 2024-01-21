<?php


if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Cogs_Model extends CI_Model {

 function __construct() {
        parent::__construct();
    }

    function save_settings(){
        foreach($_POST as $k => $v) {
        	$data['meta_name'] = $k;
        	$data['meta_value'] = $v;
        	$chk = $this->db->get_where("system_settings",array('meta_name',$k))->num_rows();
        		$save[] = $this->db->insert("system_settings",$data);
        }
        if(isset($_FILES['img_path']['name']) && $_FILES["img_path"]["name"] != '' ){
        	$data = array();
                $filename = date('YmdHis').'_'.(str_replace(' ','',$_FILES['img_path']['name']));
                $path = $_FILES['img_path']['tmp_name'];
                $move = move_uploaded_file($path,'uploads/'.$filename);
                if($move){
        			$data['meta_name'] = 'system_logo';
                    $data['meta_value'] = 'uploads/'.$filename;
	        		$save[] = $this->db->insert("system_settings",$data);
                }
            }
        if(isset($save)){
        	foreach($_POST as $k => $v){
        		$k = str_replace('system_', '', $k);
        		$_SESSION['system'][$k] = $v;
			}
        	if(isset($_FILES['img_path']['name']) && $_FILES["img_path"]["name"] != '' ){
                if($move){
        		$_SESSION['system']['logo'] = 'uploads/'.$filename;
                }
            }
        	return 1;
        }
    }
    function save_user(){
        extract($_POST);
        if(empty($id)){
            $data['firstname'] = $firstname;
            $data['lastname'] = $lastname;
            $data['email'] = $email;
            $data['password'] = md5($password);
            $data['type'] = $type;
            $insert = $this->db->insert('users',$data);
            if($insert)
            return 1;
        }else{
            $data['firstname'] = $firstname;
            $data['lastname'] = $lastname;
            $data['email'] = $email;
            if(!empty($password))
            $data['password'] = md5($password);
            $data['type'] = $type;

            $update = $this->db->update('users',$data,array('id'=>$id));
            if($update){
            	if($_SESSION['user_id'] == $id){
            		foreach($_POST as $k => $v){
            			if($k !='password'){
            				if($k == 'id')
            					$k='user_id';
            				$_SESSION[$k] = $v;
            			}
            		}
            	}
            	return 1;
            }
        }
    }
    function system_session(){
    	$get = $this->db->select('*')->get("system_settings");
    	if($get->num_rows() > 0){
    		foreach($get->result_array() as $row){
        		$row['meta_name'] = str_replace('system_', '', $row['meta_name']);
    			$_SESSION['system'][$row['meta_name']] = $row['meta_value'];
    		}
    	return 1;
    	}
    }
}