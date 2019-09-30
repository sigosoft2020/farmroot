<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {
	public function __construct()
	{
			parent::__construct();
			$this->load->helper('url');
			$this->load->model('admin/M_user','user');
			$this->load->model('Common');
			if (!admin()) {
				redirect('app');
			}
	}
	public function index()
	{
		$this->load->view('admin/users/view');
	}
	public function get()
	{
		$result = $this->user->make_datatables();
		$data = array();
		foreach ($result as $res) 
		{
			$sub_array = array();
			
			$sub_array[] = $res->name;
			$sub_array[] = $res->username;
			$sub_array[] = $res->mobile;
			if($res->status == 'Delivery') 
			{
             $type  = 'Delivery Staff';
            } 
            else
            {
             $type = 'Office Staff';
            }
			$sub_array[] = $type;
			$sub_array[] = $res->status;
			$sub_array[] = '<a class="btn btn-link" style="font-size:16px;color:blue" href="' . site_url('admin/users/edit/'.$res->staff_id) . '"><i class="fa fa-pencil"></i></a>';
			$data[] = $sub_array;
		}

		$output = array(
			"draw"   => intval($_POST['draw']),
			"recordsTotal" => $this->user->get_all_data(),
			"recordsFiltered" => $this->user->get_filtered_data(),
			"data" => $data
		);
		echo json_encode($output);
	}

	public function add()
	{
		$this->load->view('admin/users/add');
	}

	public function disable($id)
	{
			$array = [
				       'Status' => 'Blocked'
			         ];
		
			if ($this->Common->update('user_id',$id,'users',$array)) {
				$this->session->set_flashdata('alert_type', 'success');
				$this->session->set_flashdata('alert_title', 'Success');
				$this->session->set_flashdata('alert_message', 'User blocked successfully..!');

				redirect('admin/users');
			}
			else {
				$this->session->set_flashdata('alert_type', 'error');
				$this->session->set_flashdata('alert_title', 'Failed');
				$this->session->set_flashdata('alert_message', 'Failed to block user..!');

				redirect('admin/users');
			}
	}

	public function enable($id)
	{
			$array = [
				       'Status' => 'Active'
			         ];
		
			if ($this->Common->update('user_id',$id,'users',$array)) {
				$this->session->set_flashdata('alert_type', 'success');
				$this->session->set_flashdata('alert_title', 'Success');
				$this->session->set_flashdata('alert_message', 'Users activated successfully..!');

				redirect('admin/users');
			}
			else {
				$this->session->set_flashdata('alert_type', 'error');
				$this->session->set_flashdata('alert_title', 'Failed');
				$this->session->set_flashdata('alert_message', 'Failed to activate user..!');

				redirect('admin/users');
			}
	}
}
?>
