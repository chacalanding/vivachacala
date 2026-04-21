<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Users_mdl extends CI_Model
{

    public function users_details()
    {
        $this->db->where('is_delete', '0');
        $this->db->order_by('firstname', 'asc');
        $query = $this->db->get('register_users');
        return $query->result();
    }
    public function users_fulldetails($user_id){
        $this->db->where('id',$user_id);
        $query=$this->db->get('register_users');
        return $query->row();      
    }

    public  function update_user_details()
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
                $config['allowed_types']    = 'gif|jpg|png|jpeg';
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
            return 'success||' . base_url() . $this->config->item('admin_directory_name') . 'users';

        } else {
            $this->session->set_flashdata('error', 'error|| ' . $firstname . '  already exist.');
            return 'success||' . base_url() . $this->config->item('admin_directory_name') . 'users';

        }
    }
    public function delete_entry($user_id)
    {
        $this->db->where('id', $user_id);
        $this->db->update('register_users', array("is_delete" => '1'));

        $this->session->set_flashdata('success', 'Deleted successfully!');;
    }
}
