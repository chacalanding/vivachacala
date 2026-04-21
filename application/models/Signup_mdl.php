<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Signup_mdl extends CI_Model {
	
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
	
	public function change_password_entry(){	
		$hidden_old_password = $this->input->post('hidden_old_password');
		$old_password = $this->input->post('old_password');
		$password = $this->input->post('confirm_password');
		if(isset($old_password) && $old_password!='' && isset($password) && $password!='' && $old_password==$hidden_old_password){			
			$memberId = $this->input->post('h_memberId');		
			$this->db->where('memberId',$memberId); 
			$this->db->update('organizations_members', array('password' => md5($password),'password_v' => $password));
			return 'success||';
		}else{
			return 'error||sorry, please enter correct old password.';
		}
	}
	
	public function update_account_status($organizationId,$column_name,$status){
	
		$data = array("$column_name"=>$status);
		$this->db->where('organizationId', $organizationId);
		$this->db->update('organizations',$data);
		
		$this->db->where('organizationId', $organizationId);
		$this->db->update('organizations_members',$data);
		
		return 'success';
	}
	
	public function admin_orgainzations_data(){
		$this->db->order_by('organizationId', 'desc');
		$query = $this->db->get_where('organizations', array('isDeleted' =>'0'));
		return $query->result();	
	}
	
	public function orgainzation_details($organizationId){
		$query = $this->db->get_where('organizations', array('organizationId' =>$organizationId));
		return $query->row();
	}
	
	public function orgainzation_details_by_encryptId($encryptId){
		$query = $this->db->get_where('organizations', array('encryptId' =>$encryptId));
		return $query->row();
	}
	
	public function orgainzation_members_data($organizationId){
		$this->db->order_by('memberId', 'desc');
		$query = $this->db->get_where('organizations_members', array('organizationId' =>$organizationId, 'isDeleted' =>'0'));
		return $query->result();
	}
	
	public function admin_users_data(){
		$this->db->order_by('memberId', 'desc');
		$query = $this->db->get_where('organizations_members', array('isDeleted' =>'0'));
		return $query->result();	
	}
	
	public function chkPaidMemberStsCh($organizationId){
		$query = $this->db->get_where('organizations', array('organizationId' =>$organizationId));
		return $query->row();	
	}
	
	public function userlogin_details($memberId){
		$query = $this->db->get_where('organizations_members', array('memberId' =>$memberId));
		return $query->row();	
	}
	
	public function organization_details($organizationId){
		$query = $this->db->get_where('organizations', array('organizationId' =>$organizationId));
		return $query->row();	
	}
	
	public function check_login(){
		$email = strtolower(trim($this->input->post('email')));
		$password = $this->input->post('password');
		
		if(isset($email) && $email!='' && isset($password) && $password!=''){
			$query = $this->db->get_where('organizations_members', array('email' =>$email, 'password'=>md5($password)));
			$count = $query->num_rows();			
			if($count>0){
				$row = $query->row();
				if($row->isActive==1){				
					if($row->isDeleted==1){					
						return 'error||Oops, this account was permanently deleted.  You will have to contact support to re-activate your email to login.';					
					}else{
						$session_data = array('sess_naw_memberId'=> $row->memberId, 'sess_naw_organizationId'=> $row->organizationId, 'sess_naw_first_name'=> $row->firstName, 'sess_naw_email'=> $row->email, 'logged_in'=>TRUE);							
						$this->session->set_userdata($session_data);
						return 'success||'.base_url().'profile';
					}
				}else{
					return 'error||Sorry, your profile is not active.';
				}
			}else{
				return 'error||Sorry, you entered the wrong email id and/or password.';
			}
		}else{			
			return 'error||please provide proper email and password of required fields.';
		}
	}
	
	public function account_initiated(){
		$email = strtolower(trim($this->input->post('emailAddress')));
		
		$capchta_word = trim($this->input->post('capchta_word'));
		$enter_captcha_txt = trim($this->input->post('enter_captcha_txt'));
		
		if($capchta_word==$enter_captcha_txt){
		
			$this->db->where('email', $email);
			$query = $this->db->get('organizations_members');
			$num = $query->num_rows();
			if($num==0){
			
				$ipAddress = $_SERVER['REMOTE_ADDR'];
				$createDate = strtotime(date('Y-m-d'));
				$createMonth = date('m');
				$createYear = date('Y');
				$createTime = time();
				
				$firstName = $this->input->post('firstName');
				$lastName = $this->input->post('lastName');
				$contactNo = $this->input->post('contactNo');
				$password = $this->input->post('new_password');
				
				$streetAddress = $this->input->post('streetAddress');
				$regionId = $this->input->post('regionId');
				$state = $this->input->post('state');
				$city = $this->input->post('city');
				$zipCode = $this->input->post('zipCode');
				$role = $this->input->post('role');			
				if(isset($_POST['isDirectory']) && $_POST['isDirectory']!=''){
					$isDirectory = $this->input->post('isDirectory');
				}else{
					$isDirectory = 0;
				}			
				$organizationType = $this->input->post('organizationType');
				$organizationName = $this->input->post('organizationName');
				$instAccountMembers = $this->input->post('instAccountMembers');
				
				if($organizationType==5){
					$subscriptionType = $this->input->post('subscriptionType');
				}else{
					$subscriptionType = 1;
				}				
				$regCost = $this->config->item('subscription_types_array_config')[$subscriptionType]['cost'];
				
				if($organizationType==2){
					$sponsorSts = $this->input->post('sponsorSts');
				}else{
					$sponsorSts = 0;					
				}
				
				if(isset($regCost) && $regCost>0 && $organizationType==5){
					
					$insert = array('firstName'=>$firstName, 'lastName'=>$lastName, 'email'=>$email, 'contactNo'=>$contactNo, 'password'=>md5($password), 'password_v'=>$password,'streetAddress'=>$streetAddress, 'regionId'=>$regionId, 'state'=>$state, 'city'=>$city, 'zipCode'=>$zipCode, 'role'=>$role, 'isDirectory'=>$isDirectory, 'organizationType'=>$organizationType, 'organizationName'=>$organizationName, 'sponsorSts'=>$sponsorSts, 'subscriptionType'=>$subscriptionType, 'ipAddress'=>$ipAddress, 'createDate'=>$createDate, 'createMonth'=>$createMonth, 'createYear'=>$createYear, 'createTime'=>$createTime, 'regCost'=>$regCost, 'instAccountMembers'=>$instAccountMembers);
					
					$this->db->insert('users_initiated',$insert);
					$insertId = $this->db->insert_id();
					$encryptId = md5($insertId).$insertId;
					$this->db->where('userInitiateId',$insertId); 
					$this->db->update('users_initiated', array("initiatedEncryptId"=>$encryptId));
					return 'success||'.base_url().'signup/checkout/'.$encryptId;
					
				}else{
				
					$contactPerson = $firstName.' '.$lastName;
					
					$organization_data = array('contactPerson'=>$contactPerson, 'organizationType'=>$organizationType, 'organizationName'=>$organizationName, 'subscriptionType'=>$subscriptionType, 'regCost'=>$regCost, 'createDate'=>$createDate, 'createTime'=>$createTime, 'createMonth'=>$createMonth, 'createYear'=>$createYear, 'ipAddress'=>$ipAddress, 'instAccountMembers'=>$instAccountMembers);
					
					$this->db->insert('organizations',$organization_data);
					$organizationId = $this->db->insert_id();
					$encryptId = md5($organizationId).$organizationId;
					$this->db->where('organizationId',$organizationId); 
					$this->db->update('organizations', array("encryptId"=>$encryptId, 'isActive'=>'1'));
					
 					$member_data = array('organizationId'=>$organizationId, 'firstName'=>$firstName, 'lastName'=>$lastName, 'email'=>$email, 'contactNo'=>$contactNo, 'password'=>md5($password), 'password_v'=>$password, 'streetAddress'=>$streetAddress, 'regionId'=>$regionId, 'state'=>$state, 'city'=>$city, 'zipCode'=>$zipCode, 'role'=>$role, 'isDirectory'=>$isDirectory, 'sponsorSts'=>$sponsorSts, 'ipAddress'=>$ipAddress, 'createDate'=>$createDate, 'createMonth'=>$createMonth, 'createYear'=>$createYear, 'createTime'=>$createTime);
					
					$this->db->insert('organizations_members',$member_data);
					$memberId = $this->db->insert_id();
					$encryptId = md5($memberId).$memberId;
					$this->db->where('memberId',$memberId); 
					$this->db->update('organizations_members', array("encryptId"=>$encryptId, 'isActive'=>'1'));					
					
					return 'success||'.base_url().'signup/thankyou';
				}			
			
			}else{
				return 'error||Oops, email address already exist!';
			}
		
		}else{
			return 'error||Sorry, The captcha field does not match the Capchta Word field!';
		}
	}
	
	public function reg_checkout_data($initiatedEncryptId){
		$query = $this->db->get_where('users_initiated', array('initiatedEncryptId' =>$initiatedEncryptId));
		return $query->row();
	}
	
	public function checkout_entry(){
		 
		if(isset($_POST['myData'])){
		
			$obj = json_decode($_POST['myData']);
			$pay_status = $obj->status;
			if($pay_status=='COMPLETED'){
			
				$create_time = $obj->create_time;
				$order_or_payer_txn_id = $obj->id; // order id or payer txn id
				$payer_email_address = $obj->payer->email_address;
				$payer_payer_id = $obj->payer->payer_id;
				$payer_first_name = $obj->payer->name->given_name;
				$payer_last_name = $obj->payer->name->surname;
  				
				$userInitiateId = $obj->purchase_units[0]->reference_id;
				
				$invoice_id = $obj->purchase_units[0]->invoice_id;
				$amount = $obj->purchase_units[0]->amount->value;
				$currency = $obj->purchase_units[0]->amount->currency_code;
				
				$payee_email_address = $obj->purchase_units[0]->payee->email_address;
				$payee_merchant_id = $obj->purchase_units[0]->payee->merchant_id;
				$payee_txn_id = $obj->purchase_units[0]->payments->captures[0]->id; // payee txn id
				
				$pay_date = strtotime(date("Y-m-d"));
				$pay_time = strtotime(date("h:i A"));
				$date = date("Y-m-d");
				$expire_date = strtotime ("+1 year" , strtotime ($date)) ;
 				$ip_address = $_SERVER['REMOTE_ADDR'];
				
				$query_int = $this->db->get_where('users_initiated', array('userInitiateId' =>$userInitiateId));
				$row = $query_int->row();
				$contactPerson = $row->firstName.' '.$row->lastName;
				
				$this->db->insert('organizations', array('contactPerson'=>$contactPerson, 'instAccountMembers'=>$row->instAccountMembers, 'organizationType'=>$row->organizationType, 'organizationName'=>$row->organizationName, 'subscriptionType'=>$row->subscriptionType, 'regCost'=>$amount, 'createDate'=>$row->createDate, 'createTime'=>$row->createTime, 'createMonth'=>$row->createMonth, 'createYear'=>$row->createYear, 'ipAddress'=>$row->ipAddress));
				$organizationId = $this->db->insert_id();
 				$encrpted_id = md5($organizationId).$organizationId;
				$this->db->where('organizationId',$organizationId); 
				$this->db->update('organizations', array("encryptId"=>$encrpted_id, "expire_date"=>$expire_date, "paidSts"=>'1', 'isActive'=>'1'));				
				
				$member_data=array('organizationId'=>$organizationId, 'firstName'=>$row->firstName, 'lastName'=>$row->lastName, 'email'=>$row->email, 'contactNo'=>$row->contactNo, 'password'=>$row->password, 'password_v'=>$row->password_v, 'sponsorSts'=>$row->sponsorSts, 'isDirectory'=>$row->isDirectory, 'role'=>$row->role, 'streetAddress'=>$row->streetAddress, 'regionId'=>$row->regionId, 'state'=>$row->state, 'city'=>$row->city, 'zipCode'=>$row->zipCode, 'profilePic'=>$row->profilePic, 'createDate'=>$row->createDate, 'createTime'=>$row->createTime, 'createMonth'=>$row->createMonth, 'createYear'=>$row->createYear, 'ipAddress'=>$row->ipAddress);
				
				$this->db->insert('organizations_members',$member_data);
				$memberId = $this->db->insert_id();
				$encryptId = md5($memberId).$memberId;
				$this->db->where('memberId',$memberId); 
				$this->db->update('organizations_members', array("encryptId"=>$encryptId, "expire_date"=>$expire_date, 'isActive'=>'1'));				
				
				$payment_transactions=array("organizationId"=>$organizationId,"subscriptionType"=>$row->subscriptionType,"txn_id"=>$order_or_payer_txn_id,"txn_type"=>'web',"payer_email"=>$payer_email_address,"payer_id"=>$payer_payer_id,"payer_status"=>'',"payer_first_name"=>$payer_first_name,"payer_last_name"=>$payer_last_name,"mc_currency"=>$currency,"payment_gross"=>$amount,"payment_status"=>$pay_status,"payment_type"=>'',"payment_date"=>$create_time,"business"=>$payee_email_address,"pay_date"=>$pay_date,"pay_time"=>$pay_time,"ip_address"=>$ip_address, "expire_date"=>$expire_date);		
				$this->db->insert("organizations_payments",$payment_transactions);
				$transaction_id = $this->db->insert_id();				
							
				$this->db->delete('users_initiated', array('userInitiateId' =>$userInitiateId));
	
	/*$full_name = $row->full_name;
	$email = $row->email;
	$send_link=base_url();			 
	$this->db->select('*');
	$this->db->where('purpose', 'Welcome to Bravofolio');
	$query1 = $this->db->get('email_templates');
	$fetch_email_templates = $query1->row();
	$subject = $fetch_email_templates->subject;
	$message = $fetch_email_templates->message;
	$status_email = $fetch_email_templates->status; 
	$logo=base_url().'assets/frontend/dashborad/images/bravo_logo.png'; 
	if($status_email==1){ 
		$message = str_replace('{name_of_user}',$full_name,$message);
		$message = str_replace('{logo}',$logo,$message);
		$message = str_replace('{link}',$send_link,$message);
		send_mail($email,$message,$full_name,'admin_email',$subject);
	}*/
	//$this->session->set_flashdata('success', 'Your registration has been done successfully!');
 				 
				return '{"status":"success"}';
			
			}else{
			
				return '{"status":"error"}';
			}
		
		}
		
	
	}
	
	public function update_entry(){
		$memberId = trim($this->input->post('h_memberId'));
		$primaryMember = trim($this->input->post('h_primaryMember'));
		$organizationId = trim($this->input->post('h_organizationId'));
		
		$firstName = $this->input->post('firstName');
		$lastName = $this->input->post('lastName');
		$contactPerson = $firstName.' '.$lastName;  		
		
 		$this->db->where('organizationId',$organizationId); 
		if($primaryMember==0){
			$instAccountMembers = $this->input->post('instAccountMembers');
			$this->db->update('organizations', array("instAccountMembers"=>$instAccountMembers, "contactPerson"=>$contactPerson));
		}else{
			$this->db->update('organizations', array("contactPerson"=>$contactPerson));
		}
					
		
		$email = strtolower(trim($this->input->post('emailAddress')));
			
		
		$this->db->where('memberId != ', $memberId);
		$this->db->where('email', $email);
		$query = $this->db->get('organizations_members');
		$num = $query->num_rows();
		if($num==0){
			
			
			$contactNo = $this->input->post('contactNo');
			//$organizationName = $this->input->post('organizationName');
			$role = $this->input->post('role');	
			
			$streetAddress = $this->input->post('streetAddress');
			$regionId = $this->input->post('regionId');
			$state = $this->input->post('state');
			$city = $this->input->post('city');
			$zipCode = $this->input->post('zipCode');
			
			$sponsorSts = $this->input->post('sponsorSts');
			if(isset($_POST['isDirectory']) && $_POST['isDirectory']!=''){
				$isDirectory = $this->input->post('isDirectory');
			}else{
				$isDirectory = 0;
			}	
			
			
			$data = array("firstName"=>$firstName, "lastName"=>$lastName, "email"=>$email, "contactNo"=>$contactNo, "role"=>$role, "streetAddress"=>$streetAddress, "regionId"=>$regionId, "state"=>$state, "city"=>$city, "zipCode"=>$zipCode, "sponsorSts"=>$sponsorSts, "isDirectory"=>$isDirectory);//, "organizationName"=>$organizationName		
			$this->db->where('memberId',$memberId); 
			$this->db->update('organizations_members',$data);
 			
			if(isset($_FILES['profilePic']['name']) && $_FILES['profilePic']['name']!=''){
			
				$img_data_check = getimagesize($_FILES["profilePic"]['tmp_name']);
				$img_check_width = $img_data_check[0];
				$img_check_height = $img_data_check[1];
				
				$path = './assets/upload/photo/';
				$fil_exp = explode(".", $_FILES['profilePic']['name']);
				$fileExt = strtolower(end($fil_exp));
				$fileName = time().".".$fileExt;
				$new_file_name = trim($fileName);
				
				$imgresize = common_ImageResize('400', '250', 'profilePic', $path, $new_file_name, $fileExt);
				if(isset($imgresize) && $imgresize=='0'){
					
					$this->db->where('memberId',$memberId); 
					$this->db->update('organizations_members', array("profilePic"=>$new_file_name));
					return 'success||';
				
				}else if(isset($imgresize) && $imgresize=='1'){
					return 'error||Oops, unknown image extension.';
				}else if(isset($imgresize) && $imgresize=='2'){
					return 'error||You have exceeded the size limit';
				}
				
			}else{
				return 'success||';						
			}
		
		}else{
			return 'error||Oops, email address already exist!';
		}
	}
	
	public function add_member_entry(){
		$email = strtolower(trim($this->input->post('emailAddress')));
		
		$this->db->where('email', $email);
		$query = $this->db->get('organizations_members');
		$num = $query->num_rows();
		if($num==0){
		
			$ipAddress = $_SERVER['REMOTE_ADDR'];
			$createDate = strtotime(date('Y-m-d'));
			$createMonth = date('m');
			$createYear = date('Y');
			$createTime = time();
			
			$organizationId = $this->input->post('adm_organizationId');
			$organizationType = $this->input->post('adm_organizationType');
			$expire_date = $this->input->post('adm_expire_date');
			$membersCnt = $this->input->post('adm_membersCnt');
			$newMembersCnt = $membersCnt+1;
			
			$firstName = $this->input->post('firstName');
			$lastName = $this->input->post('lastName');
			$contactNo = $this->input->post('contactNo');
			$password = $this->input->post('new_password');
			
			$streetAddress = $this->input->post('streetAddress');
			$regionId = $this->input->post('regionId');
			$state = $this->input->post('state');
			$city = $this->input->post('city');
			$zipCode = $this->input->post('zipCode');
			$role = $this->input->post('role');			
			if(isset($_POST['isDirectory']) && $_POST['isDirectory']!=''){
				$isDirectory = $this->input->post('isDirectory');
			}else{
				$isDirectory = 0;
			}			
						
			$sponsorSts = 0;	
			if($organizationType==2){
				$sponsorSts = $this->input->post('sponsorSts');
			}
			$isActive = $this->input->post('isActive');
			
			$member_data = array('organizationId'=>$organizationId, 'firstName'=>$firstName, 'lastName'=>$lastName, 'email'=>$email, 'contactNo'=>$contactNo, 'password'=>md5($password), 'password_v'=>$password, 'streetAddress'=>$streetAddress, 'regionId'=>$regionId, 'state'=>$state, 'city'=>$city, 'zipCode'=>$zipCode, 'role'=>$role, 'isDirectory'=>$isDirectory, 'sponsorSts'=>$sponsorSts, 'ipAddress'=>$ipAddress, 'createDate'=>$createDate, 'createMonth'=>$createMonth, 'createYear'=>$createYear, 'createTime'=>$createTime, 'expire_date'=>$expire_date, 'isActive'=>$isActive, 'primaryMember'=>'1');
				
			$this->db->insert('organizations_members',$member_data);
			$memberId = $this->db->insert_id();
			$encryptId = md5($memberId).$memberId;
			$this->db->where('memberId',$memberId); 
			$this->db->update('organizations_members', array("encryptId"=>$encryptId));
			
			$this->db->where('organizationId',$organizationId); 
			$this->db->update('organizations', array("membersCnt"=>$newMembersCnt));						
			$this->session->set_flashdata('success', 'Added successfully!');
			return 'success||';	
		
		}else{
			return 'error||Oops, email address already exist!';
		}
	}
	
	public function edit_member_entry(){
		$email = strtolower(trim($this->input->post('emailAddress')));
		$memberId = $this->input->post('h_memberId');
		
		$this->db->where('memberId != ', $memberId);
		$this->db->where('email', $email);
		$query = $this->db->get('organizations_members');
		$num = $query->num_rows();
		if($num==0){
		
			$ipAddress = $_SERVER['REMOTE_ADDR'];
			$createDate = strtotime(date('Y-m-d'));
			$createMonth = date('m');
			$createYear = date('Y');
			$createTime = time();
			
			$organizationId = $this->input->post('adm_organizationId');
			$organizationType = $this->input->post('adm_organizationType');
			$expire_date = $this->input->post('adm_expire_date');
			$membersCnt = $this->input->post('adm_membersCnt');
			$newMembersCnt = $membersCnt+1;
			
			$firstName = $this->input->post('firstName');
			$lastName = $this->input->post('lastName');
			$contactNo = $this->input->post('contactNo');
 			
			$streetAddress = $this->input->post('streetAddress');
			$regionId = $this->input->post('regionId');
			$state = $this->input->post('state');
			$city = $this->input->post('city');
			$zipCode = $this->input->post('zipCode');
			$role = $this->input->post('role');			
			if(isset($_POST['isDirectory']) && $_POST['isDirectory']!=''){
				$isDirectory = $this->input->post('isDirectory');
			}else{
				$isDirectory = 0;
			}			
						
			$sponsorSts = 0;	
			if($organizationType==2){
				$sponsorSts = $this->input->post('sponsorSts');
			}
			$isActive = $this->input->post('isActive');
			
			$member_data = array('firstName'=>$firstName, 'lastName'=>$lastName, 'email'=>$email, 'contactNo'=>$contactNo, 'streetAddress'=>$streetAddress, 'regionId'=>$regionId, 'state'=>$state, 'city'=>$city, 'zipCode'=>$zipCode, 'role'=>$role, 'isDirectory'=>$isDirectory, 'sponsorSts'=>$sponsorSts, 'isActive'=>$isActive);
 			$this->db->where('memberId',$memberId); 
			$this->db->update('organizations_members', $member_data);			
			
			if(isset($_POST['password']) && $_POST['password']!=''){			
				$password = $this->input->post('password');
				$this->db->where('memberId',$memberId); 
				$this->db->update('organizations_members', array('password'=>md5($password), 'password_v'=>$password));					
			}
			$this->session->set_flashdata('success', 'Updated successfully!');
			return 'success||';	
		
		}else{
			return 'error||Oops, email address already exist!';
		}
	}
	
	public function delete_member($memberId){
		$this->db->where('memberId',$memberId); 
		$this->db->update('organizations_members', array('isDeleted'=>'1'));	
		$this->session->set_flashdata('success', 'Deleted successfully!');	
	}
	
	public function delete_organization($organizationId){
		$this->db->where('organizationId',$organizationId); 
		$this->db->update('organizations', array('isDeleted'=>'1'));
		
		$this->db->where('organizationId',$organizationId); 
		$this->db->update('organizations_members', array('isDeleted'=>'1'));	
		$this->session->set_flashdata('success', 'Deleted successfully!');	
	}
	
	public function update_free_plan($planId){
		$organizationId = $this->input->post('h_organizationId');
 		
		$this->db->where('organizationId',$organizationId); 
		$this->db->update('organizations', array('subscriptionType'=>$planId, 'expire_date'=>'0', "paidSts"=>'0', 'planUpdatedOn'=>time()));
		
		$memberId = $this->input->post('h_memberId');
		
		$this->db->where('organizationId',$organizationId); 
		$this->db->update('organizations_members', array('expire_date'=>'0'));	
		$this->session->set_flashdata('success', 'Subcription type has been changed successfully!');
		return 'success';
		
	}
	
	public function upgrade_checkout_entry(){
		 
		if(isset($_POST['myData'])){
		
			$obj = json_decode($_POST['myData']);
			$pay_status = $obj->status;
			if($pay_status=='COMPLETED'){
			
				$create_time = $obj->create_time;
				$order_or_payer_txn_id = $obj->id; // order id or payer txn id
				$payer_email_address = $obj->payer->email_address;
				$payer_payer_id = $obj->payer->payer_id;
				$payer_first_name = $obj->payer->name->given_name;
				$payer_last_name = $obj->payer->name->surname;
  				
				$reference_ids = $obj->purchase_units[0]->reference_id;
				$organizationId = $reference_ids[0];
				$subscriptionType = $reference_ids[1];
				$organizationType = $reference_ids[2];
				
				$invoice_id = $obj->purchase_units[0]->invoice_id;
				$amount = $obj->purchase_units[0]->amount->value;
				$currency = $obj->purchase_units[0]->amount->currency_code;
				
				$payee_email_address = $obj->purchase_units[0]->payee->email_address;
				$payee_merchant_id = $obj->purchase_units[0]->payee->merchant_id;
				$payee_txn_id = $obj->purchase_units[0]->payments->captures[0]->id; // payee txn id
				
				$pay_date = strtotime(date("Y-m-d"));
				$pay_time = strtotime(date("h:i A"));
				$date = date("Y-m-d");
				$expire_date = strtotime ("+1 year" , strtotime ($date)) ;
 				$ip_address = $_SERVER['REMOTE_ADDR'];
 				
 				$this->db->where('organizationId',$organizationId); 
				$this->db->update('organizations', array("organizationType"=>$organizationType, "subscriptionType"=>$subscriptionType, "expire_date"=>$expire_date, "paidSts"=>'1', 'planUpdatedOn'=>time()));		
 				 
				$this->db->where('organizationId',$organizationId); 
				$this->db->update('organizations_members', array("expire_date"=>$expire_date));				
				
				$payment_transactions=array("organizationId"=>$organizationId,"subscriptionType"=>$subscriptionType,"txn_id"=>$order_or_payer_txn_id,"txn_type"=>'web',"payer_email"=>$payer_email_address,"payer_id"=>$payer_payer_id,"payer_status"=>'',"payer_first_name"=>$payer_first_name,"payer_last_name"=>$payer_last_name,"mc_currency"=>$currency,"payment_gross"=>$amount,"payment_status"=>$pay_status,"payment_type"=>'',"payment_date"=>$create_time,"business"=>$payee_email_address,"pay_date"=>$pay_date,"pay_time"=>$pay_time,"ip_address"=>$ip_address, "expire_date"=>$expire_date);		
				$this->db->insert("organizations_payments",$payment_transactions);
	
	/*$full_name = $row->full_name;
	$email = $row->email;
	$send_link=base_url();			 
	$this->db->select('*');
	$this->db->where('purpose', 'Welcome to Bravofolio');
	$query1 = $this->db->get('email_templates');
	$fetch_email_templates = $query1->row();
	$subject = $fetch_email_templates->subject;
	$message = $fetch_email_templates->message;
	$status_email = $fetch_email_templates->status; 
	$logo=base_url().'assets/frontend/dashborad/images/bravo_logo.png'; 
	if($status_email==1){ 
		$message = str_replace('{name_of_user}',$full_name,$message);
		$message = str_replace('{logo}',$logo,$message);
		$message = str_replace('{link}',$send_link,$message);
		send_mail($email,$message,$full_name,'admin_email',$subject);
	}*/
	 
 				 
				$this->session->set_flashdata('success', 'Subcription type has been changed successfully!');
				return '{"status":"success"}';
			
			}else{
			
				return '{"status":"error"}';
			}
		
		}
		
	
	}
	
	public function send_notification(){
		
		$hSelectedIds = $this->input->post('hSelectedIds');	
		$multiple_emails = array();
		
		if(isset($hSelectedIds) && $hSelectedIds!=''){
		
			$subject = $this->input->post('subjectNoti');	
			$message = $this->input->post('MessageNoti');	
			
			$this->db->select("email, firstName");
			$this->db->where("organizationId in (".$hSelectedIds.")");
			$query = $this->db->get('organizations_members');
			$res = $query->result();
			foreach($res as $user){
				$multiple_emails[] = $user->email.'||'.$user->firstName;
			}
			
			if(count($multiple_emails)>0){
				$multiple_recipients = implode(',',$multiple_emails);	
				send_mail_to_multiple($multiple_recipients,$message,'','info',$subject);
			}
			$this->session->set_flashdata('success', 'Notification has been sent successfully!'); 
			return 'success';
			
		}else{
			return 'Please select at least one organization.';
		}
	}
	
}