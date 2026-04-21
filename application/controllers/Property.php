<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Property extends CI_Controller {
 	 
	function __construct(){ 
		parent::__construct();
		$this->data['success_msg']=$this->session->flashdata('success');
		$this->data['error_msg']=$this->session->flashdata('error');
		$this->data['title'] = $this->config->item('product_name'); 		
		$this->data['configurationDetails'] = $this->Cms_mdl->get_configuration_details(); 
 	}
	
	public function details(){ 
		
		
		
		
		$slug = $this->uri->segment(2);
		$this->data['amenitiesMasterDataArr'] = $this->Property_mdl->amenitiesMasterDataArr();
		$this->data['propertyDetails'] = $this->Property_mdl->propertyDetailsArrBySlug($slug);
		$propertyId = $this->data['propertyDetails']['propertyId'];
		$this->data['reviewsDataArr'] = $this->Property_mdl->activePropertyReviewsDataArr($propertyId);
		$this->data['highlight_date'] = $this->Property_mdl->frontHighlightDate($propertyId);
		
		$this->data['setupMastersData'] = $this->Setup_mdl->setupMastersData();
		$this->data['propertyType'] = $this->data['propertyDetails']['propertyType'];
		
		$this->data['title'] = $this->data['propertyDetails']['name'];
		$this->data['metaTitle'] = $this->data['propertyDetails']['metaTitle'];
		$this->data['metaDesc'] = $this->data['propertyDetails']['metaDesc'];   
		$this->data['metaKeyword'] = $this->data['propertyDetails']['metaKeyword'];
		
		$this->load->view('Frontend/includes/header',$this->data);
		$this->load->view('Frontend/property/details',$this->data);
		$this->load->view('Frontend/includes/footer',$this->data);  
	}
	
}