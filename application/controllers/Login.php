<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
 	 
	function __construct(){ 
		parent::__construct();
		$this->data['success_msg']=$this->session->flashdata('success');
		$this->data['error_msg']=$this->session->flashdata('error');
		$this->data['title'] = $this->config->item('product_name');    		 
 	}
	
	public function index(){ 	
		$this->data['title']='';
		$this->load->view('Frontend/includes/header',$this->data);
		$this->load->view('Frontend/login/view',$this->data);
		$this->load->view('Frontend/includes/footer',$this->data);  			
	}
	
}