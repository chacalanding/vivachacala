<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Api_mdl extends CI_Model {
	/**
	 * Constructor
	 *
	 * @access	public
	 */  
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
	
	public function blog_details($blog_id,$category_id){
		if(isset($blog_id) && $blog_id!=0 && $blog_id!=''){
			$this->db->where('blog_id', $blog_id);
		}
		if(isset($category_id) && $category_id!=0 && $category_id!=''){
			$this->db->where('category_id', $category_id);
		}
		$this->db->where('status', '0');
		$this->db->order_by('blog_id', 'desc');
		$query = $this->db->get('blog');
		return $query->result();		
	}
	
	public function registration_insert($data){	
		$insert = $this->db->insert('registration', $data);	
		return $insert?$this->db->insert_id():false;	
	}
	
	function getRows($params = array()){
        $this->db->select('*');
        $this->db->from('registration');
        
        //fetch data by conditions
        if(array_key_exists("conditions",$params)){
            foreach($params['conditions'] as $key => $value){
                $this->db->where($key,$value);
            }
        }
        
        if(array_key_exists("id",$params)){
            $this->db->where('id',$params['id']);
            $query = $this->db->get();
            $result = $query->row_array();
        }else{
            //set start and limit
            if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
                $this->db->limit($params['limit'],$params['start']);
            }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
                $this->db->limit($params['limit']);
            }
            
            if(array_key_exists("returnType",$params) && $params['returnType'] == 'count'){
                $result = $this->db->count_all_results();    
            }elseif(array_key_exists("returnType",$params) && $params['returnType'] == 'single'){
                $query = $this->db->get();
                $result = ($query->num_rows() > 0)?$query->row_array():false;
            }else{
                $query = $this->db->get();
                $result = ($query->num_rows() > 0)?$query->result_array():false;
            }
        }

        //return fetched data
        return $result;
    }
	
	
}