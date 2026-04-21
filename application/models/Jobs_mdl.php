<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Jobs_mdl extends CI_Model {
	
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
	
	public function my_jobs_array($memberId){
		$this->db->where('isDeleted','0'); 
		$this->db->order_by('jobId', 'desc');
		$query = $this->db->get_where('jobs', array('memberId' =>$memberId));
		return $query->result_array();
	}
	
	public function get_posted_jobs_data(){
		$currentDate = strtotime(date('Y-m-d'));
		$this->db->select('j.*, m.firstName, m.lastName');
		$this->db->from('jobs as j');
		$this->db->where('j.expire_date >= ',$currentDate);
		$this->db->where('j.isStatus','0'); 
		$this->db->where('j.isDeleted','0'); 
		$this->db->order_by('j.jobId','desc'); 
		$this->db->join('organizations_members as m', 'm.memberId = j.memberId', 'LEFT');
		$query = $this->db->get();
		return $query->result_array();
	}
	
	public function job_delete($encryptId){
		$this->db->where('encryptId',$encryptId); 
		$this->db->update('jobs', array("isDeleted"=>'1'));
		$this->session->set_flashdata('success', 'Deleted successfully!'); 
	}
	
	public function job_details($encryptId){
		$query = $this->db->get_where('jobs', array('encryptId' =>$encryptId));
		return $query->row();
	}
	
	public function manage_entry(){
		
		$memberId = trim($this->input->post('h_memberId'));
		$organizationId = trim($this->input->post('h_organizationId'));
		
		$createDate = strtotime(date('Y-m-d'));
		$createMonth = date('m');
		$createYear = date('Y');
		$createTime = time();
		$expire_date = strtotime ("+6 month", $createDate);
		
		$jobId = trim($this->input->post('h_jobId'));
		$organization = trim($this->input->post('organization'));
		$jobTitle = trim($this->input->post('jobTitle'));
		$jobSlug = create_slug_ch($jobTitle);
		
		$jobContent = $this->input->post('jobContent');
		$rLink = $this->input->post('rLink');
		$isStatus = $this->input->post('isStatus');
		
		$jobData = array('organizationId'=>$organizationId, 'memberId'=>$memberId, 'organization'=>$organization, 'jobTitle'=>$jobTitle, 'jobSlug'=>$jobSlug, 'jobContent'=>$jobContent, 'rLink'=>$rLink, 'isStatus'=>$isStatus, 'updatedOn'=>$createTime);
		
		if(isset($jobId) && $jobId!='' && $jobId>0){
			
			$updatedResId = $jobId;
			$this->db->where('jobId',$jobId); 
			$this->db->update('jobs', $jobData);
			$this->session->set_flashdata('success', 'Updated successfully!'); 
			
		}else{				
			
			$this->db->insert('jobs',$jobData);
			$insertedId = $this->db->insert_id();
			$updatedResId = $insertedId;
			$encryptId = md5($insertedId).$insertedId;			
			$this->db->where('jobId',$insertedId); 
			$this->db->update('jobs', array("encryptId"=>$encryptId, 'createDate'=>$createDate, 'createMonth'=>$createMonth, 'createYear'=>$createYear, 'createTime'=>$createTime, 'expire_date'=>$expire_date));
			$this->session->set_flashdata('success', 'Added successfully!'); 
			
		}
		
		return 'success||'.base_url().'jobs/my';
		
	}
	
}