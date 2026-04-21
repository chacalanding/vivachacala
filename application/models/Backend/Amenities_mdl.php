<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Amenities_mdl extends CI_Model {
    
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
	
	public function activeAmenitiesArr(){
		$this->db->where('is_status', '0');
		$this->db->where('is_delete', '0');
		$this->db->order_by('name', 'asc');
		$query = $this->db->get('amenities');
		return $query->result_array();
	}
	
	public function amenities_details(){
		$this->db->where('is_delete', '0');
		$this->db->order_by('name', 'asc');
		$query = $this->db->get('amenities');
		return $query->result();
	}
	
	public function amenities_fulldetails($member_id){
		$this->db->where('id',$member_id);
		$query=$this->db->get('amenities');
		return $query->row();      
	}

	public function create_entry(){
		$catId = $this->input->post('catId');
		$name = trim($this->input->post('name'));
		$slug = create_slug_ch($name);
		$insert_data =  array("catId" => $catId, "name" => $name, "slug" => $slug);
		$this->db->insert('amenities', $insert_data);
		$this->session->set_flashdata('success', 'Added successfully!');
		return 'success||'.base_url().$this->config->item('admin_directory_name').'amenities';		  
	}   
	
	public function update_amenities(){
		$member_id = trim($this->input->post('id'));
		$name = trim($this->input->post('name'));
		$slug = create_slug_ch($name);
		$catId = $this->input->post('catId');
		$is_status = $this->input->post('is_status');
		
		$this->db->where('id', $member_id);		
		$this->db->update('amenities', array("name" => $name, "slug" => $slug, "catId" => $catId, "is_status" => $is_status));
		$this->session->set_flashdata('success', 'Updated successfully!');
		return 'success||'.base_url().$this->config->item('admin_directory_name').'amenities';       
	}
	
	public function delete_entry($member_id){
		$this->db->where('id', $member_id);
		$this->db->update('amenities', array("is_delete" => '1'));		
		$this->session->set_flashdata('success', 'Deleted successfully!');;
	}

}
