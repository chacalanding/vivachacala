<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {
 	 
	function __construct(){ 
		parent::__construct();
		$this->load->helper('userlogin');
		checkIfLoggedIn($this->session->userdata('sess_naw_memberId'));
		$memberId = $this->session->userdata('sess_naw_memberId');
		$this->data['session_details'] = $this->Signup_mdl->userlogin_details($memberId);
		$organizationId = $this->data['session_details']->organizationId;	
		$this->data['organization_details'] = $this->Signup_mdl->organization_details($organizationId);	
 		$this->data['success_msg'] = $this->session->flashdata('success');
		$this->data['error_msg'] = $this->session->flashdata('error');
		$this->data['title'] = 'Profile | '.$this->config->item('product_name');  
 	}
	
	public function index(){
		$this->load->view('Frontend/includes/header',$this->data);
		$this->load->view('Frontend/pages/profile',$this->data);
		$this->load->view('Frontend/includes/footer',$this->data);
	}
	
	public function update_entry(){
		echo $this->Signup_mdl->update_entry();
	}
	
	public function change_password(){
		$this->data['title'] = 'Change Your Password';  
		$this->load->view('Frontend/includes/header',$this->data);
		$this->load->view('Frontend/pages/change_password',$this->data);
		$this->load->view('Frontend/includes/footer',$this->data);
	}
	
	public function change_password_entry(){
		echo $this->Signup_mdl->change_password_entry();
	}
	
}