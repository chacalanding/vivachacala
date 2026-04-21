<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Spotlight extends CI_Controller {

	function __construct(){ 
		parent::__construct();
		$this->load->helper('adminlogin');
        $this->load->model('Backend/planning_committee_mdl');
		checkIfLoggedIn($this->session->userdata('userid'));
		$this->data['session_details'] = $this->Login_mdl->adminlogin_details($this->session->userdata('userid'));
		$this->data['admin_type']=$this->data['session_details']->admin_type;
 		$this->data['success_msg']=$this->session->flashdata('success');
		$this->data['error_msg']=$this->session->flashdata('error');
		$this->data['title']='Spotlight Submissions | Administrator Panel';
		$this->data['active_class']='spotlight_menu'; 
 	}

    public function submissions(){
        $this->data['spotlight_submissions_data']=$this->Cms_mdl->spotlight_submissions_data();
        $this->data['page_title']='Spotlight Submissions';
        $this->load->view('Backend/includes/header',$this->data);
        $this->load->view('Backend/cms/spotlight_submissions',$this->data);
        $this->load->view('Backend/includes/footer');
    }
	
	public function edit(){
		if(isset($_GET['spotlightId']) && $_GET['spotlightId']!=''){
			$this->data['submission_details']=$this->Cms_mdl->spotlight_submissions_details($_GET['spotlightId']);
			$this->data['page_title']='Spotlight Submission : : Edit';
			$this->load->view('Backend/includes/header',$this->data);
			$this->load->view('Backend/cms/edit_submissions',$this->data);
			$this->load->view('Backend/includes/footer');
		}else{
			redirect(base_url() . $this->config->item('admin_directory_name') . 'spotlight/submissions');
		}
    }
	
	public function update_entry(){
		echo $this->Cms_mdl->update_submission_entry();	
	}
	
	public function delete_submission(){
		if(isset($_GET['spotlightId']) && $_GET['spotlightId']!=''){
			$this->Cms_mdl->delete_submission($_GET['spotlightId']);
		}
        redirect(base_url() . $this->config->item('admin_directory_name') . 'spotlight/submissions');
	}
	
	public function update_status(){
		if(isset($_GET['spotlightId']) && $_GET['spotlightId']!=''){
			 $spotlightId=$_GET['spotlightId'];
			 $column_name=$_GET['column_name'];
			 $status=$_GET['status'];
			 echo $this->Cms_mdl->update_spotlight_submission_status($spotlightId,$column_name,$status);
		}
	}
	
}