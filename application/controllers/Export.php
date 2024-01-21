<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Export extends CI_Controller {

	function __construct() {
        parent::__construct();
        $this->hrm = $this->load->database('hrm',true);
        $this->load->model('Maintenance_Model','maintenance');
        $this->load->model('Cogs_Model','cogs');
        if(!isset($_SESSION['system']))
        $sess = $this->cogs->system_session();
       
        
    }

    public function index(){
    	
    }
	function export_project_division($id)
	{
        $qry = $this->db->query("SELECT pd.*,p.project_name,p.project_code,c.format_type as ft,c.name as c_name from project_divisions pd inner join projects p on pd.project_id = p.id inner join categories c on pd.category_id = c.id where pd.id = '$id' ");
        $data['arr_qry'] = $qry->num_rows() > 0 ? $qry->row() : array();
    	$this->load->view('project/export_project_division',$data);
    }
    function export_upa($id)
	{
        $qry = $this->db->query("SELECT pd.*,p.project_name,p.project_code,c.format_type as ft,c.name as c_name from project_divisions pd inner join projects p on pd.project_id = p.id inner join categories c on pd.category_id = c.id where pd.project_id = '$id' order by id asc ");
        $data['arr_qry'] = $qry->num_rows() > 0 ? $qry->result_array() : array();
    	$this->load->view('project/export_upa',$data);
    }
    function get_nxt_lvl($id){
        $qry = $this->db->query("select * from categories where status=0 and parent_id ='$id' order by orderby asc");
			$arr = array();
			foreach($qry->result_array() as $row)
			{
				
				$arr[] = $row;
				$arr2 =$this->get_nxt_lvl($row['id']);
				if($row['id'] != $id){
					foreach($arr2 as $row2){
						$arr[]=$row2;
					}
				}
			}
			return $arr;
    }
    function get_div(){
        extract($_POST);
        // $type = 1;
        $data = array();
            $data['header']= array('Name','Quotation Date','Unit','Unit Rate', 'Material Cost','Man-Hr','Labor Cost','Other Cost','Total');
             
            $cat_qry = $this->db->query("select * from categories where status=0  and format_type = '$type' and id  in (SELECT category_id from project_divisions where id = '$pd_id' ) order by orderby desc");
            
            $parents = array();
            foreach($cat_qry->result_array() as $crow){
                $data['list'][$crow['id']] = $crow;
                $parents[$crow['id']] = $crow['id'];
                $nxt_lvl = $this->get_nxt_lvl($crow['id']);
                foreach($nxt_lvl as $row2){
                    $data['sub_list'][$row2['id']]=$row2;
                    $parents[$crow['id']] = $row2['id'];
                    $ids_arr[$row2['id']] = $row2['id'];
            }

            }
            
            $qry_mat = $this->db->query("SELECT dm.* FROM division_materials dm where dm.delete_flag=0  and  dm.division_id = '$pd_id'  ");
            $ids_arr = array_column($qry_mat->result_array(),'category_id','category_id');
            $ids_arr = array_filter($ids_arr);
            foreach($data['sub_list'] as $key => $val){
                if(!in_array($key,$ids_arr)){
                    unset($data['sub_list'][$key]);
                }
            }
            // $ids = implode(',',$ids_arr);
            $qry_mat_meta = $this->db->query("SELECT * FROM division_materials_meta where dm_id in (SELECT id FROM division_materials where delete_flag=0  and division_id = '$pd_id'   )   ")->result_array();
            $material = $this->db->query("SELECT * FROM materials_meta where material_id IN (SELECT material_id FROM division_materials where delete_flag=0  and division_id = '$pd_id'   ) ")->result_array();
            if($type == 1)
            $dm_sub = $this->db->query("SELECT * FROM division_materials_sub where dm_id IN (SELECT id FROM division_materials where delete_flag=0  and division_id = '$pd_id'   ) order by dms_id desc")->result_array();
            
            $mat_data = array();
            $div_data = array();
            if($type == 1)
            $sub_m = array();
            // $data['qry']="SELECT dm.* FROM division_materials dm where dm.delete_flag=0  and dm.category_id in (".$ids.")   ";
            foreach($material as $row){
                $mat_data[$row['material_id']][$row['meta_field']] = $row['meta_value'];
            }
            foreach($qry_mat_meta as $row){
                $div_data[$row['dm_id']][$row['meta_field']] = $row['meta_value'];
			}
			
			
            if($type == 1){
            foreach($dm_sub as $row){
                $sub_m[$row['dm_id']][$row['type']][] = $row;
            }
             }
            foreach($qry_mat->result_array() as $mrow){
				$mrow['meta_material'] = isset($mat_data[$mrow['material_id']]) ? $mat_data[$mrow['material_id']] : array();
				//totals
			$bare_cost=(isset($div_data[$mrow['id']]['bare_cost']) && $div_data[$mrow['id']]['bare_cost'] > 0) ?$div_data[$mrow['id']]['bare_cost'] : 0 ;
			$escl=(isset($div_data[$mrow['id']]['escl']) && $div_data[$mrow['id']]['escl'] > 0) ?$div_data[$mrow['id']]['escl'] : 0 ;
			$wastage=(isset($div_data[$mrow['id']]['wastage']) && $div_data[$mrow['id']]['wastage'] > 0) ?$div_data[$mrow['id']]['wastage'] : 0 ;
			$support=(isset($div_data[$mrow['id']]['support']) && $div_data[$mrow['id']]['support'] > 0) ?$div_data[$mrow['id']]['support'] : 0 ;
			$fittings=(isset($div_data[$mrow['id']]['fittings']) && $div_data[$mrow['id']]['fittings'] > 0) ?$div_data[$mrow['id']]['fittings'] : 0 ;
			$misc=(isset($div_data[$mrow['id']]['misc']) && $div_data[$mrow['id']]['misc'] > 0) ?$div_data[$mrow['id']]['misc'] : 0 ;
			$pqry = $this->db->query("SELECT pd.*,c.mnHr_multiplier as mn_type,p.manHr_skilled as mn_skilled,p.manHr_non_skilled as mn_non_skilled FROM project_divisions pd inner join projects p on pd.project_id = p.id inner join categories c on pd.category_id = c.id  where pd.id ='".$mrow['division_id']."' ")->row();
			$div_data[$mrow['id']]['manHr_rate'] = ($pqry->mn_type == 1) ? $pqry->mn_skilled : $pqry->mn_non_skilled;

			
			$lt = (isset($div_data[$mrow['id']]['man_hour']) && $div_data[$mrow['id']]['man_hour'] > 0)? $div_data[$mrow['id']]['man_hour'] * $div_data[$mrow['id']]['manHr_rate'] : 0;
			$lt = number_format($lt,0,'.','');
			$total = number_format($bare_cost + $escl + $wastage + $support + $fittings + $misc,0,'.','');
			$ot =number_format(($lt + $total)*.15,0,'.','');
			$ototal = $lt + $total + $ot;
			$_lt = number_format($lt/1.12,0,'.','');
			$_total = number_format($total/1.12,0,'.','');
			$_ot =number_format($ot/1.12,0,'.','');
			$_ototal = $_lt + $_total + $_ot;

			$div_data[$mrow['id']]['total'] = $total;
			$div_data[$mrow['id']]['lt'] = $lt;
			$div_data[$mrow['id']]['ot'] = $ot;
			$div_data[$mrow['id']]['ototal'] = $ototal;

			$div_data[$mrow['id']]['_total'] = $_total;
			$div_data[$mrow['id']]['_lt'] = $_lt;
			$div_data[$mrow['id']]['_ot'] = $_ot;
			$div_data[$mrow['id']]['_ototal'] = $_ototal;


			
                $mrow['div_material'] = isset($div_data[$mrow['id']]) ? $div_data[$mrow['id']] : array();
                if($type == 1)
                $mrow['dm_sub'] = isset($sub_m[$mrow['id']]) ? $sub_m[$mrow['id']] : array();
                $data['material'][$mrow['id']] =$mrow;
                
            }

        
        echo json_encode($data);
    }
    
}