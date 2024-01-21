<?php


if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Product_Model extends CI_Model {

 function __construct() {
        parent::__construct();
    }


    function save_pg(){
        extract($_POST);
        $response = array();
        if(empty($id)){
            $data['name'] = $name;
            $data['status'] = isset($status) && $status == 'on' ? 1 : 0;

            $chk = $this->db->get_where("product_type",array('name'=>$name))->num_rows();
            if($chk <= 0){
                $insert = $this->db->insert("product_type",$data);
                if($insert){
                    $response['status'] = 'success';
                }else{
                    $response['status'] = 'Failed';
                }
            }else{
                $response['status'] = 'exist';
            }
        }else{
            $data['name'] = $name;
            $data['status'] = isset($status) && $status == 'on' ? 1 : 0;

            $chk = $this->db->get_where("product_type",array('name'=>$name,'id !='=>$id))->num_rows();
            if($chk <= 0){
                $update = $this->db->update("product_type",$data,array('id'=>$id));
                if($update){
                    $response['status'] = 'success';
                }else{
                    $response['status'] = 'Failed';
                }
            }else{
                $response['status'] = 'exist';
            }
        }
        return json_encode($response);
    }

    function get_pg(){
        $get = $this->db->order_by('name','ASC')->get_where('product_type')->result_array();
        $row = array();

        foreach($get as $row){
            $rows[] = $row;
        };
        echo json_encode(array('list'=>$rows));
    }
    function delete_pg(){
        extract($_POST);
        $del = $this->db->delete('product_type',array('id'=>$id));
        if($del)
        return true;
    }

    function remove(){
        extract($_POST);
        $del = $this->db->delete('product',array('id'=>$id));
        if($del)
        return true;  
    }

    function save_product(){
        extract($_POST);
        if(empty($id)){
            $data['name'] = $name;
            $data['description'] = $description;
            $data['pt_id'] = $type;
            $data['status'] = isset($status) && $status == 'on' ? 1 : 0;
            $data['price'] = $price;
            //$data['img_path'] = 'uploads/products/logo.jpg';
            
            $chk = $this->db->get_where('product',array('name'=>$name))->num_rows();
            if($chk >0){
                $resp['status'] = 'exist';
                return json_encode($resp);
                exit;
            }

            if(isset($_FILES['img_path']['name']) && $_FILES["img_path"]["name"] != '' ){
                $filename = date('YmdHi').'_'.(str_replace(' ','',$_FILES['img_path']['name']));
                $path = $_FILES['img_path']['tmp_name'];
                $move = move_uploaded_file($path,'uploads/products/'.$filename);
                // var_dump($_FILES);
                if($move){
                    $data['img_path'] = 'uploads/products/'.$filename;
                }
            }
            $insert = $this->db->insert('product',$data);
            if($insert){
                $resp['status']='success';
                return json_encode($resp);
            }else{
                $resp['status']='failed';
                return json_encode($resp);
            }

        }else{
            // var_dump($_FILES);
            // exit;
            $data['name'] = $name;
            $data['description'] = $description;
            $data['pt_id'] = $type;
            $data['status'] = isset($status) && $status == 'on' ? 1 : 0;
            $data['price'] = $price;
           // $data['img_path'] = 'uploads/products/logo.jpg';
            
            $chk = $this->db->get_where('product',array('name'=>$name,'id !='=>$id))->num_rows();
            if($chk >0){
                $resp['status'] = 'exist';
                return json_encode($resp);
                exit;
            }

            if(isset($_FILES['img_path']['name']) && $_FILES["img_path"]["name"] != '' ){
                $filename = date('YmdHi').'_'.(str_replace(' ','',$_FILES['img_path']['name']));
                $path = $_FILES['img_path']['tmp_name'];
                $move = move_uploaded_file($path,'uploads/products/'.$filename);
                // var_dump($_FILES);
                if($move){
                    $data['img_path'] = 'uploads/products/'.$filename;
                }
            }
            $update = $this->db->update('product',$data,array('id'=>$id));
            if($update){
                $resp['status']='success';
                return json_encode($resp);
            }else{
                $resp['status']='failed';
                return json_encode($resp);
            }
        }
    }

    function get_products(){
        extract($_POST);
        if($id != 'all'){
            $this->db->where('pt_id',$id);
        }
        if(isset($_POST['status']))
        $this->db->where('status',$_POST['status']);
        $qry = $this->db->get("product");
        $resp = array();
        if($qry->num_rows() > 0){
            foreach($qry->result_array() as $row){
                $resp[]=$row;
            }
        }
        return json_encode($resp);
    }

    function load_pg(){
        if(isset($_POST['status']))
        $this->db->where('status',$_POST['status']);
        $qry = $this->db->order_by('name','asc')->get('product_type');
        $resp = array();
        foreach($qry->result_array() as $row){
            $resp[] = $row;
        }

        return json_encode($resp);
    }

}