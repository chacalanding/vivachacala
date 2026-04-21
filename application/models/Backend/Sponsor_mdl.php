<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sponsor_mdl extends CI_Model {


public function sponsor_details() 
{
    $this->db->where('is_delete', '0');
    $this->db->where('sponsor', '0');
    $this->db->order_by('firstname', 'asc');
    $query = $this->db->get('register_users');
      return $query->result();
}

public function sponsor_fulldetails($sponsor_id) 
{
    $this->db->where('id', $sponsor_id);
    $query = $this->db->get('register_users');
    return $query->row();
}
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
        $sponsor= trim($this->input->post('0'));
    
        $insert_data =  array("firstname" => $firstname, "slug" => $slug, "lastname" => $lastname,"organization" => $organization ,"role" => $role ,"address" => $address,
                                "email" => $email, "password" => $password, "contactno" => $contactno,"logo" => $logo, "sponsor"=>$sponsor );
        
        $this->db->insert('register_users', $insert_data);
        
        $this->session->set_flashdata('success', 'Updated successfully!');
        return redirect(base_url() . $this->config->item('admin_directory_name') . 'Sponsor');
    }else{
        $this->session->set_flashdata('error', 'error|| ' .$firstname. '  already exist.');
        return redirect(base_url() . $this->config->item('admin_directory_name') . 'Sponsor');

}
}



public  function update_sponsor_details()
{
    $user_id = trim($this->input->post('id'));
    $firstname = trim($this->input->post('firstname'));
    $slug = create_slug_ch($firstname);

    $this->db->where('id != ', $user_id);
    $this->db->where('slug', $slug);
    $query = $this->db->get('register_users');
    $num = $query->num_rows();
    if ($num == 0) {
        $lastname = trim($this->input->post('lastname'));
        $organization = trim($this->input->post('organization'));
        $role = trim($this->input->post('role'));
        $address = trim($this->input->post('address'));
        $email = trim($this->input->post('email'));
        $password = trim($this->input->post('password'));
        $contactno = trim($this->input->post('contactno'));
        $is_status = $this->input->post('is_status');

        $old_filename = $this->input->post('old_logo');

        $new_filename = $_FILES["logo"]['name'];

        if ($new_filename == TRUE) {
            $upadte_filename = time() . "-" . str_replace('', '-', $_FILES["logo"]['name']);
            $config['upload_path']      = './assets/upload/logos';
            $config['allowed_types']    = 'gif|jpg|png';
            $config['file_name']        = $upadte_filename;
            $this->load->library('upload', $config);
            if ($this->upload->do_upload('logo')) {
                if (file_exists("./assets/upload/logo" . $old_filename)) {
                    unlink("./assets/upload/logo" . $old_filename);
                }
            }
        } else {
            $upadte_filename = $old_filename;
        }
        $this->db->where('id', $user_id);
        $this->db->update('register_users', array("firstname" => $firstname, "slug" => $slug, "lastname" => $lastname, "organization" => $organization, 
                          "role" => $role,"address" => $address,"email" => $email,"password" => $password,"contactno" => $contactno, "logo" => $upadte_filename, "is_status" => $is_status));
        $this->session->set_flashdata('success', 'Updated successfully!');
       
    } else {
        $this->session->set_flashdata('error', 'error|| ' . $firstname . '  already exist.');
      
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
