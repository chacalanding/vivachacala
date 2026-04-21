<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Ics_manage extends CI_Controller {

	function __construct(){ 
		parent::__construct();
		$this->load->helper('adminlogin');
        $this->load->model('Backend/users_mdl');
		checkIfLoggedIn($this->session->userdata('userid'));
		$this->data['session_details'] = $this->Login_mdl->adminlogin_details($this->session->userdata('userid'));
		$this->data['admin_type']=$this->data['session_details']->admin_type;
 		$this->data['success_msg']=$this->session->flashdata('success');
		$this->data['error_msg']=$this->session->flashdata('error');
		$this->data['title']='Inquiries | Administrator Panel';
		$this->data['active_class']='inquiries_menu';
	}
	
	public function import(){
		//https://www.apptha.com/blog/import-google-calendar-events-in-php/#:~:text=%2F*%20Replace%20the%20URL%20%2F%20file,a%20array%20variable%20called%20%24icsEvents.
		$propertyId = 0;
		include ( 'iCalEasyReader.php' );
		$file = "icsFiles/Villa_Alta_Mira_Alta_Mira.ics";
		$obj = new ics();
		$icsEvents = $obj->getIcsEventsAsArray( $file );
		if(isset($icsEvents) && $icsEvents!=''){
			if(count($icsEvents)>0){
				foreach($icsEvents as $ical){
					if(isset($ical['DTSTART']) && $ical['DTSTART']!='' && isset($ical['DTEND']) && $ical['DTEND']!=''){
						 
						$dtStart = new DateTime($ical['DTSTART']);
						$startDate = $dtStart->format('Y-m-d');
 						$dtEnd = new DateTime($ical['DTEND']);
						$endDate = $dtEnd->format('Y-m-d');
						
						$diffDates = getDatesFromRangeCh($startDate, $endDate);			
						foreach($diffDates as $date){
							echo $checkin_date = strtotime($date);							
							$checkout_date = $checkin_date+86400;
							
								/*$this->db->where('propertyId', $propertyId);
								$this->db->where('checkin_date', $checkin_date);
								$this->db->where('checkout_date', $checkout_date);
								$query = $this->db->get('reserve_date');
								$num = $query->num_rows();			
								if($num==0){
									$this->db->insert('reserve_date', array('propertyId'=>$propertyId, 'reg_date'=>$checkin_date, 'checkin_date'=>$checkin_date, 'checkout_date'=>$checkout_date, 'add_date'=>time()));
								}*/
								echo '<hr>';
						}
						die;
						echo '<hr>';
					}
				}
			}
		}

	}
	
}