<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Property_mdl extends CI_Model {
	
	public function __construct() {
		parent::__construct();
		$this->load->library('email');
		$config['protocol'] = 'sendmail';
        $config['mailpath'] = '/usr/sbin/sendmail';
        $config['charset'] = 'iso-8859-1';
        $config['wordwrap'] = TRUE;
        $config['mailtype'] = 'html';
        $this->email->initialize($config);
	}
	
	public function priorityUpdate(){
		if(isset($_POST['proIds']) && $_POST['proIds']!=''){
			if(count($_POST['proIds'])>0){
				for($p=0;$p<count($_POST['proIds']);$p++){
					$propertyId = $_POST['proIds'][$p];
					$assPri = $_POST['proPri'.$propertyId];
					
					$this->db->where('propertyId', $propertyId);
					$this->db->update('properties',array('priority'=>$assPri)); 
				}
			}
			$this->session->set_flashdata('success', 'Priority Updated!');
		}
		return 'success||';
	}
	
	public function set_order_images(){	
		$list_order = $_POST['list_order']; 
		// convert the string list to an array
		$list = explode(',' , $list_order);
		$i = 1 ;
		foreach($list as $id){
			$this->db->where('imgId', $id);
			$this->db->update('property_images',array('priority'=>$i));
			
		$i++;}
		$this->session->set_flashdata('success', 'Order Updated!');
	}
	
	public function getMoreImages($propertyId,$limit){
		$this->db->order_by('priority','asc'); 
		if(isset($limit) && $limit!='' && $limit>0){
			$this->db->limit($limit); 
		}
		$query = $this->db->get_where('property_images', array('propertyId'=>$propertyId));
		return $query->result_array();
	}
	
	public function manageImages($status, $imgId, $propertyId, $oldImageName){
	
		if(isset($_FILES['bgimage']['name']) && $_FILES['bgimage']['tmp_name']!=''){
		 
			$img_data_check = getimagesize($_FILES["bgimage"]['tmp_name']);
			$img_check_width = $img_data_check[0];
			$img_check_height = $img_data_check[1];
			if(isset($img_check_width) && $img_check_width!='' && isset($img_check_height) && $img_check_height!=''){ //$img_check_width==1170 &&  && $img_check_height==350
			
 				$path = './assets/upload/proImage/';
				$fil_exp = explode(".", $_FILES['bgimage']['name']);
				$fileExt = strtolower(end($fil_exp));
				$fileName = time().".".$fileExt;
 				
				$imgresize = common_ImageResize('1000', '500', 'bgimage', $path, $fileName, $fileExt);	
				if(isset($imgresize) && $imgresize==0){
					 
					if($status=='default'){		
						$this->db->where('propertyId',$propertyId);
						$this->db->update('properties', array("proImage"=>$fileName));	
 						if(isset($oldImageName) && $oldImageName!=''){
							unlink($path.$oldImageName);
							unlink($path.'small/'.$oldImageName);	
						}
					}else{
						
						if(isset($imgId) && $imgId!='' && $imgId>0){
							$this->db->where('imgId',$imgId);
							$this->db->update('property_images', array("imageName"=>$fileName));	
							if(isset($oldImageName) && $oldImageName!=''){
								unlink($path.$oldImageName);
								unlink($path.'small/'.$oldImageName);	
							}
						}else{
							$this->db->insert('property_images', array("propertyId"=>$propertyId, "imageName"=>$fileName));
						}
					} 	
					return 'success';
				}else{
					return 'no';
				}
			
			}else{return 'no_size';} 
		}else{
			return 'no';
		}
		
		$this->session->set_flashdata('success', 'propertyId: '.$propertyId);
		return 'success';
	}
	
	public function proImageDelete($imgId){
		$query = $this->db->get_where('property_images', array('imgId'=>$imgId));
		$cnt = $query->num_rows(); 		
 		if($cnt>0){
			$row = $query->row();
			if(isset($row->imageName) && $row->imageName!=''){
				$oldImageName = $row->imageName;
				$path = './assets/upload/proImage/';
				if(isset($oldImageName) && $oldImageName!=''){
					unlink($path.$oldImageName);
					unlink($path.'small/'.$oldImageName);	
				}
				$this->db->where('imgId',$imgId); 
				$this->db->delete('property_images');
				$this->session->set_flashdata('success', 'Image has been deleted successfully.');			
			}
		}
	}
	
	public function villaPropertiesDataArr($propertyType){ 
		
		$propertyIds = '';
		if(isset($_GET['checkIn']) && $_GET['checkIn']!='' && isset($_GET['checkOut']) && $_GET['checkOut']!=''){
		
			$checkInDate = strtotime($_GET['checkIn']);
			$checkOutDate = strtotime($_GET['checkOut']);
			
			$resQry = $this->db->query("select * from vc_reserve_date where (checkin_date='".$checkInDate."' ) or (checkout_date='".$checkOutDate."') or (`checkin_date` > '".$checkInDate."' and `checkin_date` < '".$checkOutDate."') or (`checkout_date` > '".$checkInDate."' and `checkout_date` < '".$checkOutDate."') or (`checkout_date` > '".$checkInDate."' and `checkout_date` < '".$checkOutDate."') or (`checkin_date` > '".$checkInDate."' and `checkin_date` < '".$checkOutDate."') or (checkout_date>'".$checkInDate."' and checkin_date<  '".$checkOutDate."') GROUP BY propertyId");
			$bookedCnt = $resQry->num_rows();
			if($bookedCnt>0){
				$propertyIdsArr = array();
				$bookedDateArr = $resQry->result_array();
				foreach($bookedDateArr as $bk){
					$propertyIdsArr[] = $bk['propertyId'];
				}
				$propertyIds = implode(',',$propertyIdsArr);
			}		
		}
		
		if(isset($propertyIds) && $propertyIds!=''){
			$this->db->where('propertyId not in ('.$propertyIds.')'); 
		}
		
		if(isset($_GET['guest']) && $_GET['guest']!=''){
			$this->db->where('guests >= ',$_GET['guest']); 
		}
		
		if(isset($_GET['cId']) && $_GET['cId']!=''){
			$this->db->where('FIND_IN_SET('.$_GET['cId'].', categoryId)'); 
		}
		if(isset($_GET['sps']) && $_GET['sps']!=''){
			$this->db->where('isSpecial',0); 
		}		
		
		$this->db->where('propertyType',$propertyType); 
		$this->db->where('isActive',0); 
		$this->db->where('isDeleted',0); 
		//$this->db->order_by('propertyId','desc'); 
		$this->db->order_by('priority','asc'); 
		$query = $this->db->get('properties');
		return $query->result_array();
	}
	
	public function homeCategoriesWiseProperties(){ 
		$this->db->order_by('priority','asc'); 
		$query = $this->db->get_where('properties', array('propertyType'=>0, 'isCategory'=>0, 'isDeleted'=>0, 'isActive'=>0));
		return $query->result_array();
	}
	
	/*public function homeCategoriesWiseProperties($catId){ 
		$this->db->order_by('propertyId','desc'); 		
		$this->db->where('propertyType',0); 
		$this->db->where('isActive',0); 
		$this->db->where('isDeleted',0); 
		$this->db->where('FIND_IN_SET('.$catId.', categoryId)'); 
		$query = $this->db->get('properties');
		return $query->row_array();
	}
	*/
	
	public function homeChacalaReviewsData(){  
		$this->db->order_by('reviewId','desc');
		$this->db->limit(5); 
		$query = $this->db->get_where('reviews', array('reviewFor'=>0, 'isActive'=>0, 'isDeleted'=>0));
		return $query->result_array();
	}
	
	public function chacalaReviewsData(){  
		$this->db->order_by('reviewId','desc');
		$query = $this->db->get_where('reviews', array('reviewFor'=>0, 'isActive'=>0, 'isDeleted'=>0));
		return $query->result_array();
	}
	
	public function homeSpecialsProperties(){ 
		$this->db->order_by('priority','asc'); 
		$query = $this->db->get_where('properties', array('propertyType'=>0, 'isSpecial'=>0, 'isDeleted'=>0, 'isActive'=>0));
		return $query->result_array();
	}
	
	public function propertyDataArr($propertyType){
		$this->db->order_by('priority','asc'); 
		$query = $this->db->get_where('properties', array('propertyType'=>$propertyType, 'isDeleted'=>0));
		return $query->result_array();
	}
	
	public function propertyReviewsArr($propertyId){
		$this->db->order_by('reviewId','desc'); 
		$query = $this->db->get_where('reviews', array('reviewFor'=>1, 'propertyId'=>$propertyId, 'isDeleted'=>0));
		return $query->result_array();
	}
	
	public function propertyImagesArr($propertyId){
		$this->db->order_by('priority','asc'); 
		$query = $this->db->get_where('property_images', array('propertyId'=>$propertyId));
		return $query->result_array();
	}
	
	
	public function activePropertyReviewsDataArr($propertyId){
		$this->db->order_by('reviewId','desc'); 
		$query = $this->db->get_where('reviews', array('reviewFor'=>1, 'propertyId'=>$propertyId, 'isActive'=>0, 'isDeleted'=>0));
		return $query->result_array();
	}
	
	public function chacalaReviewsArr(){
		$this->db->order_by('reviewId','desc'); 
		$query = $this->db->get_where('reviews', array('reviewFor'=>0, 'isDeleted'=>0));
		return $query->result_array();
	}
	
	public function amenitiesMasterDataArr(){
		$this->db->order_by('name','asc'); 
		$query = $this->db->get_where('amenities', array('is_delete'=>0));
		return $query->result_array();
	}
	
	public function propertyDetailsArrByEncryptId($encryptedPropertyId){
		$query = $this->db->get_where('properties', array('encryptedPropertyId'=>$encryptedPropertyId));
		return $query->row_array();
	}
	
	public function propertyDetailsArrBySlug($slug){
		$query = $this->db->get_where('properties', array('slug'=>$slug));
		return $query->row_array();
	}
	
	public function propertyReservations($propertyId){
		$this->db->order_by('checkin_date','asc'); 
		$query = $this->db->get_where('reserve_date', array('propertyId'=>$propertyId));
		return $query->result_array();
	}
	
	public function propertyReviewsDetailsArr($reviewId){
		$query = $this->db->get_where('reviews', array('reviewId'=>$reviewId));
		return $query->row_array();
	}
	
	public function moreInfoEntry(){
		$propertyId = $this->input->post('morePropertyId');
		$keyFeatures = $this->input->post('keyFeatures');
		$checkIn = $this->input->post('checkIn');
		$checkOut = $this->input->post('checkOut');
		$addInfo = $this->input->post('addInfo');
		$latitude = $this->input->post('latitude');
		$longitude = $this->input->post('longitude');
		$locIframeSrc = $this->input->post('locIframeSrc');
		$metaTitle = $this->input->post('metaTitle');
		$metaDesc = $this->input->post('metaDesc');
		$metaKeyword = $this->input->post('metaKeyword');
		$curTime = time();
		$this->db->where('propertyId',$propertyId); 
		$this->db->update('properties', array("keyFeatures"=>$keyFeatures, "checkIn"=>$checkIn, "checkOut"=>$checkOut, "addInfo"=>$addInfo, "latitude"=>$latitude, "longitude"=>$longitude, "locIframeSrc"=>$locIframeSrc, "metaTitle"=>$metaTitle, "metaDesc"=>$metaDesc, "metaKeyword"=>$metaKeyword, 'createdOn'=>$curTime));
		$this->session->set_flashdata('success', 'Saved successfully!');
		return 'success||';
	}
	
	public function amenitiesEntry(){
		if(isset($_POST['amenityIds']) && $_POST['amenityIds']!=''){
			if(count($_POST['amenityIds'])>0){
				$propertyId = $this->input->post('amenitiesPropertyId');
				$amenities = implode(',',$_POST['amenityIds']);
				$curTime = time();
				$this->db->where('propertyId',$propertyId); 
				$this->db->update('properties', array("amenities"=>$amenities, 'createdOn'=>$curTime));
				$this->session->set_flashdata('success', 'Saved successfully!');
			}
		}
		return 'success||';
	}
	
	public function update_account_status($propertyId,$column_name,$status){	
		$data = array("$column_name"=>$status);
		$this->db->where('propertyId', $propertyId);
		$this->db->update('properties',$data);		
		return 'success';
	}
	
	public function manageReviewEntry(){
		$propertyId = $this->input->post('reviewPropertyId');
		$encryptedPropertyId = $this->input->post('reviewEncryptedPropertyId');
		$reviewFor = $this->input->post('reviewFor');
		$reviewId = $this->input->post('reviewId');
 		$reviewBy = $this->input->post('reviewBy');
		$message = $this->input->post('reviewMsg');
		$rating = $this->input->post('reviewRating');
		$location = $this->input->post('location');
		$curTime = time();
 		if(isset($reviewId) && $reviewId!='' && $reviewId>0){
			$this->db->where('reviewId',$reviewId); 
			$this->db->update('reviews', array('reviewBy'=>$reviewBy, 'message'=>$message, 'rating'=>$rating, 'location'=>$location, 'lastUpdatedOn'=>$curTime));
		}else{		
			$this->db->insert('reviews', array('reviewFor'=>$reviewFor, 'propertyId'=>$propertyId, 'reviewBy'=>$reviewBy, 'message'=>$message, 'rating'=>$rating, 'location'=>$location, 'createdOn'=>$curTime, 'lastUpdatedOn'=>$curTime));
		}
		
		$this->updateAvgRatingSts($propertyId);
		
		$this->session->set_flashdata('success', 'Saved successfully!');
		if($reviewFor==1){		
			return 'success||'.base_url().$this->config->item('admin_directory_name').'properties/manage/'.$encryptedPropertyId.'?tab_id=6';	
		}else{
			return 'success||'.base_url().$this->config->item('admin_directory_name').'reviews';	
		}
	}
	
	public function updateAvgRatingSts($propertyId){		
		$query = $this->db->get_where('reviews', array('propertyId'=>$propertyId, 'isDeleted'=>0));
		$totalReviews = $query->num_rows(); 		
		$this->db->select_sum('rating');
		$this->db->where('propertyId', $propertyId);
		$this->db->where('isDeleted', 0);
		$qry = $this->db->get('reviews');
  		$ratingDetails = $qry->row();
		if(isset($ratingDetails->rating) && $ratingDetails->rating!='' && $ratingDetails->rating>0){
			$ratingSum = $ratingDetails->rating;
 			$avgRating = $ratingSum/$totalReviews;
			$this->db->where('propertyId',$propertyId); 
			$this->db->update('properties', array("avgRating"=>$avgRating, "reviewsCnt"=>$totalReviews));			
		}		
	}
	
	public function manageBasicEntry(){
	
		$propertyChkId = $this->input->post('propertyId');
		$propertyType = $this->input->post('propertyType');
		$name = $this->input->post('proName');
		$slug = create_slug_ch($name);
		$categoryId = '';	
		if(isset($_POST['categoryIds']) && $_POST['categoryIds']!=''){
			if(count($_POST['categoryIds'])>0){
				$categoryId = implode(',',$_POST['categoryIds']);
			}
		}	
			
		$proDesc = $this->input->post('proDesc');
		$curTime = time();
		
		if($propertyType==1){
			$businessOwner = $this->input->post('businessOwner');
			$businessOwnerEmail = $this->input->post('businessOwnerEmail');
			$proData = array('name'=>$name, 'slug'=>$slug, 'categoryId'=>$categoryId, 'businessOwner'=>$businessOwner, 'businessOwnerEmail'=>$businessOwnerEmail, 'proDesc'=>$proDesc, 'lastUpdatedOn'=>$curTime);
		}else{
			
			$guests = 0;
			$beds = 0;
			$lowSeason = 0;
			$holidayPrice = 0;
			$videoURL = '';
			$reAge = 0;
			$reView = '';
			$reFurnished = 0;
			$reParking = '';
			$reApproxLand = 0;
			$reApproxBuilding = 0;
			$isSold = 0;
			if($propertyType==0){
				$guests = $this->input->post('guests');
				$beds = $this->input->post('beds');
				$lowSeason = $this->input->post('lowSeason');
				$holidayPrice = $this->input->post('holidayPrice');
				$videoURL = $this->input->post('videoURL');
			}else{
				$isSold = $this->input->post('isSold');
				$reAge = $this->input->post('reAge');
				$reView = $this->input->post('reView');
				$reFurnished = $this->input->post('reFurnished');
				$reParking = $this->input->post('reParking');
				$reApproxLand = $this->input->post('reApproxLand');
				$reApproxBuilding = $this->input->post('reApproxBuilding');
			}
			
			$bedrooms = $this->input->post('bedrooms');
			$bathrooms = $this->input->post('bathrooms');
			$avgPrice = $this->input->post('avgPrice');
			$proData = array('name'=>$name, 'slug'=>$slug, 'categoryId'=>$categoryId, 'guests'=>$guests, 'beds'=>$beds, 'bedrooms'=>$bedrooms, 'bathrooms'=>$bathrooms, 'avgPrice'=>$avgPrice, 'lowSeason'=>$lowSeason, 'holidayPrice'=>$holidayPrice, 'videoURL'=>$videoURL, 'proDesc'=>$proDesc, 'isSold'=>$isSold, 'reAge'=>$reAge, 'reView'=>$reView, 'reFurnished'=>$reFurnished, 'reParking'=>$reParking, 'reApproxLand'=>$reApproxLand, 'reApproxBuilding'=>$reApproxBuilding, 'lastUpdatedOn'=>$curTime);
		}
		
		if(isset($propertyChkId) && $propertyChkId!='' && $propertyChkId>0){
			$encryptedPropertyId = $this->input->post('encryptedPropertyId');
			$this->db->where('propertyId',$propertyChkId); 
			$this->db->update('properties', $proData);
		}else{
 			$this->db->insert('properties', $proData);
			$propertyId = $this->db->insert_id();
			$encryptedPropertyId = md5($propertyId).$propertyId;
			$this->db->where('propertyId',$propertyId); 
			$this->db->update('properties', array("encryptedPropertyId"=>$encryptedPropertyId, 'propertyType'=>$propertyType, 'createdOn'=>$curTime));
		}
		$this->session->set_flashdata('success', 'Saved successfully!');		
		return 'success||'.base_url().$this->config->item('admin_directory_name').'properties/manage/'.$encryptedPropertyId;
	}
	
	public function deleteProperty($encryptedPropertyId){
		$curTime = time();
		$this->db->where('encryptedPropertyId',$encryptedPropertyId); 
		$this->db->update('properties', array("isDeleted"=>1, 'createdOn'=>$curTime));
		$this->session->set_flashdata('success', 'Deleted successfully!');
	}
	
	public function reviewDelete($reviewId){
		$curTime = time();
		$this->db->where('reviewId',$reviewId); 
		$this->db->update('reviews', array("isDeleted"=>1, 'lastUpdatedOn'=>$curTime));
		$this->session->set_flashdata('success', 'Deleted successfully!');
	}
	
	public function checkBookingStatus($checkin_date,$checkout_date,$unit_type){
		
		$this->db->where('unit_type', $unit_type);
		$query_units = $this->db->get('units');
		$unit_details = $query_units->row();
		$unit_id = $unit_details->id;
		
 		$checkin_date1 = strtotime($checkin_date);
		$checkout_date1 = strtotime($checkout_date);
		
		$query = $this->db->query("select * from vc_reserve_date where (unit_id ='$unit_id' and checkin_date='$checkin_date1' ) or (unit_id ='$unit_id' and checkout_date='$checkout_date1') or (unit_id ='$unit_id' and `checkin_date` > '$checkin_date1'  and `checkin_date` <    '$checkout_date1') or (unit_id ='$unit_id' and `checkout_date` > '$checkin_date1'  and `checkout_date` <  '$checkout_date1') or (unit_id ='$unit_id' and `checkout_date` > '$checkin_date1'  and `checkout_date` <  '$checkout_date1') or (unit_id ='$unit_id' and `checkin_date` > '$checkin_date1'  and `checkin_date` <    '$checkout_date1') or (unit_id ='$unit_id' and checkout_date>'$checkin_date1' and checkin_date<'$checkout_date1')");
		echo $count_reserve_date = $query->num_rows();
	
	}
	
	public function frontHighlightDate($propertyId){
		$current_date = strtotime(date('Y-m'));
		$this->db->where('checkin_date >= ', $current_date); 
		$this->db->where('propertyId', $propertyId); 
		$this->db->order_by('checkin_date', 'desc');
		$query = $this->db->get('reserve_date');
		return $query->result();		
	}
	
	public function highlight_date($propertyId){
		//$this->db->where('checkin_date >', '1543661927');
		$this->db->where('propertyId', $propertyId);
		$this->db->order_by('checkin_date', 'asc');
		$query = $this->db->get('reserve_date');
		return $query->result();		
	}
	
	public function updateCalender(){
	
		$propertyId = $_POST['hidden_propertyId'];
		$encryptedPropertyId = $_POST['hidden_encryptedPropertyId'];
		$hidden_selected_dates = explode(',',$_POST['hidden_selected_dates']);
			
		if(isset($_POST['booked_date']) && $_POST['booked_date']!=''){
			
			for($i=0;$i<count($hidden_selected_dates);$i++){
			
				//echo 'check in date = '.$hidden_selected_dates[$i].'---------check out date = ';
				
				$reg_date = strtotime($hidden_selected_dates[$i]);
				
				$checkin_date = strtotime($hidden_selected_dates[$i]);
				$checkout_date = $reg_date+86400;
				
				//echo date('Y-m-d',$check_out);
				//echo '<hr>';
				
				$this->db->where('propertyId', $propertyId);
				$this->db->where('checkin_date', $checkin_date);
				$this->db->where('checkout_date', $checkout_date);
				$query = $this->db->get('reserve_date');
				$num = $query->num_rows();
			
				if($num==0){
				
					$insert_data=array('propertyId'=>$propertyId, 'reg_date'=>$reg_date, 'checkin_date'=>$checkin_date, 'checkout_date'=>$checkout_date, 'add_date'=>time());
					$this->db->insert('reserve_date',$insert_data);
				}
			
			}
			 
			$this->session->set_flashdata('success', 'Dates are successfully booked!'); 
		
		}
		
		if(isset($_POST['removed_date']) && $_POST['removed_date']!=''){
		
			for($i=0;$i<count($hidden_selected_dates);$i++){
				$reg_date = strtotime($hidden_selected_dates[$i]);
				
				$this->db->where('propertyId', $propertyId);
				$this->db->where('reg_date', $reg_date);
				$query = $this->db->get('reserve_date');
				$num = $query->num_rows();
			
				if($num>0){
				
					$query = $this->db->delete('reserve_date', array('propertyId' => $propertyId, 'reg_date' => $reg_date));
				 
				}
			
			}
			
			$this->session->set_flashdata('success', 'Dates are successfully removed!'); 
		}
		
		redirect(base_url().$this->config->item('admin_directory_name').'properties/manage/'.$encryptedPropertyId.'?tab_id=5'); 
	}
	
	public function datesBookingEntry(){
		$propertyId = $_POST['calBkPropertyId'];
		
		$fromDate = strtotime($_POST['custFromDate']);
		$toDate = strtotime($_POST['cusToDate']);
		
		if($toDate>=$fromDate){
			$diffDates = getDatesFromRangeCh($_POST['custFromDate'], $_POST['cusToDate']);			
			foreach($diffDates as $date){
 				
				//echo $date.'-----'; 
				$checkin_date = strtotime($date);
				$checkout_date = $checkin_date+86400;
				
				$this->db->where('propertyId', $propertyId);
				$this->db->where('checkin_date', $checkin_date);
				$this->db->where('checkout_date', $checkout_date);
				$query = $this->db->get('reserve_date');
				$num = $query->num_rows();			
				if($num==0){
					//echo ' --- yes';				
					 
					$this->db->insert('reserve_date', array('propertyId'=>$propertyId, 'reg_date'=>$checkin_date, 'checkin_date'=>$checkin_date, 'checkout_date'=>$checkout_date, 'add_date'=>time()));
				}
				//echo '<br>';
				
			}
			return 'success||';
		}else{
			return 'error||Oops, From date always less then the Book To Date.';	
		}
		
	}
	
}