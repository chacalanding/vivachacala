<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Real_estate extends CI_Controller {
 	 
	function __construct(){ 
		parent::__construct();
		$this->data['success_msg']=$this->session->flashdata('success');
		$this->data['error_msg']=$this->session->flashdata('error');
		$this->data['title'] = $this->config->item('product_name');
		$this->data['configurationDetails'] = $this->Cms_mdl->get_configuration_details(); 
 	}
	
	public function index(){
		$this->data['metaTitle'] = "Chacala Real Estate: Your Gateway to Coastal Living Perfection";
		$this->data['metaDesc'] = "Browse our Chacala property listings and find your ideal coastal retreat, whether it's a luxurious residence or seaside land for sale.";   
		$this->data['metaKeyword'] = "Chacala Real Estate, Chacala Beachfront Homes, Chacala Ocean View Properties, Chacala Property Listings, Chacala Seaside Land for Sale, Luxury Real Estate in Chacala";
		$propertyType = 2;
		$propertyTypeName = 'chacala-mexico-real-estate';
		callPropertyListingPageCh($propertyType,$propertyTypeName);
	}
	
}