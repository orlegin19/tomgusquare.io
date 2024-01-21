<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Login_Model extends CI_Model {

 function __construct() {
        parent::__construct();
    }
    public function getUserForLogin($credential){			
        return $this->db->get_where('users', $credential);
        }
        public function getdata(){
        $query =$this->db->get('users');
        $result=$query->result();
        return $result;
        }
        //**exists employee email check**//
        public function Does_email_exists($email) {
            $user = $this->db->dbprefix('users');
            $sql = "SELECT `email` FROM $user
            WHERE `email`='$email'";
            $result=$this->db->query($sql);
            if ($result->row()) {
                return $result->row();
            } else {
                return false;
            }
        }
        public function insertUser($data){
            $this->db->insert('users',$data);
        }
        public function UpdateKey($data,$email){
            $this->db->where('email',$email);
            $this->db->update('users',$data);
        }
        public function UpdatePassword($key,$data){
            $this->db->where('forgotten_code',$key);
            $this->db->update('users',$data);	    
        }	
        public function UpdateStatus($verifycode,$data){
            $this->db->where('confirm_code',$verifycode);
            $this->db->update('users',$data);	    
        }
        //**exists employee email check**//
        public function Does_Key_exists($reset_key) {
            $user = $this->db->dbprefix('users');
            $sql = "SELECT `forgotten_code` FROM $user
            WHERE `forgotten_code`='$reset_key'";
            $result=$this->db->query($sql);
            if ($result->row()) {
                return $result->row();
            } else {
                return false;
            }
        }
        public function GetUserInfo($key){
            $user = $this->db->dbprefix('users');
            $sql = "SELECT `password` FROM $user
            WHERE `forgotten_code`='$key'";
            $query=$this->db->query($sql);
            $result = $query->row();
            return $result;			
        }		
        public function GetuserInfoBycode($verifycode){
            $user = $this->db->dbprefix('users');
            $sql = "SELECT * FROM $user
            WHERE `confirm_code`='$verifycode'";
            $query=$this->db->query($sql);
            $result = $query->row();
            return $result;			
        }	

    function create_account(){
        extract($_POST);
        $data['firstname'] = $firstname;
        $data['lastname'] = $lastname;
        $data['email'] = $email2;
        $data['password'] = md5($password);
        $data['phone_number'] = $phone_number;
       
        if(!isset($type))
        $data['type'] = 5;
        else
        $data['type'] = $type;

        $insert = $this->db->insert('users',$data);
        if($insert){
            $user_id= $this->db->insert_id();
            $data['user_id'] = $user_id;
            foreach($data as $key => $val){
                if($key != 'password')
                $this->session->set_userdata($key,$val);
            }

            $resp['status'] = 'success';
            $resp['type']=$data['type'];
            return json_encode($resp);
        }

    }
    function login(){
        extract($_POST);
        $chk_email = $this->db->get_where('users',array('email'=>$email))->num_rows();
        if($chk_email <= 0 ){
            $resp['status'] = 'email_unknown';
        }else{
            $qry = $this->db->get_where('users',array('email'=>$email,'password'=>md5($password)));
            if($qry->num_rows() <= 0){
            $resp['status'] = 'login_failed';
            }else{
                if($qry->row()->status ==2 ){
                 $resp['status'] = 'blocked';
                   
                }else{
                    foreach($qry->row() as $key => $val){
                    if($key != 'password'){
                        $key = $key == 'id' ? 'user_id' : $key;
                        $this->session->set_userdata($key,$val);
                    }
                }

                $resp['status'] = 'success';
                $resp['type'] = $this->session->userdata('type');
                }
                
            }
        }
        return json_encode($resp);
    }
    public function ForgotPassword($email)
    {
           $this->db->select('email');
           $this->db->from('users'); 
           $this->db->where('email', $email); 
           $query=$this->db->get();
           return $query->row_array();
    }
    public function sendpassword($data)
   {
           $email = $data['email'];
           $query1=$this->db->query("SELECT *  from users where email = '".$email."' ");
           $row=$query1->result_array();
           if ($query1->num_rows()>0)
         
   {
           $passwordplain = "";
           $passwordplain  = rand(999999999,9999999999);
           $newpass['password'] = md5($passwordplain);
           $this->db->where('email', $email);
           $this->db->update('users', $newpass); 
           $mail_message='Dear '.$row[0]['tomgusquare@gmail.com'].','. "\r\n";
           $mail_message.='Thanks for contacting regarding to forgot password,<br> Your <b>Password</b> is <b>'.$passwordplain.'</b>'."\r\n";
           $mail_message.='<br>Please Update your password.';
           $mail_message.='<br>Thanks & Regards';
           $mail_message.='<br>Tomgu Square';        
           date_default_timezone_set('Etc/UTC');
           require 'assets\phpmailer\phpmailer\src\Exception.php';
           require 'assets\phpmailer\phpmailer\src\PHPMailer.php';
           require 'assets\phpmailer\phpmailer\src\SMTP.php';
           $mail = new phpmailer;
           $mail->isSMTP();
           $mail->SMTPSecure = "tls"; 
           $mail->Debugoutput = 'html';
           $mail->Host = "smtp.gmail.com";
           $mail->Port = 587;
           $mail->SMTPAuth = true;   
           $mail->Username = "tomgusquare@gmail.com";    
           $mail->Password = "jmenwitxakswkzjl";
           $mail->setFrom('tomgusquare@gmail.com', 'Tomgu Square');
           $mail->IsHTML(true);
           $mail->addAddress($email);
           $mail->Subject = 'OTP from Tomgu Square';
           $mail->Body    = $mail_message;
           $mail->AltBody = $mail_message;
   if (!$mail->send()) {
        $this->session->set_flashdata('msg','Failed to send password, please try again!');
   } else {
      $this->session->set_flashdata('msg','Password sent to your email!');
   }
     redirect(base_url().'login','refresh');        
   }
   else
   {  
    $this->session->set_flashdata('msg','Email not found try again!');
    redirect(base_url().'login','refresh');
   }
 }
}
?>