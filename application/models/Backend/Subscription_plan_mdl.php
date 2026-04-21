<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Subscription_plan_mdl extends CI_Model
{
    function __construct()
    {

        parent::__construct();
    }

    public function subscription_plan_details()
    {
        $this->db->where('is_delete', '0');
        $this->db->order_by('name', 'asc');
        $query = $this->db->get('subscription_plan');
        return $query->result();
    }


    public function subscription_plan_fulldetails($plan_id)
    {
        $this->db->where('id', $plan_id);
        $query = $this->db->get('subscription_plan');
        return $query->row();
    }

    public function create_entry()
    {
        $name = trim($this->input->post('name'));
        $slug = create_slug_ch($name);
        $this->db->where('slug', $slug);
        $query = $this->db->get('subscription_plan');
        $num = $query->num_rows();
        if ($num == 0) {
            $cost = trim($this->input->post('cost'));
            $package = trim($this->input->post('package'));
            $package_details = trim($this->input->post('package_details'));

            $insert_data =  array("name" => $name, "slug" => $slug, "cost" => $cost, "package" => $package,  "package_details" => $package_details);
            $this->db->insert('subscription_plan', $insert_data);
            $this->session->set_flashdata('success', 'Added successfully!');
            return 'success||' . base_url() . $this->config->item('admin_directory_name') . 'Subscription_plan';
        } else {
            $this->session->set_flashdata('error', 'error|| ' . $name . '  already exist.');
            return 'success||' . base_url() . $this->config->item('admin_directory_name') . 'Subscription_plan';

        }
    }
    public function update_subscription_plan()
    {
        $plan_id = trim($this->input->post('id'));
        $name = trim($this->input->post('name'));
        $slug = create_slug_ch($name);

        $this->db->where('id != ', $plan_id);
        $this->db->where('slug', $slug);
        $query = $this->db->get('subscription_plan');
        $num = $query->num_rows();
        if ($num == 0) {
            $cost = trim($this->input->post('cost'));
            $package = trim($this->input->post('package'));
            $package_details = trim($this->input->post('package_details'));
            $is_status = $this->input->post('is_status');
            $this->db->where('id', $plan_id);

            $this->db->update('subscription_plan',  array("name" => $name, "slug" => $slug, "cost" => $cost, "package" => $package,  "package_details" => $package_details, "is_status" => $is_status));
            $this->session->set_flashdata('success', 'Added successfully!');
            return 'success||' . base_url() . $this->config->item('admin_directory_name') . 'Subscription_plan';
        } else {
            $this->session->set_flashdata('error', 'error|| ' . $name . '  already exist.');
            return 'success||' . base_url() . $this->config->item('admin_directory_name') . 'Subscription_plan';

        }
    }

    public function delete_subscription_plan($plan_id)
    {
        $this->db->where('id', $plan_id);
        $this->db->update('subscription_plan', array("is_delete" => '1'));

        $this->session->set_flashdata('success', 'Deleted successfully!');;
    }
}
