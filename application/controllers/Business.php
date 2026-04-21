<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Business extends CI_Controller {
 	 
	function __construct(){ 
		parent::__construct();
		$this->data['success_msg']=$this->session->flashdata('success');
		$this->data['error_msg']=$this->session->flashdata('error');
		$this->data['title'] = $this->config->item('product_name');
		$this->data['configurationDetails'] = $this->Cms_mdl->get_configuration_details(); 
 	}
	
	public function index(){
		$this->data['metaTitle'] = "Chacala Local Business Spotlight: Discover Authenticity and Excellence";
		$this->data['metaDesc'] = "Dive into the heart of Chacala's vibrant community with our Local Business Spotlight. providing residents and visitors alike with distinctive offerings and personalized services.";   
		$this->data['metaKeyword'] = "Chacala Local Businesses, Local Services in Chacala, Marina Chacala Shops, Chacala Community Businesses, Local Entrepreneurs in Chacala";
		$propertyType = 1;
		$propertyTypeName = 'local-chacala-business';
		callPropertyListingPageCh($propertyType,$propertyTypeName);
	}
	
}