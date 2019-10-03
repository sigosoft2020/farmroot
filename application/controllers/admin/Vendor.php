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
			
			$sub_array[] = $res->VendorName;
			$sub_array[] = $res->Phone;
			$sub_array[] = $res->Email;
			$sub_array[] = $res->GSTNo;
			$sub_array[] = $res->Address;
			$sub_array[] = $res->City;
			$sub_array[] = $res->State;
			$sub_array[] = $res->PINCode;
			$sub_array[] = $res->StatusVendor;
			$sub_array[] = '<button type="button" class="btn btn-link" style="font-size:20px;color:blue" onclick="edit(' . $res->VendorID . ')"><i class="fa fa-pencil"></i></button>';

			if($res->StatusVendor == 'Active') 
			{
             $action  = '<a class="btn btn-link" style="font-size:16px;color:red" href="' . site_url('admin/vendor/disable/'.$res->VendorID) . '"  onclick="return block()">Block</i></a>';
            } 
            else
            {
             $action = '<a class="btn btn-link" style="font-size:16px;color:orange" href="' . site_url('admin/vendor/enable/'.$res->VendorID) . '"  onclick="return block()">Enable</a>';
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
		$Phone       = $this->security->xss_clean($this->input->post('Phone'));
		$Email       = $this->security->xss_clean($this->input->post('Email'));
		$GSTNo       = $this->security->xss_clean($this->input->post('GSTNo'));
		$Address     = $this->security->xss_clean($this->input->post('Address'));
		$City        = $this->security->xss_clean($this->input->post('City'));
		$PINCode     = $this->security->xss_clean($this->input->post('PINCode'));
		$State       = $this->security->xss_clean($this->input->post('State'));
		
		$vendor_check = $this->Common->get_details('vendors',array('VendorName'=>$vendor_name,'Phone'=>$Phone,'GSTNo'=>$GSTNo));
		if($vendor_check->num_rows()==0)
        {
			$array = [
						'VendorName'  => $vendor_name,
						'Phone'       => $Phone,
						'Email'       => $Email,
						'GSTNo'       => $GSTNo,
						'Address'     => $Address,
						'City'        => $City,
						'State'       => $State,
						'PINCode'     => $PINCode,
						'StatusVendor'=> 'Active'
					];
			if ($this->Common->insert('vendors',$array)) {
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
		$vendor_name = $this->security->xss_clean($this->input->post('vendor'));
		$Phone       = $this->security->xss_clean($this->input->post('Phone'));
		$Email       = $this->security->xss_clean($this->input->post('Email'));
		$GSTNo       = $this->security->xss_clean($this->input->post('GSTNo'));
		$Address     = $this->security->xss_clean($this->input->post('Address'));
		$City        = $this->security->xss_clean($this->input->post('City'));
		$PINCode     = $this->security->xss_clean($this->input->post('PINCode'));
		$State       = $this->security->xss_clean($this->input->post('State'));
		$check       = $this->Common->get_details('vendors',array('VendorName' => $vendor_name ,'Phone'=>$Phone,'VendorID!=' => $vendor_id))->num_rows();
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
				        'VendorName'  => $vendor_name,
						'Phone'       => $Phone,
						'Email'       => $Email,
						'GSTNo'       => $GSTNo,
						'Address'     => $Address,
						'City'        => $City,
						'State'       => $State,
						'PINCode'     => $PINCode,
			         ];
		
			if ($this->Common->update('VendorID',$vendor_id,'vendors',$array)) {
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
				       'StatusVendor' => 'Blocked'
			         ];
		
			if ($this->Common->update('VendorID',$id,'vendors',$array)) {
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
				       'StatusVendor' => 'Active'
			         ];
		
			if ($this->Common->update('VendorID',$id,'vendors',$array)) {
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
		$data = $this->Common->get_details('vendors',array('VendorID' => $id))->row();
		print_r(json_encode($data));
	}
}
?>
