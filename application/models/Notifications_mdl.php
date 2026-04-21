<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Notifications_mdl extends CI_Model {
	
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
	
	public function active_members(){
		$this->db->select('memberId, firstName, email');
		$query = $this->db->get_where('organizations_members', array('isActive'=>'1', 'isDeleted'=>'0'));//, 'memberId'=>'1'
		return $query->result_array();
	}
	
	public function directory_listing($todayDate){
		$query = $this->db->get_where('organizations_members', array('isDirectory'=>'1', 'isActive'=>'1', 'isDeleted'=>'0', 'createDate'=>$todayDate));
		return $query->num_rows();	
	}
	
	public function business_entities_listing($todayDate){
		$query = $this->db->get_where('organizations_members', array('sponsorSts'=>'1', 'isActive'=>'1', 'isDeleted'=>'0', 'createDate'=>$todayDate));
		return $query->num_rows();	
	}
	
	public function strategic_partner($todayDate){
		$query = $this->db->get_where('organizations', array('organizationType'=>'5', 'isActive'=>'1', 'isDeleted'=>'0', 'createDate'=>$todayDate));
		return $query->num_rows();	
	}
	
	public function job_posted($todayDate){
		$query = $this->db->get_where('jobs', array('isStatus'=>'0', 'isDeleted'=>'0', 'createDate'=>$todayDate));
		return $query->num_rows();	
	}
	
	public function resources($todayDate){
		$query = $this->db->get_where('resources', array('isStatus'=>'0', 'isDeleted'=>'0', 'createDate'=>$todayDate));
		return $query->num_rows();	
	}
	
	public function members_spotlight($todayDate){
		$query = $this->db->get_where('members_spotlights', array('isStatus'=>'0', 'isDeleted'=>'0', 'createdDate'=>$todayDate));
		return $query->num_rows();	
	}
	
}