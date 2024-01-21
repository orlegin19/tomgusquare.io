<?php


if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Kitchen_Model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function load_orders(){
        extract($_POST);
        if($id == ''){
            $qry = $this->db->query("SELECT o.*,ql.queue from orders o inner join queue_list ql on o.id = ql.order_id order by ql.queue asc ");
        }else{
            $qry = $this->db->query("SELECT o.*,ql.queue from orders o inner join queue_list ql on o.id = ql.order_id where o.id = '".$id."' ");
        }

        $list = array();
        foreach($qry->result_array() as $row){
            $count_list = $this->db->get_where('order_list',array('order_id'=>$row['id']))->num_rows();
                $count_list_served = $this->db->get_where('order_list',array('order_id'=>$row['id'],'status'=>2))->num_rows();
                $status = 0;
                if($count_list > 0){
                    if($count_list == $count_list_served){
                        $status = '2';
                    }elseif($count_list_served >0){
                        $status = 1;
                    }
                }
                $row['serve_status'] = $status;
            $row['queue'] = sprintf('%04d',$row['queue']);
            if($status != 2)
            $list[]= $row;
        }
        return json_encode($list);
    }


}
