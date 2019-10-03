<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer extends CI_Controller {
	public function __construct()
	{
			parent::__construct();
			$this->load->helper('url');
			$this->load->model('admin/M_customer','customer');
			$this->load->model('Common');
			if (!admin()) {
				redirect('app');
			}
	}
	public function index()
	{
		$this->load->view('admin/customers/view');
	}
	public function get()
	{
		$result = $this->customer->make_datatables();
		$data = array();
		foreach ($result as $res) 
		{
			$sub_array = array();
			
			$sub_array[] = $res->name;
			$sub_array[] = $res->phone;
			$sub_array[] = $res->email;
			$sub_array[] = $res->address;
			$sub_array[] = $res->status;
			$sub_array[] = '<a class="btn btn-link" style="font-size:16px;color:blue" href="' . site_url('admin/customer/edit/'.$res->user_id) . '"><i class="fa fa-pencil"></i></a>';
			$data[] = $sub_array;
		}

		$output = array(
			"draw"            => intval($_POST['draw']),
			"recordsTotal"    => $this->customer->get_all_data(),
			"recordsFiltered" => $this->customer->get_filtered_data(),
			"data"            => $data
		);
		echo json_encode($output);
	}

	public function add()
	{
		$this->load->view('admin/customers/add');
	}

	public function addUser()
	{   
		date_default_timezone_set('Asia/Kolkata');
        $timestamp = date('Y-m-d H:i:s');

		$name      = $this->security->xss_clean($this->input->post('name'));
		$mobile    = $this->security->xss_clean($this->input->post('mobile'));
		$email     = $this->security->xss_clean($this->input->post('email'));
		$address   = $this->security->xss_clean($this->input->post('address'));
		$password  = md5($this->security->xss_clean($this->input->post('password')));
        
		$user_check = $this->Common->get_details('users',array('phone'=>$mobile));
		if($user_check->num_rows()==0)
        {
			$array = [
						'name'     => $name,
						'phone'    => $mobile,
						'email'    => $email,
						'password' => $password,
						'address'  => $address,
						'status'   => 'Active',
						'timestamp'=> $timestamp
					];
			if ($this->Common->insert('users',$array)) {
				$this->session->set_flashdata('alert_type', 'success');
				$this->session->set_flashdata('alert_title', 'Success');
				$this->session->set_flashdata('alert_message', 'New customer added..!');

				redirect('admin/customer');
			}
			else {
				$this->session->set_flashdata('alert_type', 'error');
				$this->session->set_flashdata('alert_title', 'Failed');
				$this->session->set_flashdata('alert_message', 'Failed to add customer..!');

				redirect('admin/customer');
			}		
        }
        else
        {
    	  $this->session->set_flashdata('alert_type', 'error');
		  $this->session->set_flashdata('alert_title', 'Failed');
		  $this->session->set_flashdata('alert_message', 'Customer already exists..!');
          redirect('admin/customer');
        }			
	}

	public function edit($id)
	{
		$data['customer'] = $this->Common->get_details('users',array('user_id'=>$id))->row();
		$this->load->view('admin/customers/edit',$data);
	}
    
    public function update()
	{   
		date_default_timezone_set('Asia/Kolkata');
        $timestamp = date('Y-m-d H:i:s');
        
        $customer_id  = $this->security->xss_clean($this->input->post('customer_id'));
		$name         = $this->security->xss_clean($this->input->post('name'));
		$mobile       = $this->security->xss_clean($this->input->post('mobile'));
		$email        = $this->security->xss_clean($this->input->post('email'));
        $address      = $this->security->xss_clean($this->input->post('address'));
        $status       = $this->security->xss_clean($this->input->post('status'));

		$user_check   = $this->Common->get_details('users',array('phone'=>$mobile,'user_id!=' => $customer_id));
		if($user_check->num_rows()==0)
        {
			$array = [
						'name'     => $name,
						'phone'    => $mobile,
						'email'    => $email,
						'address'  => $address,
						'status'   => $status
					];
			if ($this->Common->update('user_id',$customer_id,'users',$array)) {
				$this->session->set_flashdata('alert_type', 'success');
				$this->session->set_flashdata('alert_title', 'Success');
				$this->session->set_flashdata('alert_message', 'Changes made successfully..!');

				redirect('admin/customer');
			}
			else {
				$this->session->set_flashdata('alert_type', 'error');
				$this->session->set_flashdata('alert_title', 'Failed');
				$this->session->set_flashdata('alert_message', 'Failed to update customer..!');

				redirect('admin/customer/edit/'.$customer_id);
			}	
        }
        else
        {
    	  $this->session->set_flashdata('alert_type', 'error');
		  $this->session->set_flashdata('alert_title', 'Failed');
		  $this->session->set_flashdata('alert_message', 'Customer already exists..!');
          redirect('admin/customer');
        }			
	}


	public function disable($id)
	{
			$array = [
				       'Status' => 'Blocked'
			         ];
		
			if ($this->Common->update('user_id',$id,'users',$array)) 
			{
				$this->session->set_flashdata('alert_type', 'success');
				$this->session->set_flashdata('alert_title', 'Success');
				$this->session->set_flashdata('alert_message', 'User blocked successfully..!');

				redirect('admin/users');
			}
			else 
			{
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
