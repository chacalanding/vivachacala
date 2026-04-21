<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Forgot_password_mdl extends CI_Model {
	
	/**
	* Constructor
	*
	* @access public
	*/	 
	public function __construct(){
		parent::__construct();
		$this->load->library('email');
		$config['protocol'] = 'sendmail';
		$config['mailpath'] = '/usr/sbin/sendmail';
		$config['charset'] = 'iso-8859-1';
		$config['wordwrap'] = TRUE;
		$config['mailtype'] = 'html';
		$this->email->initialize($config);
	}
	
	public function forgot_password(){
		
		if(isset($_POST['capchta_word']) && $_POST['capchta_word']!='' && isset($_POST['enter_captcha_txt']) && $_POST['enter_captcha_txt']!='' && $_POST['capchta_word']==$_POST['enter_captcha_txt']){
		
			$email = trim($this->input->post('email'));
			$this->db->where('email', $email); 
			$query = $this->db->get('organizations_members');
			$num = $query->num_rows();
			if($num==1){
				$row = $query->row();
				if($row->isDeleted==1){					
					return "error||Oops, your account has been deleted, so you aren't able to reset password, please contact to support.";					
				}else{
					$name = $row->firstName; 
					$unique = $this->generateRandomString(10);
					$expLinkTime=time()+(24*60*60); 
					$this->db->where('email', $email); 
					$this->db->update('organizations_members',array('tempForget'=>$unique,'expLinkTime'=>$expLinkTime));
					$recover_link = base_url().'recover/password/'.$row->encryptId.'/'.$unique; 
					
					$this->db->select('*');
					$this->db->where('purpose', 'Forgot Password Member');
					$query1 = $this->db->get('email_templates');
					$fetch_email_templates = $query1->row();
					$subject = $fetch_email_templates->subject;
					$message = $fetch_email_templates->message;
					$status_email = $fetch_email_templates->status;
					
					if($status_email==1){
						$product_name = $this->config->item('product_name');
						$message = str_replace('{name}',$name,$message);
						$message = str_replace('{link}',$recover_link,$message);
						$message = str_replace('{product_name}',$product_name,$message);
						send_mail($email,$message,$name,'support',$subject);
						return 'success||'.str_msg19; 
					}
				}
			}else{
				return 'error||'.str_msg18;
			}
			
		}else{
			return 'error||Sorry, The captcha field does not match the Capchta Word field.';
		}
	}	
	
	public function recover_password_entry($encryptId,$sha_forgot){
		$this->db->where('encryptId', $encryptId);
		$this->db->where('tempForget', $sha_forgot);
		$query = $this->db->get('organizations_members');
		$num = $query->num_rows();
 		if($num>0){	
			$row = $query->row(); 
			$password = $this->input->post('confirm_password');
 			$data = array("password"=>md5($password), "password_v"=>$password, "tempForget"=>'', "expLinkTime"=>'');
			$this->db->where('memberId',$row->memberId);
			$this->db->update('organizations_members', $data);
			$this->session->set_flashdata('success', str_msg20); 
			return 'success||'.base_url().'login'; 
		}else{
			return 'error||'.str_msg21;
		}
	}
	
	public function generateRandomString($length = 5) {
		$characters = '123456789abdefghnqrstuABCDEFGHIJKLMNPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
	}		
	
}	