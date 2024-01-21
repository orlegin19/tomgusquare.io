<?php


if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Delivery_Model extends CI_Model {
    
    function __construct() {
        parent::__construct();
    }

    function load_orders(){
        extract($_POST);
        if($id == ''){
            $qry = $this->db->query("SELECT o.*,ql.queue from for_delivery d inner join orders o on d.order_id = o.id  inner join queue_list ql on o.id = ql.order_id where d.user_id=".$_SESSION['user_id']." and o.status = 0 order by ql.queue asc ");
        }else{
            $qry = $this->db->query("SELECT o.*,ql.queue from for_delivery d inner join orders o on d.order_id = o.id  inner join queue_list ql on o.id = ql.order_id where o.id = '".$id."' ");
        }
        // echo $this->db->last_query();

        $list = array();
        foreach($qry->result_array() as $row){
            $row['item_count'] = $this->db->get_where('order_list',array('order_id'=>$row['id']))->num_rows();
            $row['queue'] = sprintf('%04d',$row['queue']);
            if($row['status']  == 0)
            $list[]= $row;
        }
        return json_encode($list);
    }

    function mark_delivered(){
        extract($_POST);
        $update= $this->db->update('orders',array('status'=>1),array('id'=>$id));
        if($update)
        return 1;
    }

}