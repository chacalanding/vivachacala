<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Inquiries extends CI_Controller {

	function __construct(){ 
		parent::__construct();
		$this->load->helper('adminlogin');
        $this->load->model('Backend/users_mdl');
		checkIfLoggedIn($this->session->userdata('userid'));
		$this->data['session_details'] = $this->Login_mdl->adminlogin_details($this->session->userdata('userid'));
		$this->data['admin_type']=$this->data['session_details']->admin_type;
 		$this->data['success_msg']=$this->session->flashdata('success');
		$this->data['error_msg']=$this->session->flashdata('error');
		$this->data['title']='Inquiries | Administrator Panel';
		$this->data['active_class']='inquiries_menu';
		
		$this->load->model('Form_entry_mdl');
        $this->load->model('Backend/Amenities_mdl');
		
		$last_segment = $this->uri->segment(4);
		$this->data['last_segment']=$last_segment;
		if($last_segment=='business'){
			$this->data['propertyType'] = 1;
			$this->data['section_status_slug']='business';
			$this->data['section_status_label']='Business';
		}else if($last_segment=='real_estate'){
			$this->data['propertyType'] = 2;
			$this->data['section_status_slug']='real_estate';
			$this->data['section_status_label']='Real Estate';
		}else{
			$this->data['propertyType'] = 0;
			$this->data['section_status_slug']='villa';
			$this->data['section_status_label']='Villa';
		}
 	}
	
	public function listing(){
        $this->data['page_title']='Inquiries for '.$this->data['section_status_label'];
		$this->data['inquiriesDataArr'] = $this->Form_entry_mdl->inquiriesDataArr($this->data['propertyType']);
        $this->load->view('Backend/includes/header',$this->data);
        $this->load->view('Backend/inquiries/listing',$this->data);
        $this->load->view('Backend/includes/footer');
    }
	
	public function deleteInquiry(){
		if(isset($_GET['inquiryId']) && $_GET['inquiryId']!=''){
			echo $this->Form_entry_mdl->deleteInquiry($_GET['inquiryId']);
		}
		if(isset($_GET['slug']) && $_GET['slug']!='' && $_GET['slug']=='contact'){
			redirect(base_url().$this->config->item('admin_directory_name').'inquiries/contact');
		}else{
			redirect(base_url().$this->config->item('admin_directory_name').'inquiries/listing/'.$_GET['slug']);
		}
	}
	
	public function contact(){
        $this->data['page_title']='Inquiries : : Contact Us';
		$this->data['contactUsDataArr'] = $this->Form_entry_mdl->contactInquiriesDataArr();
        $this->load->view('Backend/includes/header',$this->data);
        $this->load->view('Backend/inquiries/contact',$this->data);
        $this->load->view('Backend/includes/footer');
    }
	
	public function newsletter(){
        $this->data['page_title']="Inquiries : : Subscriber's";
		$this->data['newsletterDataArr'] = $this->Form_entry_mdl->newsletterDataArr();
        $this->load->view('Backend/includes/header',$this->data);
        $this->load->view('Backend/inquiries/newsletter',$this->data);
        $this->load->view('Backend/includes/footer');
    }
	
	public function deleteNewsLetter(){
		if(isset($_GET['newsId']) && $_GET['newsId']!=''){
			echo $this->Form_entry_mdl->deleteNewsLetter($_GET['newsId']);
		}
		redirect(base_url().$this->config->item('admin_directory_name').'inquiries/newsletter');
	}
	
}