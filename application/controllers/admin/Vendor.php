<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vendor extends CI_Controller {
	public function __construct()
	{
			parent::__construct();
			$this->load->helper('url');
			$this->load->model('admin/M_vendor','vendor');
			$this->load->model('Common');
			if (!admin()) {
				redirect('app');
			}
	}
	public function index()
	{
		$this->load->view('admin/vendor/view');
	}
	public function get()
	{
		$result = $this->vendor->make_datatables();
		$data = array();
		foreach ($result as $res) 
		{
			$sub_array = array();
			
			$sub_array[] = $res->vendor_name;
			$sub_array[] = $res->status;
			$sub_array[] = '<button type="button" class="btn btn-link" style="font-size:20px;color:blue" onclick="edit(' . $res->vender_id . ')"><i class="fa fa-pencil"></i></button>';

			if($res->status == 'Active') 
			{
             $action  = '<a class="btn btn-link" style="font-size:16px;color:red" href="' . site_url('admin/vendor/disable/'.$res->vender_id) . '"  onclick="return block()">Block</i></a>';
            } 
            else
            {
             $action = '<a class="btn btn-link" style="font-size:16px;color:orange" href="' . site_url('admin/vendor/enable/'.$res->vender_id) . '"  onclick="return block()">Enable</a>';
            }
            
            $sub_array[]    = $action; 

			$data[] = $sub_array;
		}

		$output = array(
						"draw"            => intval($_POST['draw']),
						"recordsTotal"    => $this->vendor->get_all_data(),
						"recordsFiltered" => $this->vendor->get_filtered_data(),
						"data"            => $data
					   );
		echo json_encode($output);
	}

	public function add()
	{
		$this->load->view('admin/category/add');
	}
	public function edit($id)
	{
		$check = $this->Common->get_details('category',array('category_id' => $id));
		if ($check->num_rows() > 0) {
			$data['category'] = $check->row();
			$this->load->view('admin/category/edit',$data);
		}
		else {
			redirect('category');
		}
	}
	public function addVendor()
	{   
		date_default_timezone_set('Asia/Kolkata');
        $timestamp = date('Y-m-d H:i:s');

		$vendor_name = $this->security->xss_clean($this->input->post('vendor_name'));

		$vendor_check = $this->Common->get_details('vendor_details',array('vendor_name'=>$vendor_name));
		if($vendor_check->num_rows()==0)
        {
			$array = [
						'vendor_name'    => $vendor_name,
						'status'         => 'Active'
					];
			if ($this->Common->insert('vendor_details',$array)) {
				$this->session->set_flashdata('alert_type', 'success');
				$this->session->set_flashdata('alert_title', 'Success');
				$this->session->set_flashdata('alert_message', 'New vendor added..!');

				redirect('admin/vendor');
			}
			else {
				$this->session->set_flashdata('alert_type', 'error');
				$this->session->set_flashdata('alert_title', 'Failed');
				$this->session->set_flashdata('alert_message', 'Failed to add vendor..!');

				redirect('admin/vendor');
			}		
        }
        else
        {
    	  $this->session->set_flashdata('alert_type', 'error');
		  $this->session->set_flashdata('alert_title', 'Failed');
		  $this->session->set_flashdata('alert_message', 'Vendor already exists..!');
          redirect('admin/vendor');
        }			
	}

	public function update()
	{
		$vendor_id   = $this->input->post('vendor_id');
		$vendor      = $this->security->xss_clean($this->input->post('vendor'));
		$check       = $this->Common->get_details('vendor_details',array('vendor_name' => $vendor , 'vender_id!=' => $vendor_id))->num_rows();
		if ($check > 0) 
		{
			$this->session->set_flashdata('alert_type', 'error');
			$this->session->set_flashdata('alert_title', 'Failed');
			$this->session->set_flashdata('alert_message', 'Failed to add vendor..!');

			redirect('admin/vendor');
		}
		else 
		{
			$array = [
				       'vendor_name' => $vendor
			         ];
		
			if ($this->Common->update('vender_id',$vendor_id,'vendor_details',$array)) {
				$this->session->set_flashdata('alert_type', 'success');
				$this->session->set_flashdata('alert_title', 'Success');
				$this->session->set_flashdata('alert_message', 'Changes made successfully..!');

				redirect('admin/vendor');
			}
			else {
				$this->session->set_flashdata('alert_type', 'error');
				$this->session->set_flashdata('alert_title', 'Failed');
				$this->session->set_flashdata('alert_message', 'Failed to edit vendor..!');

				redirect('admin/vendor');
			}
	    }
	}

	public function disable($id)
	{
			$array = [
				       'status' => 'Disabled'
			         ];
		
			if ($this->Common->update('vender_id',$id,'vendor_details',$array)) {
				$this->session->set_flashdata('alert_type', 'success');
				$this->session->set_flashdata('alert_title', 'Success');
				$this->session->set_flashdata('alert_message', 'Vendor blocked successfully..!');

				redirect('admin/vendor');
			}
			else {
				$this->session->set_flashdata('alert_type', 'error');
				$this->session->set_flashdata('alert_title', 'Failed');
				$this->session->set_flashdata('alert_message', 'Failed to block vendor..!');

				redirect('admin/vendor');
			}
	}

	public function enable($id)
	{
			$array = [
				       'status' => 'Active'
			         ];
		
			if ($this->Common->update('vender_id',$id,'vendor_details',$array)) {
				$this->session->set_flashdata('alert_type', 'success');
				$this->session->set_flashdata('alert_title', 'Success');
				$this->session->set_flashdata('alert_message', 'Vendor activated successfully..!');

				redirect('admin/vendor');
			}
			else {
				$this->session->set_flashdata('alert_type', 'error');
				$this->session->set_flashdata('alert_title', 'Failed');
				$this->session->set_flashdata('alert_message', 'Failed to activate vendor..!');

				redirect('admin/vendor');
			}
	}


	public function getVendorById()
	{
		$id = $_POST['id'];
		$data = $this->Common->get_details('vendor_details',array('vender_id' => $id))->row();
		print_r(json_encode($data));
	}
}
?>
