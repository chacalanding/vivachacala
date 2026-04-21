<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Registration_mdl extends CI_Model {



    public function create_entry(){
        $firstname = trim($this->input->post('firstname'));
        $slug = create_slug_ch($firstname);
            
        $this->db->where('slug', $slug);
        $query = $this->db->get('register_users');
        $num = $query->num_rows();
        if($num==0){
            $this->upload_logo();
            $file_data =  $this->upload->data();
            $file_name = $file_data['file_name'];
            $logo=$file_name;
            $lastname = trim($this->input->post('lastname'));
            $organization = trim($this->input->post('organization'));
            $role = trim($this->input->post('role'));
            $address = trim($this->input->post('address'));
            $email = trim($this->input->post('email'));
            $password = trim($this->input->post('password'));
            $contactno = trim($this->input->post('contactno'));
            $sponsor = $this->input->post('sponsor');
        
            $insert_data =  array("firstname" => $firstname, "slug" => $slug, "lastname" => $lastname,"organization" => $organization ,"role" => $role ,"address" => $address,
                                    "email" => $email, "password" => $password, "contactno" => $contactno,"logo" => $logo,"sponsor"=>$sponsor );
            
            $this->db->insert('register_users', $insert_data);
            $this->session->set_flashdata('success', 'Updated successfully!');
            return redirect(base_url().'registration');
        }else{
            $this->session->set_flashdata('error', 'error|| ' .$firstname. '  already exist.');
          return redirect(base_url().'registration');
            
        }     
     }

public function get_organization_type_details(){
    $this->db->where('is_delete', '0');
    $this->db->order_by('is_delete', '0');
    $query = $this->db->get('organization_type');
    return $query->result();
}

public function upload_logo()

{
		$config['upload_path']          = './assets/upload/logo';
		$config['allowed_types']        = 'gif|jpg|png';
		
		$this->load->library('upload', $config);
		$this->upload->initialize($config);

		if (!$this->upload->do_upload('logo'))
		{
				echo $this->upload->display_errors();
		}
		else
		{
			$this->load->library('image_lib');
			$file_data =  $this->upload->data();
			$configer =  array(
				'image_library' => 'gd2',
				'source_image'  =>  'full_path',
				'maintain_ratio'=>  TRUE,
			    'width'         =>  160 ,
			    'height'        =>  160 ,
			    'master_dim'    => 'width',
				'quality'       =>  "100%",
			  );
			  $this->image_lib->clear();
			  $this->image_lib->initialize($configer);
			  $this->image_lib->resize();
			  $file_name = $file_data['file_name'];
				
		}
}

}