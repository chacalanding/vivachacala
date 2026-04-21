<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Form_entry_mdl extends CI_Model { 
	
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
	
	public function inquiriesDataArr($propertyType){		
		$this->db->select('inq.*, p.name as proName');
		$this->db->from('inquiries as inq');
		$this->db->where('inq.inquiryFor', 0);
		$this->db->where('inq.isDeleted', 0);
		$this->db->where('inq.propertyType', $propertyType);
		$this->db->order_by('inq.inquiryId','desc'); 
		$this->db->join('properties as p', 'inq.propertyId = p.propertyId', 'LEFT');
		$query = $this->db->get();
		return $query->result_array();		
	}
	
	public function contactInquiriesDataArr(){
		$this->db->where('inquiryFor', 1);
		$this->db->where('isDeleted', 0);
		$this->db->order_by('inquiryId','desc'); 
		$query = $this->db->get('inquiries');
		return $query->result_array();		
	}
	
	public function newsletterDataArr(){
		$this->db->where('isDeleted', 0);
		$this->db->order_by('newsId','desc'); 
		$query = $this->db->get('newsletters');
		return $query->result_array();		
	}
	
	public function deleteNewsLetter($newsId){
		$this->db->where('newsId',$newsId); 
		$this->db->update('newsletters', array("isDeleted"=>1));
		$this->session->set_flashdata('success', 'Deleted successfully!');
	}
	
	public function deleteInquiry($inquiryId){
		$this->db->where('inquiryId',$inquiryId); 
		$this->db->update('inquiries', array("isDeleted"=>1));
		$this->session->set_flashdata('success', 'Deleted successfully!');
	}
	
	public function bookingRequestEntry(){
		$enquiryDate = strtotime(date('Y-m-d'));
		$enquiryMonth = date('m');
		$enquiryYear = date('Y');
		$enquiryTime = time();
		$ipAddress = $_SERVER['REMOTE_ADDR'];
		
		$proceedSts = 0;
		$propertyId = $this->input->post('h_propertyId');
		$propertyType = $this->input->post('h_propertyType');
		$propertyName = $this->input->post('h_propertyName');
		$checkInDate = 0;
		$checkOutDate = 0;
		$adults = 0;
		$children = 0;
		if($propertyType==0){
			if(isset($_POST['rbfArrive']) && $_POST['rbfArrive']!=''){
				$checkInDate = strtotime($this->input->post('rbfArrive'));
			}else{
				$checkInDate = 0;
			}
			if(isset($_POST['rbfDepart']) && $_POST['rbfDepart']!=''){
				$checkOutDate = strtotime($this->input->post('rbfDepart'));
			}else{
				$checkOutDate = 0;
			}
			$adults = $this->input->post('adults');
			$children = $this->input->post('children');			
			$chkQry = $this->db->query("select * from vc_reserve_date where (propertyId ='".$propertyId."' and checkin_date='".$checkInDate."' ) or (propertyId ='".$propertyId."' and checkout_date='".$checkOutDate."') or (propertyId ='".$propertyId."' and `checkin_date` > '".$checkInDate."'  and `checkin_date` < '".$checkOutDate."') or (propertyId ='".$propertyId."' and `checkout_date` > '".$checkInDate."'  and `checkout_date` <  '".$checkOutDate."') or (propertyId ='".$propertyId."' and `checkout_date` > '".$checkInDate."'  and `checkout_date` <  '".$checkOutDate."') or (propertyId ='".$propertyId."' and `checkin_date` > '".$checkInDate."'  and `checkin_date` < '".$checkOutDate."') or (propertyId ='".$propertyId."' and checkout_date>'".$checkInDate."' and checkin_date<'".$checkOutDate."')");
			$proceedSts = $chkQry->num_rows();
		}
		
		if($proceedSts==0){
			$name = trim($this->input->post('rbfName'));
			$email = strtolower(trim($this->input->post('rbfEMail')));
			$phoneNo = $this->input->post('rbfPhone');
			$txtMsg = $this->input->post('txtMessage');
 			$this->db->insert('inquiries', array('propertyId'=>$propertyId, 'propertyType'=>$propertyType, 'name'=>$name, 'email'=>$email, 'phoneNo'=>$phoneNo, 'message'=>$txtMsg, 'checkInDate'=>$checkInDate, 'checkOutDate'=>$checkOutDate, 'adults'=>$adults, 'children'=>$children, 'enquiryDate'=>$enquiryDate, 'enquiryMonth'=>$enquiryMonth, 'enquiryYear'=>$enquiryYear, 'enquiryTime'=>$enquiryTime, 'ipAddress'=>$ipAddress));
			
			
			
			$message='Hello';
			if(isset($propertyType) && $propertyType!='' && $propertyType==0){
				$message.='<p>Here is the new inquiry for Luxury Rental and details:</p>';
				//$subject = $propertyName.' request from '.$name;
			}else if(isset($propertyType) && $propertyType!='' && $propertyType==1){
				$message.='<p>Here is the new inquiry for Business and details:</p>';
				//$subject='New Inquiry for Business';
			}else{
				$message.='<p>Here is the new inquiry for Real Estate and details:</p>';
				//$subject='New Inquiry for Real Estate';
			}
			
			$subject = $propertyName.' request from '.$name;
			$message.='<p><label style="font-weight:600;">Name - </label>'.$name.'</p>';
			$message.='<p><label style="font-weight:600;">Email - </label>'.$email.'</p>';
			if(isset($phoneNo) && $phoneNo!=''){
				$message.='<p><label style="font-weight:600;">Phone No - </label>'.$phoneNo.'</p>';
			}
			
			if($propertyType==0){
				$message.='<p><label style="font-weight:600;">Arrive - </label>'.date('d M Y',$checkInDate).'</p>';
				$message.='<p><label style="font-weight:600;">Depart - </label>'.date('d M Y',$checkOutDate).'</p>';
				$message.='<p><label style="font-weight:600;">Adults - </label>'.$adults.'</p>';
				$message.='<p><label style="font-weight:600;">Children - </label>'.$children.'</p>';				 
			}
			
			if(isset($txtMsg) && $txtMsg!=''){
				$message.='<p><label style="font-weight:600;">Message - </label>'.$txtMsg.'</p>';
			}
			$message.='<p>&nbsp;</p>';	
			$message.='<p>Thanks<br>Viva Chacala</p>';
			
			$query_configuration = $this->db->get('configuration');
			$configuration_details = $query_configuration->row();
			$send_email_to = trim($configuration_details->sendNotificationOn);
			
			send_mail($send_email_to,$message,$name,$email,$subject, $cc=1);
			
			
			return 'success||Reservation request successfully sent - A member of of Viva Chacala team will get back to you right way.';	
		
		}else{
			return 'error||This villa has been booked, please select another dates!';
		}
	}
	
	public function contactEntry(){	
 		$name = trim($this->input->post('txtName'));
		$email = strtolower(trim($this->input->post('txtEmail')));
		$phoneNo = $this->input->post('txtPhone');
		$txtMsg = $this->input->post('commentMsg');
 		$enquiryDate = strtotime(date('Y-m-d'));
		$enquiryMonth = date('m');
		$enquiryYear = date('Y');
		$enquiryTime = time();
		$ipAddress = $_SERVER['REMOTE_ADDR'];	 
 		$this->db->insert('inquiries', array('inquiryFor'=>1, 'name'=>$name, 'email'=>$email, 'phoneNo'=>$phoneNo, 'message'=>$txtMsg, 'enquiryDate'=>$enquiryDate, 'enquiryMonth'=>$enquiryMonth, 'enquiryYear'=>$enquiryYear, 'enquiryTime'=>$enquiryTime, 'ipAddress'=>$ipAddress));		
		
		$message='Hello';
		$message.='<p><label style="font-weight:600;">Name - </label>'.$name.'</p>';
		$message.='<p><label style="font-weight:600;">Email - </label>'.$email.'</p>';
		if(isset($phoneNo) && $phoneNo!=''){
			$message.='<p><label style="font-weight:600;">Phone No - </label>'.$phoneNo.'</p>';
		}
		if(isset($txtMsg) && $txtMsg!=''){
			$message.='<p><label style="font-weight:600;">Message - </label>'.$txtMsg.'</p>';
		}
		$message.='<p>&nbsp;</p>';	
		$message.='<p>Thanks<br>Viva Chacala</p>';
 		$subject='Contact Inquiry';
			
		$query_configuration = $this->db->get('configuration');
		$configuration_details = $query_configuration->row();
		$send_email_to = trim($configuration_details->sendNotificationOn);
		
		send_mail($send_email_to,$message,$name,'',$subject, $cc=1);
		
		return 'success||';	 
	}
	
	public function newsletterEntry(){		
		$email = strtolower(trim($this->input->post('nlEmailAddress')));
		
		$query = $this->db->get_where('newsletters', array('email'=>$email, 'isDeleted'=>0));
		$num_rows = $query->num_rows();
		
		if($num_rows==0){
			$enquiryDate = strtotime(date('Y-m-d'));
			$enquiryMonth = date('m');
			$enquiryYear = date('Y');
			$enquiryTime = time();
			$ipAddress = $_SERVER['REMOTE_ADDR'];	 
			$this->db->insert('newsletters', array('email'=>$email, 'enquiryDate'=>$enquiryDate, 'enquiryMonth'=>$enquiryMonth, 'enquiryYear'=>$enquiryYear, 'enquiryTime'=>$enquiryTime, 'ipAddress'=>$ipAddress));	
		}	
		return 'success||';	
	}
	
}