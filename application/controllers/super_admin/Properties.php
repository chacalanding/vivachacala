<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Properties extends CI_Controller {

	function __construct(){ 
		parent::__construct();
		$this->load->helper('adminlogin');
        $this->load->model('Backend/users_mdl');
		checkIfLoggedIn($this->session->userdata('userid'));
		$this->data['session_details'] = $this->Login_mdl->adminlogin_details($this->session->userdata('userid'));
		$this->data['admin_type']=$this->data['session_details']->admin_type;
 		$this->data['success_msg']=$this->session->flashdata('success');
		$this->data['error_msg']=$this->session->flashdata('error');
		$this->data['title']='Properties | Administrator Panel';
		$this->data['active_class']='properties_menu';
		
		$this->load->model('Property_mdl');
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
		$this->data['setupMastersData'] = $this->Setup_mdl->setupMastersData();
 	}
	
	public function listing(){
        $this->data['page_title']='Properties : : '.$this->data['section_status_label'].' Listing';
		$this->data['propertyDataArr'] = $this->Property_mdl->propertyDataArr($this->data['propertyType']);
        $this->load->view('Backend/includes/header',$this->data);
        $this->load->view('Backend/properties/listing',$this->data);
        $this->load->view('Backend/includes/footer');
    }

    public function create(){
		$this->data['propertyDetails'] = array();
        $this->data['page_title']='Properties';
        $this->load->view('Backend/includes/header',$this->data);
        $this->load->view('Backend/properties/create',$this->data);
        $this->load->view('Backend/includes/footer');
    }
	
	public function manage(){
	
		//$Date = getDatesFromRangeCh('2023-10-10', '2023-11-16');
		
		// echo '<pre>';print_r($Date);die;
		 
		$encryptId = $this->uri->segment(4);
 		$this->data['propertyDetails'] = $this->Property_mdl->propertyDetailsArrByEncryptId($encryptId);
		$propertyId = $this->data['propertyDetails']['propertyId'];
		$propertyType = $this->data['propertyDetails']['propertyType'];
		
		$this->data['propertyType'] = $propertyType;
		if($propertyType==1){
			$this->data['section_status_slug']='business';
			$this->data['section_status_label']='Business';
		}else if($propertyType==2){
			$this->data['section_status_slug']='real_estate';
			$this->data['section_status_label']='Real Estate';
		}else{
			$this->data['section_status_slug']='villa';
			$this->data['section_status_label']='Villa';
		}
		
		
        $this->data['activeAmenitiesArr'] = $this->Amenities_mdl->activeAmenitiesArr();
		$this->data['reviewFor'] = 1;
		$this->data['reviewsDataArr'] = $this->Property_mdl->propertyReviewsArr($propertyId);
		$this->data['imagesDataArr'] = $this->Property_mdl->propertyImagesArr($propertyId);
		$this->data['highlight_date'] = $this->Property_mdl->highlight_date($propertyId);
        $this->data['page_title']='Property : : '.$this->data['propertyDetails']['name'];
        $this->load->view('Backend/includes/header',$this->data);
        $this->load->view('Backend/properties/manage',$this->data);
        $this->load->view('Backend/includes/footer');
    }
	
	public function manageBasicEntry(){
		echo $this->Property_mdl->manageBasicEntry();
	}
	
	public function priorityUpdate(){
		echo $this->Property_mdl->priorityUpdate();
	}
	
	public function moreInfoEntry(){
		echo $this->Property_mdl->moreInfoEntry();
	}
	
	public function amenitiesEntry(){
		echo $this->Property_mdl->amenitiesEntry();
	}
	
	public function manageReviewEntry(){
		echo $this->Property_mdl->manageReviewEntry();
	}
	
	public function datesBookingEntry(){
		echo $this->Property_mdl->datesBookingEntry();
	}
	
	public function manageImages(){
		if(isset($_GET['propertyId']) && $_GET['propertyId']!='' && isset($_GET['status']) && $_GET['status']!=''){
			echo $this->Property_mdl->manageImages($_GET['status'],$_GET['id'],$_GET['propertyId'],$_GET['oImg']);
		}
	}
	
	public function set_order_images(){
		$this->Property_mdl->set_order_images();
	}
	
	public function proImageDelete(){
		if(isset($_GET['imgId']) && $_GET['imgId']!=''){
			echo $this->Property_mdl->proImageDelete($_GET['imgId']);
		}
		redirect(base_url().$this->config->item('admin_directory_name').'properties/manage/'.$_GET['epId'].'?tab_id=4');
	}
	
	public function ajaxReviewDetails(){
		$this->data['reviewDetails'] = $this->Property_mdl->propertyReviewsDetailsArr($_GET['reviewId']);
		$this->load->view('Backend/properties/content/reviewFrm',$this->data);
	}
	
	public function ajaxCheckBookedDate(){
		$propertyId = $_GET['pId'];
		$reg_date = strtotime($_GET['chkDate']);
		$this->db->where('propertyId', $propertyId);
		$this->db->where('reg_date', $reg_date);
		$query = $this->db->get('reserve_date');
		echo $num = $query->num_rows();		
	}
	
	public function updateCalender(){
		$this->Property_mdl->updateCalender();
	}
	
	public function reviewDelete(){
		if(isset($_GET['reviewId']) && $_GET['reviewId']!=''){
			echo $this->Property_mdl->reviewDelete($_GET['reviewId']);
		}
		if(isset($_GET['reviewFor']) && $_GET['reviewFor']!='' && $_GET['reviewFor']==1){
			redirect(base_url().$this->config->item('admin_directory_name').'properties/manage/'.$_GET['epId'].'?tab_id=6');
		}else{
			redirect(base_url().$this->config->item('admin_directory_name').'reviews');
		}
	}
	
	public function delete(){
		if(isset($_GET['encryptedPropertyId']) && $_GET['encryptedPropertyId']!=''){
			echo $this->Property_mdl->deleteProperty($_GET['encryptedPropertyId']);
		}
		redirect(base_url().$this->config->item('admin_directory_name').'properties/listing/'.$_GET['slug']);
	}
	
	public function update_account_status(){
		if(isset($_GET['propertyId']) && $_GET['propertyId']!=''){
			 $propertyId=$_GET['propertyId'];
			 $column_name=$_GET['column_name'];
			 $status=$_GET['status'];
			 echo $this->Property_mdl->update_account_status($propertyId,$column_name,$status);
		}
	}
	
	public function add_member_entry(){
		echo $this->Signup_mdl->add_member_entry();
	}
	
	public function edit_member_entry(){
		echo $this->Signup_mdl->edit_member_entry();
	}
	
	public function ajax_edit_member(){
		if(isset($_GET['organizationId']) && $_GET['organizationId']!='' && isset($_GET['memberId']) && $_GET['memberId']!=''){
 			$this->data['orgainzation_details'] = $this->Signup_mdl->orgainzation_details($_GET['organizationId']);
			$this->data['member_details'] = $this->Signup_mdl->userlogin_details($_GET['memberId']);
			$this->load->view('Backend/users/popFields',$this->data);			
		}
	}
	
	public function ajax_add_member(){
		if(isset($_GET['organizationId']) && $_GET['organizationId']!=''){
 			$this->data['orgainzation_details'] = $this->Signup_mdl->orgainzation_details($_GET['organizationId']);
			$this->load->view('Backend/users/popFields',$this->data);			
		}
	}
	
	public function importIcalCalenderEntry(){
	
		$propertyId = $_POST['calImportPropertyId'];
 		include('iCalEasyReader.php');
		
		if(strpos($_POST['icalFeedUrlOne'], ".ics") !== false || strpos($_POST['icalFeedUrlOne'], ".ICS") !== false){
			$filePath = $_POST['icalFeedUrlOne'];
 		}else{
			$filePath = $_POST['icalFeedUrlOne'].'.ics';
		}
		$this->importIcalUrlEntry($propertyId,$filePath);
 		
		if(isset($_POST['icalFeedUrlTwo']) && $_POST['icalFeedUrlTwo']!=''){
			sleep(1);
			if(strpos($_POST['icalFeedUrlTwo'], ".ics") !== false || strpos($_POST['icalFeedUrlTwo'], ".ICS") !== false){
				$filePathTwo = $_POST['icalFeedUrlTwo'];
			}else{
				$filePathTwo = $_POST['icalFeedUrlTwo'].'.ics';
			}
			$this->importIcalUrlEntry($propertyId,$filePathTwo);
		}
		
		if(isset($_POST['icalFeedUrlThree']) && $_POST['icalFeedUrlThree']!=''){
			sleep(1);
			if(strpos($_POST['icalFeedUrlThree'], ".ics") !== false || strpos($_POST['icalFeedUrlThree'], ".ICS") !== false){
				$filePathThree = $_POST['icalFeedUrlThree'];
			}else{
				$filePathThree = $_POST['icalFeedUrlThree'].'.ics';
			}
			$this->importIcalUrlEntry($propertyId,$filePathThree);
		}
		echo 'success';
	}
	
	public function importIcalUrlEntry($propertyId,$filePath){
    
 		$obj = new ics();
		$icsEvents = $obj->getIcsEventsAsArray($filePath);
		//echo '<pre>'; print_r($icsEvents);die;
		$curDate = strtotime(date('Y-m-d')); 
 		if(isset($icsEvents) && $icsEvents!=''){
			if(count($icsEvents)>0){
				foreach($icsEvents as $ical){
 					 
 					if(isset($ical['BEGIN']) && $ical['BEGIN']!='' && trim($ical['BEGIN'])=='VEVENT' && isset($ical['DTSTART']) && $ical['DTSTART']!='' && isset($ical['DTEND']) && $ical['DTEND']!=''){
						
						$dtStart = new DateTime($ical['DTSTART']);
						$startDate = $dtStart->format('Y-m-d');
						$dtEnd = new DateTime($ical['DTEND']);
						$endDate = $dtEnd->format('Y-m-d');
						
						$diffDates = getDatesFromRangeCh($startDate, $endDate);			
						foreach($diffDates as $date){
							$checkin_date = strtotime($date);							
							$checkout_date = $checkin_date+86400;
							
								$this->db->where('propertyId', $propertyId);
								$this->db->where('checkin_date', $checkin_date);
								$this->db->where('checkout_date', $checkout_date);
								$query = $this->db->get('reserve_date');
								$num = $query->num_rows();			
								if($num==0){
									$this->db->insert('reserve_date', array('propertyId'=>$propertyId, 'reg_date'=>$checkin_date, 'checkin_date'=>$checkin_date, 'checkout_date'=>$checkout_date, 'filePath'=>$filePath, 'add_date'=>$curDate));
								}
								//echo '<hr>';
						}
						//die;
						//echo '<hr>';
					}
				}
			}
			$this->session->set_flashdata('success', 'Save & update successfully!');		
			 
		}
				
	
	}
 	
	public function importIcalEntry(){
	
		if(isset($_FILES['uploadIcal']['name']) && $_FILES['uploadIcal']['name']!=''){
			$propertyId = $_POST['calImportPropertyId'];	
			$fileNameArr = explode(".", $_FILES['uploadIcal']['name']);
			$fileExt = end($fileNameArr);
			$fileName = time().".".$fileExt;
			$uploadPath = './icsFiles/';
			$config['file_name'] = $fileName;
			$config['upload_path'] = $uploadPath;
			$config['allowed_types'] = 'ics';
			$this->load->library('upload');
			$this->upload->initialize($config);
			$this->upload->do_upload('uploadIcal');				
			$errors = $this->upload->display_errors('<span>', '</span>');
			if(isset($errors) && $errors!=''){
				 echo $errors;
			}else{ 	
				sleep(1);
				$filePath = $uploadPath.$fileName;
				if(file_exists($filePath)){
								
								include('iCalEasyReader.php');
								$obj = new ics();
								$icsEvents = $obj->getIcsEventsAsArray($filePath);
								echo '<pre>'; print_r($icsEvents);die;
								
								if(isset($icsEvents) && $icsEvents!=''){/*
									if(count($icsEvents)>0){
										foreach($icsEvents as $ical){
											if(isset($ical['DTSTART']) && $ical['DTSTART']!='' && isset($ical['DTEND']) && $ical['DTEND']!=''){
												 
												$dtStart = new DateTime($ical['DTSTART']);
												$startDate = $dtStart->format('Y-m-d');
												$dtEnd = new DateTime($ical['DTEND']);
												$endDate = $dtEnd->format('Y-m-d');
												
												$diffDates = getDatesFromRangeCh($startDate, $endDate);			
												foreach($diffDates as $date){
													$checkin_date = strtotime($date);							
													$checkout_date = $checkin_date+86400;
													
														$this->db->where('propertyId', $propertyId);
														$this->db->where('checkin_date', $checkin_date);
														$this->db->where('checkout_date', $checkout_date);
														$query = $this->db->get('reserve_date');
														$num = $query->num_rows();			
														if($num==0){
															//$this->db->insert('reserve_date', array('propertyId'=>$propertyId, 'reg_date'=>$checkin_date, 'checkin_date'=>$checkin_date, 'checkout_date'=>$checkout_date, 'add_date'=>time()));
														}
														//echo '<hr>';
												}
												//die;
												//echo '<hr>';
											}
										}
									}
									$this->session->set_flashdata('success', 'Save & update successfully!');		
									echo 'success';
								*/}else{
									echo 'No dates found.';
								}
				}else{
					echo 'Uploaded .ics file not found.';
				}			
			}

		}else{
			echo 'Please upload .ics file first.';
		}
	}
	
    /*public function edit(){
        $last = $this->uri->total_segments();
		$encryptId = $this->uri->segment($last);
 		$this->data['orgainzation_details']=$this->Signup_mdl->orgainzation_details_by_encryptId($encryptId);
		$organizationId = $this->data['orgainzation_details']->organizationId;
		$this->data['orgainzation_members_data']=$this->Signup_mdl->orgainzation_members_data($organizationId);
        $this->data['page_title']='Users';
        $this->load->view('Backend/includes/header',$this->data);
        $this->load->view('Backend/users/edit',$this->data);
        $this->load->view('Backend/includes/footer');
    }
    

    public function update(){
        echo $this->users_mdl->update_user_details();
    }*/

}