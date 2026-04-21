<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');   	
	
	function timeAgoCh($timestamp) {
	   
	   $strTime = array("sec", "min", "hour", "day", "month", "year");
	   $length = array("60","60","24","30","12","10");

	   $currentTime = time();
	   if($currentTime >= $timestamp) {
			$diff     = time()- $timestamp;
			for($i = 0; $diff >= $length[$i] && $i < count($length)-1; $i++) {
			$diff = $diff / $length[$i];
			}

			$diff = round($diff);
			return $diff . " " . $strTime[$i] . " ago ";
	   }
	}
	
	function getDatesFromRangeCh($start, $end, $format = 'Y-m-d') { 
		  
		// Declare an empty array 
		$array = array(); 
		  
		// Variable that store the date interval 
		// of period 1 day 
		$interval = new DateInterval('P1D'); 
	  
		$realEnd = new DateTime($end); 
		$realEnd->add($interval); 
	  
		$period = new DatePeriod(new DateTime($start), $interval, $realEnd); 
	  
		// Use loop to store date into array 
		foreach($period as $date) {                  
			$array[] = $date->format($format);  
		} 
	  
		// Return the array elements 
		return $array; 
	}  
	
	function callPropertyListingPageCh($propertyType,$propertyTypeName){
		$CI = & get_instance(); 		
		$CI->data['propertyType'] = $propertyType;
		$CI->data['propertyTypeName'] = $propertyTypeName;
		$CI->data['propertiesDataArr'] = $CI->Property_mdl->villaPropertiesDataArr($propertyType);
		$CI->data['setupMastersData'] = $CI->Setup_mdl->setupMastersData();
		$CI->load->view('Frontend/includes/header',$CI->data);
		$CI->load->view('Frontend/property/listing',$CI->data);
		$CI->load->view('Frontend/includes/footer',$CI->data);
	}
	
	function getMoreImagesCh($propertyId,$limit){
		$CI = & get_instance();		
		return $CI->Property_mdl->getMoreImages($propertyId,$limit);
	}
	
	function getPlanningMinLinksCh(){
		$CI = & get_instance();
		$CI->load->model('Cms_mdl');
		return $CI->Cms_mdl->getPlanningMinLinks();
	}
	
	function getPostedJobsArrayCh(){
		$CI = & get_instance();
		$CI->load->model('Jobs_mdl');
		return $CI->Jobs_mdl->get_posted_jobs_data();
	}
	
	function getAllForumDatacCh(){
		$CI = & get_instance();
		$CI->load->model('Community_board_mdl');
		return $CI->Community_board_mdl->get_all_community_board_data();
	}
	
	function get_forum_replys_data_ch($forumId){
		$CI = & get_instance();
		$CI->load->model('Community_board_mdl');
		return $CI->Community_board_mdl->get_forum_replys_data($forumId);
	}
	
	function getAllResourcesDatacCh(){
		$CI = & get_instance();
		$CI->load->model('Resources_mdl');
		return $CI->Resources_mdl->get_all_resources_data();
	}
	
	function chkPaidMemberStsCh($userId){
		$CI = & get_instance();
		$CI->load->model('Signup_mdl');
		return $CI->Signup_mdl->chkPaidMemberStsCh($userId);
	}
	
	function sponsors_listing_ch(){
		$CI = & get_instance();
		$CI->load->model('Cms_mdl');
		return $CI->Cms_mdl->sponsors_listing();
	}
	
	function assessment_directory_listing_ch(){
		$CI = & get_instance();
		$CI->load->model('Cms_mdl');
		return $CI->Cms_mdl->assessment_directory_listing();
	}
	
	function create_slug_ch($string){
		$slug_a = url_title(convert_accented_characters($string), 'dash', true);
		//$slug_b = preg_replace ('/[0-9]+$/','', $slug_a );
		$slug_c = auto_link($slug_a, 'url');
		return reduce_multiples(trim($slug_c), "-", TRUE);
	}
	
	function filter_array($array,$term,$field_name){
		$matches = array();
		foreach($array as $a){
			if($a["$field_name"] == $term)
				$matches[]=$a;
		}
		return $matches;
	}
	
	function filter_array_three($array,$term,$field_name,$term_1,$field_name_1,$term_2,$field_name_2){
		$matches = array();
		foreach($array as $a){
			if($a["$field_name"] == $term && $a["$field_name_1"] == $term_1 && $a["$field_name_2"] == $term_2)
				$matches[]=$a;
		}
		return $matches;
	}
	
	function filter_array_two($array,$term,$field_name,$term_1,$field_name_1){
		$matches = array();
		foreach($array as $a){
			if($a["$field_name"] == $term && $a["$field_name_1"] == $term_1)
				$matches[]=$a;
		}
		return $matches;
	}
	
	function filter_array_two_or_con($array,$term,$field_name,$term_1,$field_name_1){
		$matches = array();
		foreach($array as $a){
			if($a["$field_name"] == $term || $a["$field_name_1"] == $term_1)
				$matches[]=$a;
		}
		return $matches;
	}
	
	function get_multidimension_array_key_ch($products, $field, $value){
		foreach($products as $key => $product){
			if($product[$field]===$value){
				return $key;
			}	 
		}
		return false;
	}
	
	function get_widgets_data_ch(){
		$CI = & get_instance();
		$CI->load->model('Widgets_mdl');
		return $CI->Widgets_mdl->widgets_list();
	}
	
	function get_cmsmeta_fields_h($page_id){
		$CI = & get_instance();
		$CI->load->model('Master_data_mdl');
		return $CI->Master_data_mdl->get_cmsmeta_fields($page_id);
 	}
	
	function get_widgetsmeta_fields_h($widget_id){
		$CI = & get_instance();
		$CI->load->model('Widgets_mdl');
		return $CI->Widgets_mdl->get_widgetsmeta_fields($widget_id);
 	}
	
	function get_widgetmeta_options_h($widgetsmeta_id){
 		$CI = & get_instance();
		$CI->load->model('Widgets_mdl');
		return $CI->Widgets_mdl->get_widgetmeta_options($widgetsmeta_id);
	}
	
	function get_master_course_level_list_h(){
		$CI = & get_instance();
		$CI->load->model('Master_data_mdl');
		return $CI->Master_data_mdl->get_master_course_level_list();
 	}