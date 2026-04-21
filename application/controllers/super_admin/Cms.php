<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cms extends CI_Controller {
 	 
	function __construct(){
 
		parent::__construct();
		$this->load->helper('adminlogin');
		checkIfLoggedIn($this->session->userdata('userid'));
		$this->data['session_details'] = $this->Login_mdl->adminlogin_details($this->session->userdata('userid'));
		$this->data['admin_type']=$this->data['session_details']->admin_type;
 		$this->data['success_msg']=$this->session->flashdata('success');
		$this->data['error_msg']=$this->session->flashdata('error');
		$this->data['title']='CMS | Administrator Panel';
		$this->data['active_class']='cms_menu';    
 	}
	
	public function top_content(){
 		$page_name = 'home';
		$module_name = 'top_content';
 		$this->data['top_section'] = $this->Cms_mdl->welcome_content_detail($page_name,$module_name);
		$this->data['page_title']='CMS : : Home : : Top Section';		
		$this->data['sub_active_class']='home_menu'; 
		$this->load->view('Backend/includes/header',$this->data);
		$this->load->view('Backend/cms/home/top_content',$this->data);
		$this->load->view('Backend/includes/footer');		
	}
	
	public function top_section_update(){
		echo $this->Cms_mdl->top_section_update();
	}	
	
	public function page(){
		$last = $this->uri->total_segments();
		$page_name = $this->uri->segment($last);
 		$module_name='main_content';
		$this->form_validation->set_rules('txt_title','Title','required'); 
		if($this->form_validation->run() == FALSE){ 
			$this->data['page_content'] = $this->Cms_mdl->cms_details($page_name,$module_name);
			$this->data['page_title']='CMS : : '.ucwords(str_replace('_',' ',$page_name));	
			if($page_name=='home_welcome'){
				$this->data['sub_active_class']='home_menu'; 
			}
			$this->load->view('Backend/includes/header',$this->data);
			$this->load->view('Backend/cms/manage',$this->data);
			$this->load->view('Backend/includes/footer');
		}else{
			$this->Cms_mdl->content_manage($page_name,$module_name);
			redirect(base_url().$this->config->item('admin_directory_name').'/cms/page/'.$page_name);
		}		
	}

	
}	