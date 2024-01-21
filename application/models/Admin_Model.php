<?php

defined('BASEPATH') OR exit('No direct script access allowed');


class Admin_Model extends CI_Model {

    function __construct() {
    }

    function user_list(){
        $qry = $this->db->select('*,CONCAT(firstname," ",lastname) as name')->order_by('email','asc')->get_where('users',array('id!='=>1,'delete_flag'=> 0))->result_array();
        $list = array();
        foreach($qry as $row){
            $row['name'] = ucwords(strtolower($row['name']));
            $list[]= $row;
        }
        return json_encode($list);
    }
    function change_user_status(){
        extract($_POST);
        $update = $this->db->update('users',array('status'=>$status),array('id'=>$id));
        if($update)
        return 1;
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
            if($update)
            return 1;
        }
    }

    function user_delete(){
        extract($_POST);
        if($id > 0){
            $delete = $this->db->update('users',array('delete_flag'=>1),array('id' => $id));
            if($delete)
            return 1;
        }
    }

    function load_sales_report(){
        extract($_POST);
        $start = date('Y-m-d',strtotime($start_date));
        $end = date('Y-m-d',strtotime($end_date));

        $qry = $this->db->get("sales");
        $list = array();
        foreach($qry->result_array() as $row){
            $row['sale_date'] = date('M d, Y',strtotime($row['date_created']));
            $row['total_amount'] = str_replace(',','',$row['total_amount']);
            $list[] = $row;
        }

        return json_encode($list);
    }
    function report(){
        extract($_POST);
        $start = date('Y-m-d',strtotime($start_date));
        $end = date('Y-m-d',strtotime($end_date));

        $qry = $this->db->get("sales");
        $list = array();
        foreach($qry->result_array() as $row){
            $row['sale_date'] = date('M d, Y',strtotime($row['date_created']));
            $row['total_amount'] = str_replace(',','',$row['total_amount']);
            $list[] = $row;
        }

        return json_encode($list);
    }

    function load_dash_data(){
        $resp = array();
        $qry_sales = $this->db->query('SELECT * from sales where date_format(date_created,"%Y-%m-%d") = "'.date('Y-m-d').'" ');
        $qry_order = $this->db->query('SELECT o.*,u.type  from orders o inner join users u on u.id = o.user_id where date_format(o.created_date,"%Y-%m-%d") = "'.date('Y-m-d').'" ');
        $total_sales = 0;
        $total_unpaid = 0;
        $total_orders = 0;
        $total_online_orders = 0;
        $soid = array();

        foreach($qry_sales->result_array() as $row){
            $row['total_amount'] = str_replace(',','',$row['total_amount']);
            $row['total_amount'] = number_format($row['total_amount'],2,'.','');
            $total_sales += $row['total_amount'] ;
            $soid[] = $row['order_id'];
        }
        foreach($qry_order->result_array() as $row){
            $row['total_amount'] = str_replace(',','',$row['total_amount']);
            $row['total_amount'] = number_format($row['total_amount'],2,'.','');
            if(!in_array($row['id'],$soid))
                $total_unpaid += $row['total_amount'] ;
                $total_orders++;
            if($row['type'] == 5)
                $total_online_orders++;
        }

        $resp['total_sales'] = $total_sales;
        $resp['total_unpaid'] = $total_unpaid;
        $resp['total_orders'] = $total_orders;
        $resp['total_online_orders'] = $total_online_orders;

        echo json_encode($resp);
    }
    function des_chart_data(){
        $d1 = date('Y-m-d');
        $d2 = date('Y-m-d',strtotime(date('Y-m-d').' -7 days'));
        $qry_sales = $this->db->query("SELECT * FROM sales where date_format(date_created,'%Y-%m-%d') BETWEEN '".$d2."' and '".$d1."' order by date(date_created) desc ");
        $qry = $this->db->get_where('orders',array('date(created_date)'=>date('Y-m-d')));
        $resp['amount'] = array();
        $resp['count'] = array();
        for($i = 6; $i >= 0 ; $i-- ){
            $resp['dates'][]=date('M d, y',strtotime(date('Y-m-d'). ' -'.$i.' days'));
            $resp['amount'][date('Y-m-d',strtotime(date('Y-m-d'). ' -'.$i.' days'))] = 0;
        }
        foreach($qry_sales->result_array() as $row){
            
            $resp['amount'][date('Y-m-d',strtotime($row['date_created']))] += number_format($row['total_amount'],2,'.','');
        }
        asort($resp['dates']);
        asort($resp['amount']);
        asort($resp['count']);
        // foreach($resp['dates'] as $k => $v){
        //     unser
        // }
        return json_encode($resp);
    }

    function order_chart(){
        $qry = $this->db->get_where('orders',array('date(created_date)'=>date('Y-m-d')));

        $resp['label']=array(1=>'Dine-in',2=>'Take-out',3=>'Deliver',4=>'Pick-up');
        $resp['count']= array();
        foreach($resp['label'] as $k => $v){
            $resp['count'][$k]=0;

        }
        foreach($qry->result_array() as $row){
            $resp['count'][$row['type']]++;
        }
        echo json_encode($resp);
    }

    function load_alerts(){
        extract($_POST);
        $where='';
        if($id > 0)
        $where = " and id =".$id." ";

        $qry = $this->db->query("SELECT * from alert_msg where delete_flag = 0 ".$where." order by date(date_created) asc ");
        $unread = $this->db->query("SELECT * from alert_msg where delete_flag = 0 and status= 0  ");
        $list = array();
        foreach($qry->result_array() as $row){
            $row['date_created'] = date('M d, Y h:i A',strtotime($row['date_created']));
            $list[] = $row;
        }
        return json_encode(array('list'=>$list,'unread' => $unread->num_rows()));
    }

    function read_alert(){
        extract($_POST);
        $update = $this->db->update('alert_msg',array('status'=>1),array('id'=>$id));
        if($update)
        return 1;
    }
    function alert_allread(){
        extract($_POST);
        $update = $this->db->update('alert_msg',array('status'=>1));
        if($update)
        return 1;
    }

    function load_messages(){
        extract($_POST);

        $iw = '';
        if(!empty($id)){
            $iw = " and m.id = ".$id." ";
        }

        $unread = $this->db->query("SELECT * from messages m where status = 0 and type=0 ");
        $qry = $this->db->query("SELECT m.*,concat(u.firstname,' ',u.lastname) as uname,u.email from messages m inner join users u on m.user_id=u.id where m.type=0 ".$iw." order by m.id asc ");
        $list=array();
        foreach($qry->result_array() as $row){
            $row['uname'] = ucwords($row['uname']);
            $row['date_created'] = date('M d, Y h:i A',strtotime($row['date_created']));
            $list[]=$row;
        }
        return json_encode(array('data'=>$list,'unread_count'=> $unread->num_rows()));
    }
    function read_msg(){
        extract($_POST);
        $update = $this->db->update('messages',array('status'=>1),array('user_id'=>$user_id,'type'=>0));
        if($update)
        return 1;
    }
    function load_convo_messages(){
        extract($_POST);
        $where = '';
        if(!empty($id))
        $where = " and id = ".$id."  ";
        $qry = $this->db->query("SELECT * FROM messages where user_id=".$uid." ".$where." order by date(date_created) asc ");
        $list = array();
        foreach($qry->result_array() as $row){
            $row['date_created'] = date('M d, Y h:i A',strtotime($row['date_created']));
            $list[] = $row;
        }
        return json_encode($list);
    }
    function message_send(){
        extract($_POST);
        $data['message'] = $message;
        $data['user_id'] = $user_id;
        $data['type'] = 1;
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

    function load_convo_list(){
        extract($_POST);

        $unread = array();
        $list = array();
        $where = '';
        if($id > 0)
        $where = " where m.id = ".$id." ";
        $qry=$this->db->query("SELECT m.*,concat(u.firstname,' ',lastname) as uname from messages m inner join users u on m.user_id = u.id ".$where." order by  m.id asc ");
        
        foreach($qry->result_array() as $row){
            if(!isset($unread[$row['user_id']])){
                $unread[$row['user_id']]=0;
            }
            if($id <= 0){
            if($row['type'] == 0 && $row['status'] == 0)
            $unread[$row['user_id']]++;
            }
            else{
                $unread[$row['user_id']] = $this->db->get_where('messages',array('user_id'=>$row['user_id'],'type'=>0,'status'=>0))->num_rows();  
            }
            $row['unread_count'] = $unread[$row['user_id']];

                $list[]=$row;

        }
        return json_encode($list);
    }
    
    function move_order() {
        extract($_POST);
        $insert = $this->db->insert('for_delivery',array('user_id'=>$user_id,'order_id'=>$order_id));
        if($insert)
        return 1;
    }

    function load_del_list(){
        $qry = $this->db->query( " SELECT d.*,concat(u.firstname,' ',u.lastname) as dname,o.status,o.ref_id from for_delivery d inner join orders o on d.order_id = o.id inner join users u on d.user_id = u.id order by date(d.date_created) asc ");
        $list = array();
        foreach($qry->result_array() as $row){
            $list[]=$row;
        }
        return json_encode($list);
    }

    function delete_del(){
        extract($_POST);
        $delete = $this->db->delete('for_delivery',array('id'=>$id));
        if($delete)
        return 1;
    }
    function update_d(){
        extract($_POST);
        $update = $this->db->update('for_delivery',array('user_id'=>$user_id),array('id'=>$id));
        if($update)
        return 1;
    }
}
