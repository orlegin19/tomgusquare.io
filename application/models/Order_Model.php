<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order_Model extends CI_Model {
    

	 function __construct() {
        parent::__construct();
       
    }

    function p_load(){
        extract($_POST);
        $cat_where = '';
        if($cat_id > 0){
            $cat_where = " and p.pt_id = '".$cat_id."' ";
        }
        $o ='';
        if($offset > 0){
            $o = ' offset '.$offset;
        }
        $search_where = '';
        if(!empty($search)){
        $search_where = " and (p.name Like '%".$search."%' or pt.name Like '%".$search."%' or p.description Like '%".$search."%') ";
        }
        $qry_count_all = $this->db->query("SELECT * from product p inner join product_type pt on p.pt_id = pt.id where p.status = 1 ".$cat_where.$search_where." ")->num_rows();
        $qry = $this->db->query("SELECT p.*,pt.name as cat_name from product p inner join product_type pt on p.pt_id = pt.id where p.status = 1 ".$cat_where.$search_where." order by p.name asc limit 8 ".$o." ");
        // echo $this->db->last_query();
        $list = array();
        foreach($qry->result_array() as $row){
            $list[] = $row;
        }
        return json_encode(array('list'=>$list,"count"=>$qry_count_all));
    }


    function load_pg(){
        $qry = $this->db->order_by('name','asc')->get_where('product_type',array('status'=> 1))->result_array();

        $list = array();
        foreach($qry as $row){
            $list[]=$row;
        }
        return json_encode($list);
    }

    function save_to_cart(){
        extract($_POST);
        if(!empty($pid) && !empty($user_id)){
            $data['product_id'] = $pid;
            $data['qty'] = $qty ;
            $data['user_id'] = $user_id;

            $insert = $this->db->insert('cart_list',$data);
            if($insert){
                $resp['status'] = 1;
                $data['id'] = $this->db->insert_id();
                $resp['data'] = $data;
                return json_encode($resp);
            }
        }
    }

    function load_cart_list(){
        $qry = $this->db->query("SELECT cl.*,p.name as pname,p.price,p.img_path FROM cart_list cl inner join product p on cl.product_id = p.id where cl.user_id ='".$_SESSION['user_id']."' order by date(cl.date_added) asc ");
        $list = array();
        foreach($qry->result_array() as $row){
            $list[] = $row;
        }
        return json_encode($list);
    }
    function remove_from_cart(){
        $id = $_POST['id'];
        $delete = $this->db->delete('cart_list',array('id'=>$id));
        if($delete)
        return 1;
    }
    function cart_change_qty(){
        extract($_POST);
        $data['qty'] = $qty;
        $update = $this->db->update('cart_list',$data,array('id'=>$id));
        if($update)
        return 1;
    }

    function place_order(){
        extract($_POST);
        // var_dump($_POST);

        $order['type'] = $type;
        $order['location'] = $location;
        $order['landmark'] = $landmarks;
        $order['remarks'] = $remarks;

        $order['ref_id'] = substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXZ'),0,3).'-'.(sprintf('%04d',mt_rand(0,9999)));
        $check = 1;
        while($check == 1){
            $chk = $this->db->get_where('orders',array('ref_id'=>$order['ref_id']));
            if($chk->num_rows() > 0){
                $order['ref_id'] = substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXZ'),0,3).'-'.(sprintf('%04d',mt_rand(0,9999)));
            }else{
                $check = 0;
            }
        }

        $order['user_id'] = $_SESSION['user_id'];
        $insert = $this->db->insert('orders',$order);
        $oid = $this->db->insert_id();

        $cart = $this->db->query("SELECT cl.*,p.price from cart_list cl inner join product p on cl.product_id = p.id where cl.user_id =".$_SESSION['user_id']." ");
        $ol = array();
        $total_amount = 0;
        foreach($cart->result_array() as $row){
            $row['price'] = str_replace(',','',$row['price']);
            $ol[]= array(
                    'order_id'=>$oid,
                    'product_id'=>$row['product_id'],
                    'price'=>str_replace(',','',$row['price']),
                    'qty'=>$row['qty'],
                    'total_amount'=>($row['qty'] * $row['price']),

            );
            $total_amount += $row['qty'] * $row['price'];
        }
        if(count($ol) > 0){
            $insert2 = $this->db->insert_batch('order_list',$ol);
            if($insert){
                $delete = $this->db->delete('cart_list',array('user_id'=>$_SESSION['user_id']));
                $update = $this->db->update('orders',array('amount'=>$total_amount,'total_amount' => str_replace(',','',$total_amount),array('id'=>$oid)));

                $q = $this->db->query("SELECT * FROM queue_list where date_format(date_created,'%Y-%m-%d') = '".date('Y-m-d')."' order by `queue` desc limit 1 ");
                if($q->num_rows() > 0){
                    $queue = $q->row()->queue + 1;
                }else{
                    $queue = 1;
                }
                $queue = sprintf('%04d',$queue);

                $qdata['order_id'] = $oid;
                $qdata['queue'] = $queue;
                $qdata['status'] = 1;
                $status = 1;

                $queue_ins = $this->db->insert('queue_list',$qdata);
                    $resp['status'] = 'success';
                    $resp['ref_no'] = $order['ref_id'];
                    $resp['queue'] = $queue;
                    $resp['order_id'] = $oid;
                    $alert['alert_type'] = 'online_order';
                    $alert['form_id'] = $oid;
                    $ot = $type == 3 ? "Delivery" : "Pick-up";
                    $alert['message'] = "<b>".($_SESSION['email'])."</b> added new order for ".$ot.".";
                    $aler_ins = $this->db->insert('alert_msg',$alert);
                    $resp['alert_id'] =$this->db->insert_id();

                    return json_encode($resp);
            }
        }
    }

    function load_orders(){
        $qry = $this->db->order_by('id','desc')->get_where('orders',array('user_id'=>$_SESSION['user_id']));
        $list = array();
        foreach($qry->result_array() as $row){
            $row['item_count'] = $this->db->get_where('order_list',array('order_id'=>$row['id']))->num_rows();
            $list[]= $row;
        }
        return json_encode($list);
        // return $this->db->last_query();
    }
    function order_details(){
        extract($_POST);

        $details = $this->db->get_where('orders',array('id'=>$id))->row();
        $list = array();
        $qry = $this->db->query("SELECT l.*,p.name as pname,p.price,p.img_path from order_list l inner join product p on l.product_id = p.id where l.order_id = ".$id." order by p.name asc ")->result_array();
        foreach($qry as $row){
            $list[] = $row;
        }
        return json_encode(array('details'=>$details,'list'=>$list));
    }
    function message_send(){
        extract($_POST);
        $data['message'] = $message;
        $data['user_id'] = $_SESSION['user_id'];
        $insert = $this->db->insert('messages',$data);
        if($insert){
            $resp['status'] = 'success';
            $id = $this->db->insert_id();
            $qry = $this->db->get_where('messages',array('id'=>$id));
            if($qry->num_rows() > 0){
                $qry->row()->date_created = date('M d, Y h:i A',strtotime($qry->row()->date_created));
                $resp['data']=$qry->row();
            }
            return json_encode($resp);
        }
    }
    function load_messages(){
        extract($_POST);
        $where = '';
        if(!empty($id))
        $where = " and id = ".$id."  ";
        $qry = $this->db->query("SELECT * FROM messages where user_id=".$_SESSION['user_id']." ".$where." order by date(date_created) asc ");
        $list = array();
        foreach($qry->result_array() as $row){
            $row['date_created'] = date('M d, Y h:i A',strtotime($row['date_created']));
            $list[] = $row;
        }
        return json_encode($list);
    }

    function count_unread_msg(){
        extract($_POST);
        $qry = $this->db->get_where('messages',array('user_id'=>$user_id,'type'=>1,'status'=>0));
        if($qry->num_rows() >= 0){
            $resp['status'] = 'success';
            $resp['count'] = $qry->num_rows();

            return json_encode($resp);
        }
    }

    function update_msg_to_read(){
        $update = $this->db->update('messages',array('status'=>1),array('user_id'=>$_SESSION['user_id'],'type'=>1));
        if($update){
            return 1;
        }
    }
}