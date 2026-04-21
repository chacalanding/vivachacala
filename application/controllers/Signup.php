<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Signup extends CI_Controller {
 	 
	function __construct(){ 
		parent::__construct();
		$this->data['success_msg']=$this->session->flashdata('success');
		$this->data['error_msg']=$this->session->flashdata('error');
		$this->data['title'] = $this->config->item('product_name');  
		$this->load->model('Signup_mdl');  		 
 	}
	
	public function index(){
		$this->data['title']='Sign-up';
		$this->data['captcha_text'] = $this->generateRandomString();
		$this->load->view('Frontend/includes/header',$this->data);
		$this->load->view('Frontend/signup/view',$this->data);
		$this->load->view('Frontend/includes/footer',$this->data);  			
	}
	
	public function account_initiated(){
		echo $this->Signup_mdl->account_initiated();
	}
	
	public function checkout(){
		$initiatedEncryptId = $this->uri->segment(3);
		if(isset($initiatedEncryptId) && $initiatedEncryptId){
			$this->data['page_title']='Checkout';
			$this->data['reg_checkout_data'] = $this->Signup_mdl->reg_checkout_data($initiatedEncryptId);
			if(count($this->data['reg_checkout_data'])>0){
				//echo '<pre>';print_r($this->data['reg_checkout_data']);die;
				$this->load->view('Frontend/includes/header',$this->data);
				$this->load->view('Frontend/signup/checkout',$this->data);
				$this->load->view('Frontend/includes/footer',$this->data);	
			}else{
				redirect(base_url().'signup');
			}
		}else{
			redirect(base_url().'signup');
		}
	}
	
	public function checkout_entry(){
		echo $this->Signup_mdl->checkout_entry();
	}
	
	public function payment_error(){
		echo '<h1>Something went wrong, please contact with admin.</h1>';
	}
	
	public function check_login(){
		echo $this->Signup_mdl->check_login();
	}
	
	public function logout(){
		session_destroy();
		redirect(base_url().'login');
	}
	
	public function thankyou(){
		$this->data['title']='Thank You';
		$this->load->view('Frontend/includes/header',$this->data);
		$this->load->view('Frontend/signup/thankyou',$this->data);
		$this->load->view('Frontend/includes/footer',$this->data);  
	}
	
	public function generateRandomString($length = 5) {
		$characters = '123456789ABCDEFGHIJKLMNPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
	} 
	
}