<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Reviews extends CI_Controller {

	function __construct(){ 
		parent::__construct();
		$this->load->helper('adminlogin');
        $this->load->model('Backend/users_mdl');
		checkIfLoggedIn($this->session->userdata('userid'));
		$this->data['session_details'] = $this->Login_mdl->adminlogin_details($this->session->userdata('userid'));
		$this->data['admin_type']=$this->data['session_details']->admin_type;
 		$this->data['success_msg']=$this->session->flashdata('success');
		$this->data['error_msg']=$this->session->flashdata('error');
		$this->data['title']='Reviews | Administrator Panel';
		$this->data['active_class']='reviews_menu';		
		$this->load->model('Property_mdl');
        $this->load->model('Backend/Amenities_mdl'); 
 	}
	
	public function index(){
		$this->data['reviewFor'] = 0;
        $this->data['page_title']="Chacala Review's";
		$this->data['reviewsDataArr'] = $this->Property_mdl->chacalaReviewsArr();
        $this->load->view('Backend/includes/header',$this->data);
        $this->load->view('Backend/reviews/listing',$this->data);
        $this->load->view('Backend/includes/footer');
    }
	
}