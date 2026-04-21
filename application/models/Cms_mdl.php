<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Cms_mdl extends CI_Model {
	
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
	
	public function spotlight_submissions_members(){
		$this->db->select('ms.updatedSpotlightContent, ms.createdTime, ms.encryptId, u.firstName, u.lastName, u.email, u.profilePic, o.organizationName');
		$this->db->from('members_spotlights as ms');
		$this->db->where('ms.displayWebSts','0');
		$this->db->where('ms.isStatus','0'); 
		$this->db->where('ms.isDeleted','0'); 
		$this->db->order_by('ms.spotlightId','desc'); 
		$this->db->join('organizations_members as u', 'u.memberId = ms.memberId', 'LEFT');
		$this->db->join('organizations as o', 'o.organizationId = ms.organizationId', 'LEFT');
		$query = $this->db->get();
		return $query->result_array();
	}
	
	public function spotlight_submissions_details_by_encryptId($encryptId){
		$this->db->select('ms.*, u.firstName, u.lastName, u.profilePic, u.email, o.organizationName');
		$this->db->from('members_spotlights as ms');
		$this->db->where('ms.encryptId', $encryptId);
		$this->db->where('ms.isDeleted','0'); 
		$this->db->order_by('ms.spotlightId','desc'); 
		$this->db->join('organizations_members as u', 'u.memberId = ms.memberId', 'LEFT');
		$this->db->join('organizations as o', 'o.organizationId = ms.organizationId', 'LEFT');
		$query = $this->db->get();
		return $query->row();
	}
	
	public function update_submission_entry(){
		$spotlightId = $this->input->post('spotlightId');
		$updatedSpotlightContent = $this->input->post('updatedSpotlightContent');
		$displayWebSts = $this->input->post('displayWebSts');	
		$isStatus = $this->input->post('isStatus');	
		$this->db->where('spotlightId', $spotlightId);
		$this->db->update('members_spotlights', array("updatedSpotlightContent"=>$updatedSpotlightContent, "displayWebSts"=>$displayWebSts, "isStatus"=>$isStatus));
		
		if(isset($_FILES['photoImg']['name']) && $_FILES['photoImg']['name']!=''){
				
			//$img_data_check = getimagesize($_FILES["photoImg"]['tmp_name']);
			//$img_check_width = $img_data_check[0];
			//$img_check_height = $img_data_check[1];
			
			$path = './assets/upload/photo/';
			$fil_exp = explode(".", $_FILES['photoImg']['name']);
			$fileExt = strtolower(end($fil_exp));
			$fileName = time().".".$fileExt;
			$new_file_name = trim($fileName);
			
			$imgresize = common_ImageResize('400', '250', 'photoImg', $path, $new_file_name, $fileExt);
			if(isset($imgresize) && $imgresize=='0'){
				
				$this->db->where('spotlightId', $spotlightId);
				$this->db->update('members_spotlights', array("photo"=>$new_file_name));
				return 'success';
			
			}else if(isset($imgresize) && $imgresize=='1'){
				return 'Oops, unknown image extension.';
			}else if(isset($imgresize) && $imgresize=='2'){
				return 'You have exceeded the size limit';
			}
			
		}else{
			return 'success';
		}
		
	}
	
	public function spotlight_submissions_details($spotlightId){
		$this->db->select('ms.*, u.firstName, u.lastName, u.profilePic, u.email, o.organizationName');
		$this->db->from('members_spotlights as ms');
		$this->db->where('ms.spotlightId', $spotlightId);
		$this->db->where('ms.isDeleted','0'); 
		$this->db->order_by('ms.spotlightId','desc'); 
		$this->db->join('organizations_members as u', 'u.memberId = ms.memberId', 'LEFT');
		$this->db->join('organizations as o', 'o.organizationId = ms.organizationId', 'LEFT');
		$query = $this->db->get();
		return $query->row();
	}
	
	public function spotlight_submissions_data(){
		$this->db->select('ms.*, u.firstName, u.lastName, u.email, o.organizationName');
		$this->db->from('members_spotlights as ms');
		$this->db->where('ms.isDeleted','0'); 
		$this->db->order_by('ms.spotlightId','desc'); 
		$this->db->join('organizations_members as u', 'u.memberId = ms.memberId', 'LEFT');
		$this->db->join('organizations as o', 'o.organizationId = ms.organizationId', 'LEFT');
		$query = $this->db->get();
		return $query->result_array();
	}
	
	public function update_spotlight_submission_status($spotlightId,$column_name,$status){	
		$data = array("$column_name"=>$status);
		$this->db->where('spotlightId', $spotlightId);
		$this->db->update('members_spotlights',$data);		
		return 'success';
	}
	
	public function delete_submission($spotlightId){
		$this->db->where('spotlightId', $spotlightId);
		$this->db->update('members_spotlights', array("isDeleted"=>'1'));
		$this->session->set_flashdata('success', 'Deleted successfully!'); 
	}
	
	public function getPlanningMinLinks(){
		$this->db->where('id', '1');
		$query = $this->db->get('admin_login');
		$row = $query->row();
		return $row->planningMinLinks;
	}
	
	public function spotlight_entry(){
		if(isset($_POST['spotlightContent']) && $_POST['spotlightContent']!=''){
			$organizationId = $this->input->post('h_organizationId');
			$memberId = $this->input->post('h_memberId');
			$spotlightContent = $this->input->post('spotlightContent');	
			$createdTime = time();
			$createdDate = strtotime(date('Y-m-d'));
			$this->db->insert('members_spotlights', array("organizationId"=>$organizationId, "memberId"=>$memberId, "spotlightContent"=>$spotlightContent, "updatedSpotlightContent"=>$spotlightContent, "createdDate"=>$createdDate, "createdTime"=>$createdTime));
 			$spotlightId = $this->db->insert_id();
			$encryptId = md5($spotlightId).$spotlightId;
			$this->db->where('spotlightId',$spotlightId); 
			$this->db->update('members_spotlights', array("encryptId"=>$encryptId));
 			$this->session->set_flashdata('success', 'Submitted successfully!'); 
			return 'success||';
		}else{
			return 'error||Please enter you spotlight highlights.';
		}
	}
	
	public function front_cms_data(){
		$this->db->where('frontSts', '1');
		$query = $this->db->get('cms');
		return $query->result_array();
	}
	
	public function sponsors_listing(){
		$this->db->select('om.*, o.organizationName');
		$this->db->from('organizations_members as om');	
		$this->db->where('om.isDeleted', '0');
		$this->db->where('om.isActive', '1');
		$this->db->where('om.sponsorSts', '1');
		$this->db->order_by('om.memberId', 'desc');
		$this->db->join('organizations as o', 'o.organizationId = om.organizationId', 'LEFT');
		$query = $this->db->get();
		return $query->result_array();
	}
	
	public function assessment_directory_listing(){
		$this->db->select('om.*, o.organizationName');
		$this->db->from('organizations_members as om');	
		$this->db->where('om.isDeleted', '0');
		$this->db->where('om.isActive', '1');
		$this->db->where('om.isDirectory', '1');
		$this->db->order_by('om.memberId', 'desc');
		$this->db->join('organizations as o', 'o.organizationId = om.organizationId', 'LEFT');
		$query = $this->db->get();
		return $query->result_array();
	}
	
	public function planning_committee_data(){
		$this->db->where('is_delete', '0');
		$this->db->where('is_status', '0');
		$this->db->order_by('name', 'asc');
		$query = $this->db->get('planning_committee');
		return $query->result_array();
	}
	
	public function top_section_update(){
		$page_name = $this->input->post('h_page_name');
		$module_name = $this->input->post('h_module_name');
		
		$content = $this->input->post('content');
		$title_span = $this->input->post('title_span');
		$subtitle = $this->input->post('subtitle');
		$title = $this->input->post('title');
		
		$this->db->where('page_name', $page_name);
		$this->db->where('module_name', $module_name);
		$this->db->update('cms', array("content"=>$content, "title_span"=>$title_span, "subtitle"=>$subtitle, "title"=>$title));
		$this->session->set_flashdata('success', 'Updated successfully!'); 
		return 'success||';
	}
	
	public function get_configuration_details(){
		$query = $this->db->get('configuration');
		return $query->row();
	}
 
	public function cms_details($page_name,$module_name){
		$this->db->where('page_name', $page_name);
 		$this->db->where('module_name', $module_name);
		$query = $this->db->get('cms');
		return $query->row();
	}
	
	public function content_manage($page_name,$module_name){
	 
		$page_name_label = ucwords(str_replace('_',' ',$page_name));
		
		$this->db->where('page_name', $page_name);
		$this->db->where('module_name', $module_name);
		$query = $this->db->get('cms');
		$num = $query->num_rows(); 
		$txt_title = trim($this->input->post('txt_title'));
		$txt_content = $this->input->post('txt_content');
		
		if($num==0){
			$insert_data=array(
				"page_name"=>$page_name,
				"module_name"=>$module_name,
				"title"=>$txt_title, 
				"content"=>$txt_content,
				"add_date"=>time());
			
			$this->db->insert('cms',$insert_data);
			$id = $this->db->insert_id();
			$this->session->set_flashdata('success', $page_name_label.' page content has been saved successfully!'); 
		}else{
			$row = $query->row();
			$id = $row->id;
			$data=array("title"=>$txt_title,"content"=>$txt_content);	
			$this->db->where('id', $id);
			$this->db->update('cms',$data);
			$this->session->set_flashdata('success', $page_name_label.' page content has been updated successfully!'); 
		}
		
		$custom_fields = get_cmsmeta_fields_h($id);	
		
		if(count($custom_fields)>0){
			
			foreach ($custom_fields as $field_data) {
			
				$meta_key = $field_data->meta_key;
				$meta_value = $_POST["$meta_key"];
				
				$cmsmeta_data=array("meta_value"=>$meta_value);	
				
				$this->db->where('meta_key', $meta_key);
				$this->db->where('page_id', $id);
				$this->db->update('cmsmeta',$cmsmeta_data);				
			}
		
		}
		
		
		if(isset($_FILES['upDoc']['name']) && $_FILES['upDoc']['name']!=''){
		
			$fil_exp_upDoc = explode(".", $_FILES['upDoc']['name']);
			$fileExt = strtolower(end($fil_exp_upDoc));
			$fileName = time().".".$fileExt;				
			
			$path = './assets/upload/logo/';
			$config['file_name'] = $fileName;
			$config['upload_path'] = $path;
			$config['allowed_types'] = '*';
			$this->load->library('upload');
			$this->upload->initialize($config);
			$this->upload->do_upload('upDoc');				
			$errors = $this->upload->display_errors();
			if(isset($errors) && $errors!=''){
				 
			}else{
				
				if(isset($id) && $id!='' && $id>0){
					$old_upload_doc = trim($this->input->post('old_upload_doc'));
					if(isset($old_upload_doc) && $old_upload_doc!=''){
 						$chkFileExist = FCPATH.'assets/upload/logo/'.$old_upload_doc;
						if(file_exists($chkFileExist)){
							unlink($path.$old_upload_doc);
						}
					}
				}
				
				$this->db->where('id', $id);
				$this->db->update('cms', array("image"=>$fileName));
			}
		}
		
		
			
	}
	
	public function welcome_content_detail($page_name,$module_name){ 		
 		$this->db->where('page_name', $page_name);
 		$this->db->where('module_name', $module_name);
		$query = $this->db->get('cms');
		return $query->row();
	}	
	
	public function add_welcome_content($page_name,$module_name){
		$page_name_label = ucwords(str_replace('_',' ',$page_name));
	 	$txt_title = trim($this->input->post('txt_title'));
		$txt_title_span = trim($this->input->post('txt_title_span'));
		$txt_subtitle = trim($this->input->post('txt_subtitle'));
		$txt_content = $this->input->post('txt_content');
		
		$insert_data=array("page_name"=>$page_name,"module_name"=>$module_name,
			"title"=>$txt_title, "title_span"=>$txt_title_span,"subtitle"=>$txt_subtitle,
			"content"=>$txt_content, "add_date"=>time());
				
		$this->db->where('page_name', $page_name);
		$this->db->where('module_name', $module_name);
		$query = $this->db->get('cms');
		$num = $query->num_rows(); 
			$row = $query->row();
			$id = $row->id;
		
		if($num==0){
			$this->db->insert('cms',$insert_data);
			$this->session->set_flashdata('success', $page_name_label.' page content has been saved successfully!'); 
		}else{
			$this->db->where('id', $id);
			$this->db->update('cms',$insert_data);
			$this->session->set_flashdata('success', $page_name_label.' page content has been updated successfully!'); 
		}
	}
	
	
	public function newsletter_subscribe($email_id){
		$insert_data=array('email_id'=>$email_id, 
			'status'=>'1', 'add_date'=>time());
			
		$this->db->where('email_id', $email_id);
		$query = $this->db->get('newsletter');
		$num = $query->num_rows(); 
		
		if($num==0){
			$this->db->insert('newsletter',$insert_data); 
			return TRUE;
		}else{
			return FALSE;
		}
	}
	
	public function newsletter_entry(){
		$email=trim(strtolower($_POST['newsletter_email']));
		$this->db->where('email', $email);
		$query = $this->db->get('newsletters');
		$num = $query->num_rows(); 
		if(isset($email) && $email!='' && $num==0){
			$ip_address=$_SERVER['REMOTE_ADDR'];
			$reg_date=strtotime(date('Y-m-d'));
			$reg_date_time=strtotime(date('h:i A'));		
			$insert_data=array("email"=>$email,"reg_date"=>$reg_date,"reg_date_time"=>$reg_date_time,"ip_address"=>$ip_address);		
			$this->db->insert('newsletters',$insert_data);
			echo 'success';
		}else{
			echo 'your email is already exist.';
		}
	}
	
	public function get_newsletters_listing(){
		$this->db->order_by('id', 'desc');
		$query = $this->db->get('newsletters');
		return $query->result();
	}
	
	public function realestate_details(){
		$this->db->order_by('id', 'desc');
		$this->db->where('is_status', '1');
		$query = $this->db->get('real_estate');
		return $query->result();
	}	
	
	public function realestate_row($reid){
		$this->db->where('id', $reid);
		$query = $this->db->get('real_estate');
		return $query->row();
	}
}