<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
    

	 function __construct() {
        parent::__construct();
        $this->load->model("Login_Model",'login');
        $this->load->model('Cogs_Model','cogs');
        if(!isset($_SESSION['system']))
        $sess = $this->cogs->system_session();
       
        
    }

    public function index(){
            if(isset($_SESSION['user_id']))
            redirect(base_url());
            $this->load->view('login');
    }
    function login(){
    $resp = $this->login->login();
    if($resp)
        echo $resp;

    }
    function check_email(){
        extract($_POST);
        $qry = $this->db->query('SELECT * FROM users where email = "'.$email.'" and delete_flag = 0 ')->num_rows();
        if($qry)
        echo $qry;
    }

    function create_account(){
        $resp = $this->login->create_account();
        if($resp)
        echo $resp;
    }
    function logout(){
        
        $this->session->sess_destroy();
        
        redirect(base_url('login'),'refresh');
    }
    public function Login_Auth(){	
        $response = array();
        //Recieving post input of email, password from request
        $email = $this->input->post('email');
        $password = sha1($this->input->post('password'));
        $remember = $this->input->post('remember');
        #Login input validation\
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        $this->form_validation->set_rules('email', 'User Email', 'trim|xss_clean|required|min_length[7]');
        $this->form_validation->set_rules('password', 'Password', 'trim|xss_clean|required|min_length[6]');
        
        if($this->form_validation->run() == FALSE){
            $this->session->set_flashdata('feedback','UserEmail or Password is Invalid');
            redirect(base_url() . 'login', 'refresh');		
        }
        else{
            //Validating login
            $login_status = $this->validate_login($email, $password);
            $response['login_status'] = $login_status;
            if ($login_status == 'success') {
                if($remember){
                    setcookie('email',$email,time() + (86400 * 30));
                    setcookie('password',$this->input->post('password'),time() + (86400 * 30));
                    redirect(base_url() . 'login', 'refresh');
                    
                } else {
                    if(isset($_COOKIE['email']))
                    {
                        setcookie('email',' ');
                    }
                    if(isset($_COOKIE['password']))
                    {
                        setcookie('password',' ');
                    }        		
                    redirect(base_url() . 'login', 'refresh');
                }
            
            }
            else{
                $this->session->set_flashdata('feedback','UserEmail or Password is Invalid');
                redirect(base_url() . 'login', 'refresh');
            }
        }
        }
        //Validating login from request
        function validate_login($email = '', $password = '') {
            $credential = array('em_email' => $email, 'em_password' => $password,'status' => 'ACTIVE');
    
    
            $query = $this->login_model->getUserForLogin($credential);
            if ($query->num_rows() > 0) {
                $row = $query->row();
                $this->session->set_userdata('user_login_access', '1');
                $this->session->set_userdata('user_login_id', $row->em_id);
                $this->session->set_userdata('name', $row->first_name);
                $this->session->set_userdata('email', $row->em_email);
                $this->session->set_userdata('user_image', $row->em_image);
                $this->session->set_userdata('user_type', $row->em_role);
                return 'success';
            }
        }
        /*Logout method*/
        /*User signup*/
    /*	public function viewSignUp()
        {
        $data=array();
        $data['settingsvalue'] = $this->dashboard_model->GetSettingsValue();    
        $this->load->view('backend/signup',$data);	
        }*/
        /*Validating user signup form request*/
        
        public function confirm_mail_send($email,$randcode){
            $config = Array( 
            'protocol' => 'smtp', 
            'smtp_host' => 'ssl://smtp.googlemail.com', 
            'smtp_port' => 465, 
            'smtp_user' => 'tomgusquare@gmail.com', 
            'smtp_pass' => ''
            ); 		  
             $from_email = "tomgusquare@gmail.com"; 
             $to_email = $email; 
       
             //Load email library 
             $this->load->library('email',$config); 
       
             $this->email->from($from_email, 'Dotdev'); 
             $this->email->to($to_email);
             $this->email->subject('Confirm Your Account'); 
             $message	 =	"Confirm Your Account";
             $message	.=	"Click Here : ".base_url()."Confirm_Account?C=" . $randcode.'</br>'; 
             $this->email->message($message); 
       
             //Send mail 
             if($this->email->send()){ 
                 $this->session->set_flashdata('feedback','Kindly check your email To reset your password');
             }
             else {
             $this->session->set_flashdata("feedback","Error in sending Email."); 
             }			
        }
        public function verification_confirm(){
            $verifycode = $this->input->get('C');
            $userinfo = $this->login_model->GetuserInfoBycode($verifycode);
            if($userinfo){
                $data = array();
                $data = array(
                    'status'=>'ACTIVE',
                    'confirm_code' => 0
                );
                $this->login_model->UpdateStatus($verifycode,$data);
                if($this->db->affected_rows()){
                $this->session->set_flashdata('feedback','Your Account has been confirmed!! now login');
                $this->load->view('login');
                }			
            } else {
                $this->session->set_flashdata('feedback','Sorry your account has not been varified');
                $this->load->view('login');  			
            }
        }
        public function forgotten_page(){
            $data=array();
            $data['settingsvalue'] = $this->admin_model->GetSettingsValue();
            $this->load->view('forgot_password',$data);
        }
        public function forgot_password(){
            $email = $this->input->post('email');
            $checkemail = $this->login_model->Does_email_exists($email);
            if($checkemail){
                $randcode = md5(uniqid());
                $data=array();
                $data=array(
                    'forgotten_code'=>$randcode
                );
                $updatedata = $this->login_model->UpdateKey($data,$email);
                $updateaffect = $this->db->affected_rows();
                if($updateaffect){
                $email=$this->input->post('email');	
                $this->send_mail($email,$randcode);
                $this->session->set_flashdata('feedback','Kindly check your email' .' '.$email. 'To reset your password');
                redirect('Retriev');				
                } else {
                    
                }
            } 
            else {
                $this->session->set_flashdata('feedback','Please enter a valid email address!');
                redirect('Retriev');
            }
        }
          public function send_mail($email,$randcode) {
            $config = Array( 
            'protocol' => 'smtp', 
            'smtp_host' => 'ssl://smtp.googlemail.com', 
            'smtp_port' => 25, 
            'smtp_user' => 'tomgusquare@gmail.com', 
            'smtp_pass' => ''
            ); 		  
             $from_email = "tomgusquare@gmail.com"; 
             $to_email = $email; 
       
             //Load email library 
             $this->load->library('email',$config); 
       
             $this->email->from($from_email, 'Dotdev'); 
             $this->email->to($to_email);
             $this->email->subject('Reset your password!!Dotdev'); 
            $message	.=	"Your or someone request to reset your password" ."<br />";
            $message	.=	"Click  Here : ".base_url()."Reset_password?p=" . $randcode."<br />"; 
             $this->email->message($message); 
       
             //Send mail 
             if($this->email->send()){ 
                 $this->session->set_flashdata('feedback','Kindly check your email To reset your password');
             }
             else {
             $this->session->set_flashdata("feedback","Error in sending Email."); 
             }	
          }
        public function Reset_View(){
            $this->load->helper('form');
            $reset_key = $this->input->get('p');
            if($this->login_model->Does_Key_exists($reset_key)){
            $data['key']= $reset_key;
            $this->load->view('reset_page',$data);
            } 
            else {
                $this->session->set_flashdata('feedback','Please enter a valid email address!');
                redirect('Retriev');
            }
        }
        public function Reset_password_validation(){
            $password = $this->input->post('password');
            $confirm = $this->input->post('confirm');
            $key = $this->input->post('reset_key');
            $userinfo = $this->login_model->GetUserInfo($key);
            
            if($password == $confirm){
                if($userinfo->password != sha1($password)){
                $data=array();
                $data = array(
                    'forgotten_code'=> 0,
                    'password'=>sha1($password)
                    );
            $update = $this->login_model->UpdatePassword($key,$data);
            if($this->db->affected_rows()){
                $data['message'] = 'Successfully Updated your password!!';
                $this->load->view('login',$data);
            }
            } else {
                 $this->session->set_flashdata('feedback','You enter your old password.Please enter new password');
                 redirect('Reset_password?p='.$key);			
            }
            } else {
                 $this->session->set_flashdata('feedback','Password does not match');
                 redirect('Reset_password?p='.$key);
            }
        }	
        public function ForgotPassword()
        {
              $email = $this->input->post('email');      
              $findemail = $this->login->ForgotPassword($email);  
              if($findemail){
               $this->login->sendpassword($findemail);        
                }else{
               $this->session->set_flashdata('msg',' Email not found!');
               redirect(base_url().'login','refresh');
           }
        }
    }