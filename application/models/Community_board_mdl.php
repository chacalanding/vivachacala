<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Community_board_mdl extends CI_Model {
	
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
	
	public function my_community_board_array($memberId){
		$this->db->where('isDeleted','0'); 
		$this->db->order_by('forumId', 'desc');
		$query = $this->db->get_where('community_board', array('memberId' =>$memberId));
		return $query->result_array();
	}
	
	public function get_all_community_board_data(){
		$this->db->select('cb.*, m.firstName, m.lastName');
		$this->db->from('community_board as cb');
		
		if(isset($_GET['s']) && $_GET['s']!=''){
			$kw = $_GET['s'];
			$where = " (postTitle like '%".$kw."%' || postContent like '%".$kw."%')";
			$this->db->where($where); 
		}
		
		$this->db->where('cb.isStatus','0'); 
		$this->db->where('cb.isDeleted','0'); 
		$this->db->order_by('cb.forumId','desc'); 
		$this->db->join('organizations_members as m', 'm.memberId = cb.memberId', 'LEFT');
		$query = $this->db->get();
		return $query->result_array();
	}
	
	public function get_forum_replys_data($forumId){
		$this->db->select('r.replyContent, r.replyTime, u.firstName, u.lastName');
		$this->db->from('community_board_replys as r');
		$this->db->where('r.forumId',$forumId); 
		$this->db->where('r.isStatus','0'); 
		$this->db->where('r.isDeleted','0'); 
		$this->db->order_by('r.replyId','desc'); 
		$this->db->join('organizations_members as u', 'u.memberId = r.memberId', 'LEFT');
		$query = $this->db->get();
		return $query->result_array();
		
		
		
		/*$this->db->where('isStatus','0'); 
		$this->db->where('isDeleted','0'); 
		$this->db->order_by('replyId','desc'); 
		$query = $this->db->get_where('community_board_replys', array('forumId' =>$forumId));
		return $query->result_array();*/
	}
	
	public function community_board_details($encryptId){
		$query = $this->db->get_where('community_board', array('encryptId' =>$encryptId));
		return $query->row();
	}
	
	public function forum_reply_entry(){
		$replyContent = $this->input->post('replyContent');
		
		if(isset($replyContent) && $replyContent!=''){
		
 			$replyDate = strtotime(date('Y-m-d'));
			$replyTime = time();
 			$forumId = trim($this->input->post('h_forumId'));
			$memberId = trim($this->input->post('h_memberId'));
 			$data = array('memberId'=>$memberId, 'forumId'=>$forumId, 'replyContent'=>$replyContent, 'replyDate'=>$replyDate, 'replyTime'=>$replyTime);
			$this->db->insert('community_board_replys',$data);
			
			$query = $this->db->get_where('community_board', array('forumId' =>$forumId));
			$row = $query->row();
			$replyCnt = ($row->replyCnt)+1;
			$this->db->where('forumId',$forumId); 
			$this->db->update('community_board', array("replyCnt"=>$replyCnt, 'updatedOn'=>$replyTime));
			
			return 'success||'.base_url().'community_board';
			
		}else{
			return 'error||Please enter your reply first!';
		}
		
		
	}
	
	public function update_likes($forumId,$memberId){
		
		$qry = $this->db->get_where('community_board_likes', array('forumId' =>$forumId, 'memberId' =>$memberId));
		$num_rows = $qry->num_rows();
		if($num_rows==0){
		
			$likeDate = strtotime(date('Y-m-d'));
			$likeTime = time();
			
			$this->db->insert('community_board_likes', array('memberId'=>$memberId, 'forumId'=>$forumId, 'likeDate'=>$likeDate, 'likeTime'=>$likeTime));
			
			$query = $this->db->get_where('community_board', array('forumId' =>$forumId));
			$row = $query->row();
			$likeCnt = ($row->likeCnt)+1;
			$this->db->where('forumId',$forumId); 
			$this->db->update('community_board', array("likeCnt"=>$likeCnt, 'updatedOn'=>$likeTime));
			return 'success';
			
		}
		
		
	}
	
	public function manage_entry(){
		
		$memberId = $this->input->post('h_memberId');
		$organizationId = $this->input->post('h_organizationId');
		
		$createDate = strtotime(date('Y-m-d'));
		$createMonth = date('m');
		$createYear = date('Y');
		$createTime = time();
		
		$forumId = trim($this->input->post('h_forumId'));
		$postTitle = trim($this->input->post('postTitle'));
		$postSlug = create_slug_ch($postTitle);
		$postContent = $this->input->post('postContent');
		$isStatus = $this->input->post('isStatus');
		
		$data = array('organizationId'=>$organizationId, 'memberId'=>$memberId, 'postTitle'=>$postTitle, 'postSlug'=>$postSlug, 'postContent'=>$postContent, 'isStatus'=>$isStatus, 'updatedOn'=>$createTime);
		
		if(isset($forumId) && $forumId!='' && $forumId>0){
			
			$this->db->where('forumId',$forumId); 
			$this->db->update('community_board', $data);
			$this->session->set_flashdata('success', 'Updated successfully!'); 
			
		}else{				
			
			$this->db->insert('community_board',$data);
			$insertedId = $this->db->insert_id();
			$encryptId = md5($insertedId).$insertedId;			
			$this->db->where('forumId',$insertedId); 
			$this->db->update('community_board', array("encryptId"=>$encryptId, 'createDate'=>$createDate, 'createMonth'=>$createMonth, 'createYear'=>$createYear, 'createTime'=>$createTime));
			$this->session->set_flashdata('success', 'Added successfully!'); 
			
		}
		
		return 'success||'.base_url().'community_board/my';
		
	}
	
}