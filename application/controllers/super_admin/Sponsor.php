<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class sponsor extends CI_Controller {

	function __construct(){
 
		parent::__construct();
		$this->load->helper('adminlogin');
        $this->load->model('Backend/sponsor_mdl');
		checkIfLoggedIn($this->session->userdata('userid'));
		$this->data['session_details'] = $this->Login_mdl->adminlogin_details($this->session->userdata('userid'));
		$this->data['admin_type']=$this->data['session_details']->admin_type;
 		$this->data['success_msg']=$this->session->flashdata('success');
		$this->data['error_msg']=$this->session->flashdata('error');
		$this->data['title']='Sponsor List | Administrator Panel';
		$this->data['active_class']='cms_menu'; 

 	}

    public function index(){
        $this->data['sponsor_data']=$this->sponsor_mdl->sponsor_details();
        $this->data['page_title']='Sponsor';
        $this->load->view('Backend/includes/header',$this->data);
        $this->load->view('Backend/sponsor/view',$this->data);
        $this->load->view('Backend/includes/footer');
    }

    public function add(){
        $this->data['page_title']='Sponsor';
        $this->load->view('Backend/includes/header',$this->data);
        $this->load->view('Backend/sponsor/add',$this->data);
        $this->load->view('Backend/includes/footer');
    }

    public function edit(){
        $last = $this->uri->total_segments();
		$sponsor_id= $this->uri->segment($last);
		$this->data['edit']=$this->sponsor_mdl->sponsor_fulldetails($sponsor_id);
        $this->data['page_title']='Sponsor';
        $this->load->view('Backend/includes/header',$this->data);
        $this->load->view('Backend/sponsor/edit',$this->data);
        $this->load->view('Backend/includes/footer');
    }

    public function create_entry(){
		echo $this->sponsor_mdl->create_entry();
	}

    public function update(){
        echo $this->sponsor_mdl->update_sponsor_details();
    }

    public function delete(){
        $last = $this->uri->total_segments();
		$sponsor_id= $this->uri->segment($last);

        echo $this->sponsor_mdl->delete_entry($sponsor_id);
        redirect(base_url() . $this->config->item('admin_directory_name') . 'sponsor');

    }
}