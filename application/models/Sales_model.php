<?php


if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Sales_Model extends CI_Model {

 function __construct() {
        parent::__construct();
    }

    function save_pos(){
        extract($_POST);
        if(!isset($oid)){
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
            $order['type'] = $order_type;
            $order['status'] = 0;
            $order['amount'] = str_replace(',','',$gTotal);
            $order['location'] = $location;
            $order['user_id']= $_SESSION['user_id'];
            $order['total_amount']= str_replace(',','',$gTotal);

            $ins_order = $this->db->insert('orders',$order);
            $last_id = $this->db->insert_id();
            $odata= array();
            for($i = 0 ; $i < count($pid);$i++){
                $olist['order_id'] = $last_id;
                $olist['product_id'] = $pid[$i];
                $olist['price'] = str_replace(',', '',$price[$i]);
                $olist['qty'] = $qty[$i];
                $olist['total_amount'] = str_replace(',', '',$tprice[$i]);
                $odata[]=$olist;
            }

            $oins = $this->db->insert_batch('order_list',$odata);
            if($ins_order && $odata){
                $q = $this->db->query("SELECT * FROM queue_list where date_format(date_created,'%Y-%m-%d') = '".date('Y-m-d')."' order by `queue` desc limit 1 ");
                if($q->num_rows() > 0){
                    $queue = $q->row()->queue + 1;
                }else{
                    $queue = 1;
                }
                $queue = sprintf('%04d',$queue);

                $qdata['order_id'] = $last_id;
                $qdata['queue'] = $queue;
                $qdata['status'] = 1;
                $status = 1;

                $queue_ins = $this->db->insert('queue_list',$qdata);
                $resp = array();
                if($save_as == 2){
                    $s['ref_id'] = $order['ref_id'];
                    $s['order_id'] = $last_id;
                    $s['receipt_no'] = substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXZ0123456789abcdefghijklmnopqrstuvwxyz'),0,12);
                    $chk = 1; 
                    while($chk == 1){
                        $check = $this->db->get_where('sales',array('receipt_no'=>$s['receipt_no']));
                        if($check->num_rows() > 0){
                            $s['receipt_no'] = substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXZ0123456789abcdefghijklmnopqrstuvwxyz'),0,12);
                        }else{
                            $chk = 0;
                            
                        }
                    }
                    $s['total_amount'] = str_replace(',', '',$order['total_amount']);
                    $s['amount_tendered'] = str_replace(',','',$amount_tendered);

                    $ins_sale = $this->db->insert('sales',$s);
                }
                if($queue_ins){
                    $resp['status'] = 'success';
                    $resp['ref_no'] = $order['ref_id'];
                    $resp['queue'] = $queue;
                    $resp['order_id'] = $last_id;
                    $resp['ins_sale'] = isset($ins_sale) && $ins_sale ? '1':'';
                    $status = 1;

                    return json_encode($resp);
                }

            }
        }else{
            $order['type'] =$type;
            $order['location'] = $location;
            $order['total_amount'] = str_replace(',', '',$gTotal);

            $update = $this->db->update('orders',$order,array('id'=>$oid));

            $chk = $this->db->query("Select * FROM sales where order_id = '".$oid."' ");

            if($chk->num_rows() > 0){
                $sales['total_amount'] = $gTotal;

                $update2 = $this->db->update('sales',$sales,array('order_id'=>$oid));

            }

            foreach($product_id as $i => $val){
                if($lid[$i] > 0){
                    $list['order_id'] = $oid;
                    $list['product_id'] = $product_id[$i];
                    $list['price'] = str_replace(',', '',$price[$i]);
                    $list['qty'] = $qty[$i];
                    $list['total_amount'] =str_replace(',', '',$total_amount[$i]);
                    if(isset($chk_data[$i])){
                        $list['status'] = 2;
                    }else{
                        $list['status'] = 1;

                    }
                    $update3 = $this->db->update('order_list',$list,array('id'=>$lid[$i]));
                }else{
                    $list['order_id'] = $oid;
                    $list['product_id'] = $product_id[$i];
                    $list['price'] = str_replace(',', '',$price[$i]);
                    $list['qty'] = $qty[$i];
                    $list['total_amount'] =str_replace(',', '',$total_amount[$i]);
                    if(isset($chk_data[$i])){
                        $list['status'] = 2;
                    }else{
                        $list['status'] = 1;

                    }
                    $insert = $this->db->insert('order_list',$list);
                    $lid[] = $this->db->insert_id();

                }
            }
            $ids= array();
            if(count($lid) > 0){
                $ids = implode(',',$lid);
                $this->db->query("DELETE FROM order_list where id not in (".$ids.") and order_id = ".$oid." ");
            }
            $resp['status'] =1;
            $count_list = $this->db->get_where('order_list',array('order_id'=>$oid))->num_rows();
            $count_list_served = $this->db->get_where('order_list',array('order_id'=>$oid,'status'=>2))->num_rows();
            $status = 0;
            if($count_list > 0){
                if($count_list == $count_list_served){
                    $status = '2';
                }elseif($count_list_served >0){
                    $status = 1;
                }
            }
            $resp['order_status'] = $status;
            $resp['order_id'] = $oid;
            return json_encode($resp);


        }
    }

    function load_olist(){
        extract($_POST);
        $uwhere = "";
        if($_SESSION['type'] == 3){
            $uwhere = " and o.user_id = ".$_SESSION['user_id']." ";
        }
        $qry = $this->db->query("SELECT o.*,ql.queue,date_format(o.created_date,'%M %d, %Y') as odate FROM orders o inner join queue_list ql on o.id = ql.order_id where date_format(o.created_date,'%Y-%m-%d') between '".date('Y-m-d',strtotime($sdate))."' and '".date('Y-m-d',strtotime($edate))."' ".$uwhere." order by date(o.created_date) asc ");
        $res = array();
        if($qry->num_rows() > 0){
            foreach($qry->result_array() as $row){
                $sale = $this->db->get_where('sales',array('order_id' => $row['id']));
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
                $row['sales_status'] = 2;
                if($sale->num_rows() > 0){
                    $row['sales_status'] = 1;
                }
                $row['queue'] = sprintf('%04d',$row['queue']);
                $res[]=$row;
            }
        }
        return json_encode($res);
    }
    function delete_order(){
        extract($_POST);
        if(!empty($id)){
            $delete = $this->db->delete('orders',array('id'=>$id));
            $delete2 = $this->db->delete('order_list',array('order_id'=>$id));
            $delete3 = $this->db->delete('queue_list',array('order_id'=>$id));
            $delete4 = $this->db->delete('sales',array('order_id'=>$id));

            if($delete){
                return 1;
            }
        }
    }

    function pay_saved(){
        extract($_POST);
        if(!empty($id)){
            $order = $this->db->get_where('orders',array('id'=>$id));
            if($order->num_rows() > 0){
                $row = $order->row();
                $data['ref_id'] = $row->ref_id;
                $data['order_id'] = $row->id;
                $data['total_amount'] = str_replace(',', '',$row->total_amount);
                $data['receipt_no'] = substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXZ0123456789abcdefghijklmnopqrstuvwxyz'),0,12);
                    $chk = 1; 
                    while($chk == 1){
                        $check = $this->db->get_where('sales',array('receipt_no'=>$data['receipt_no']));
                        if($check->num_rows() > 0){
                            $data['receipt_no'] = substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXZ0123456789abcdefghijklmnopqrstuvwxyz'),0,12);
                        }else{
                            $chk = 0;
                            
                        }
                    }
                    $data['amount_tendered'] = str_replace(',','',$amount_tendered);
                $insert = $this->db->insert('sales',$data);
                if($insert)
                    return 1;
                else{
                    return 0;
                }
            }else{
                return 0;
            }
        }
    }

    function change_ostatus(){
        extract($_POST);
        $update = $this->db->update('orders',array('status'=>1),array('id'=>$id));
        $resp =array();
        if($update){
            $resp['status']= 'success';
            $resp['id'] = $id;
        }
        return json_encode($resp);
    }
    public function get_total_sales() {
        $this->db->sales('amount', 'total_sales');
        $query = $this->db->get('sales');

        if ($query->num_rows() > 0) {
            return $query->row()->total_sales;
        } else {
            return 0; // or any default value
        }
    }

    public function get_total_amount() {
        $this->db->select_sum('total_amount', 'total_amount');
        $query = $this->db->get('sales');

        if ($query->num_rows() > 0) {
            return $query->row()->total_amount;
        } else {
            return 0; // or any default value
        }
    }
}