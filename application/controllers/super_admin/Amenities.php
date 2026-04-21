<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Amenities extends CI_Controller {

	function __construct(){
 
		parent::__construct();
		$this->load->helper('adminlogin');
		checkIfLoggedIn($this->session->userdata('userid'));
		$this->data['session_details'] = $this->Login_mdl->adminlogin_details($this->session->userdata('userid'));
		$this->data['admin_type']=$this->data['session_details']->admin_type;
 		$this->data['success_msg']=$this->session->flashdata('success');
		$this->data['error_msg']=$this->session->flashdata('error');
		$this->data['title']='Amenities | Administrator Panel';
		$this->data['active_class']='amenities_menu'; 
        $this->load->model('Backend/Amenities_mdl');
 	}

    public function index(){
        $this->data['member_data']=$this->Amenities_mdl->amenities_details();
        $this->data['page_title']='Amenities';
        $this->load->view('Backend/includes/header',$this->data);
        $this->load->view('Backend/amenities/view',$this->data);
        $this->load->view('Backend/includes/footer');
    }

    public function add(){
        $this->data['page_title']='Amenities : : Add';
        $this->load->view('Backend/includes/header',$this->data);
        $this->load->view('Backend/amenities/add',$this->data);
        $this->load->view('Backend/includes/footer');
    }

    public function edit(){
        $last = $this->uri->total_segments();
		$member_id= $this->uri->segment($last);
		$this->data['amenitiesDetails']=$this->Amenities_mdl->amenities_fulldetails($member_id);
        $this->data['page_title']='Amenities : : Edit';
        $this->load->view('Backend/includes/header',$this->data);
        $this->load->view('Backend/amenities/edit',$this->data);
        $this->load->view('Backend/includes/footer');
    }

    public function create_entry(){
         echo $this->Amenities_mdl->create_entry();
	}

    public function update(){
        echo $this->Amenities_mdl->update_amenities();

    }

    public function delete(){
        $last = $this->uri->total_segments();
		$member_id= $this->uri->segment($last);

        echo $this->Amenities_mdl->delete_entry($member_id);
        redirect(base_url() . $this->config->item('admin_directory_name') . 'amenities');

    }
}