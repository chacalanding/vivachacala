<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Rental extends CI_Controller {
 	 
	function __construct(){ 
		parent::__construct();
		$this->data['success_msg']=$this->session->flashdata('success');
		$this->data['error_msg']=$this->session->flashdata('error');
		$this->data['title'] = $this->config->item('product_name');
		$this->data['configurationDetails'] = $this->Cms_mdl->get_configuration_details(); 
 	}
	
	public function index(){
		$this->data['metaTitle'] = "Chacala Rentals: Your Vacation Gateway to Seaside Luxury and Comfort";
		$this->data['metaDesc'] = "Experience the pinnacle of luxury at Chacala Resort Rentals, where opulence meets the serene beauty of Mexico's Riviera.";   
		$this->data['metaKeyword'] = "Chacala Rentals, Chacala Resort Rentals, Chacala Vacation Resorts, Chacala Villa Rentals, Seaside Vacation Rentals in Chacala, Chacala Beachfront Vacation Villas";   
		$propertyType = 0;
		$propertyTypeName = 'chacala-vacation-rentals';
		callPropertyListingPageCh($propertyType,$propertyTypeName);
	}
	
}