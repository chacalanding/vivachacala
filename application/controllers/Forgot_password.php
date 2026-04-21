<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Forgot_password extends CI_Controller {
 	 
	function __construct(){ 
		parent::__construct();
		$this->data['success_msg']=$this->session->flashdata('success');
		$this->data['error_msg']=$this->session->flashdata('error');
		//$this->data['configuration_details'] = $this->Cms_mdl->get_configuration_details();
		$this->data['top_title'] = $this->config->item('product_name'); 
		$this->load->model('Forgot_password_mdl'); 		 
 	}
	
	public function index(){	
		$this->data['title'] = 'Reset your password';
		$this->data['page_title'] = 'Reset your password'; 
		$this->data['captcha_text'] = $this->generateRandomString();
		$this->load->view('Frontend/includes/header',$this->data);
		$this->load->view('Frontend/forgot_password/view',$this->data);
		$this->load->view('Frontend/includes/footer',$this->data);				
	}
	
	public function send_mail(){
		echo $this->Forgot_password_mdl->forgot_password();
	}
	
	public function recover_password(){		 
		$current_date = time();
		$encryptId = $this->uri->segment(3);
		$sha_forgot = $this->uri->segment(4);
		$this->data['encryptId'] = $encryptId; 
		$this->data['sha_forgot'] = $sha_forgot; 		
		$this->db->where('encryptId', $encryptId);
		$this->db->where('tempForget', $sha_forgot);
		$query = $this->db->get('organizations_members');
		$num = $query->num_rows();
		if($num==0){	
			$this->session->set_flashdata('error', str_msg22);
			redirect(base_url()."forgot_password");
		}else{
		
			$row = $query->row();
			if($current_date>$row->expLinkTime){				
				$this->session->set_flashdata('error', str_msg22);
				redirect(base_url()."forgot_password");			
			}else{				 
				$this->data['title'] = 'Change password';
				$this->data['page_title'] = 'Change password';
				$this->load->view('Frontend/includes/header',$this->data);
				$this->load->view('Frontend/forgot_password/change_password',$this->data);
				$this->load->view('Frontend/includes/footer',$this->data);	 			
			}			
		}
	}
	
	public function recover_password_entry(){
		if(isset($_POST['encryptId']) && $_POST['encryptId']!='' && isset($_POST['sha_forgot']) && $_POST['sha_forgot']!=''){
			echo $this->Forgot_password_mdl->recover_password_entry($_POST['encryptId'],$_POST['sha_forgot']);
		}
	}
	
	
	/*public function recover_password(){	
		$last = $this->uri->total_segments();
		$sha_forgot = $this->uri->segment($last);		
		$this->db->where('tempForget', $sha_forgot);
		$query = $this->db->get('registration');
		$num = $query->num_rows();
		if($num==0){	
			$this->session->set_flashdata('error', str_msg22);
			redirect(base_url()."forgot_password");
		}		
		$this->form_validation->set_rules('new_password', 'Password', 'required'); 
		$this->form_validation->set_rules('confirm_password','Confirm Password','required|matches[new_password]'); 		
		if($this->form_validation->run() === FALSE){		
			$this->data['title'] = 'Change password';
			$this->data['page_title'] = 'Change password';
			$this->load->view('Frontend/includes/header',$this->data);
			$this->load->view('Frontend/forgot_password/change_password',$this->data);
			$this->load->view('Frontend/includes/footer',$this->data);				
		}else{		
			$this->Forgot_password_mdl->recover_password($sha_forgot);			
		}		
	}*/
	
	public function generateRandomString($length = 5) {
		$characters = '123456789abdefghnqrstuABCDEFGHIJKLMNPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
	} 
	 
} 